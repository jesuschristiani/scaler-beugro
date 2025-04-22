<?php

namespace AppBundle\Model\Api\Response;

class Duration
{
    /**
     * @var int|null
     */
    private $year;

    /**
     * @var int|null
     */
    private $day;

    /**
     * @var int|null
     */
    private $hour;

    /**
     * @var int|null
     */
    private $min;

    /**
     * @var int|null
     */
    private $sec;

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function setHour(?int $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(?int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getSec(): ?int
    {
        return $this->sec;
    }

    public function setSec(?int $sec): self
    {
        $this->sec = $sec;

        return $this;
    }
}
