<?php

namespace AppBundle\Controller\Api;

use AppBundle\Provider\DurationProvider;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class DurationController extends AbstractFOSRestController
{
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                DurationProvider::class,
                'validator',
            ]
        );
    }

    /**
     * @ApiDoc(
     *     section="Duration",
     *     description="Returns the formatted duration based on the given duration in seconds",
     *     parameters={
     *         {"name"="durationInSec", "dataType"="integer", "required"=false }
     *     },
     *     statusCodes={
     *         200="Returned duration in years, days, hours, minutes, and seconds.",
     *         422="Validation error."
     *     },
     *     output={
     *         "class"="AppBundle\Model\Api\Response\Duration",
     *         "parsers"={
     *             "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *         }
     *     }
     * )
     */
    public function getAction(Request $request): View
    {
        $durationInSec = $request->get('durationInSec');
        $errors = $this->get('validator')->validate($durationInSec, [
            new GreaterThanOrEqual(0),
        ]);

        if (count($errors) > 0) {
            throw new UnprocessableEntityHttpException();
        }

        $duration = $this->get(DurationProvider::class)->provide($durationInSec);

        return $this->view($duration, Response::HTTP_OK);
    }
}
