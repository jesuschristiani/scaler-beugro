angular
    .module('durationForm')
    .component('durationForm', {
        template:
            '<form ng-submit="$ctrl.submit()">' +
                '<div class="form-floating mb-3">' +
                    '<input ' +
                        'ng-model="$ctrl.durationInSec" ' +
                        'ng-required="true" ' +
                        'ng-change="$ctrl.isSubmitted = false" ' +
                        'name="durationInSec" ' +
                        'type="number" ' +
                        'class="form-control {{ $ctrl.isLoading ? \'disabled\' : \'\' }}" ' +
                        'placeholder="Duration" />' +
                    '<label for="durationInSec">Duration</label>' +
                '</div>' +
                '<div ng-if="$ctrl.isSubmitted && !$ctrl.isLoading && $ctrl.durationInSec > 0" class="mb-3">' +
                    '<time-text ' +
                        'ng-repeat="data in $ctrl.getNotNullDateParts()" ' +
                        'value="data.value" ' +
                        'text="data.text" ' +
                        'is-last="$last" ' +
                        'is-first="$first">' +
                    '</time-text>' +
                '</div>' +
                '<div ng-if="$ctrl.isSubmitted && !$ctrl.isLoading && $ctrl.durationInSec === 0" class="mb-3">' +
                    '<span>now</span>' +
                '</div>' +
                '<button type="submmit" class="btn btn-primary {{ $ctrl.isLoading ? \'disabled\' : \'\' }}">Submit</button>' +
            '</form>',
        controller: ['$http',
            function DurationFormController($http) {
                this.isSubmitted = false;
                this.isLoading = false;
                this.durationInSec = null;
                this.durationFormatted = {
                    year: { value: null, text: 'year' },
                    day: { value: null, text: 'day' },
                    hour: { value: null, text: 'hour' },
                    min: { value: null, text: 'minute' },
                    sec: { value: null, text: 'second' }
                };

                const self = this;

                this.getNotNullDateParts = function getNotNullDateParts() {
                    const parts = [];

                    for (const key in self.durationFormatted) {
                        if (self.durationFormatted.hasOwnProperty(key) && self.durationFormatted[key].value !== null) {
                            parts.push(self.durationFormatted[key]);
                        }
                    }

                    return parts;
                }

                this.submit = function submit() {
                    self.isSubmitted = true;
                    self.isLoading = true;

                    $http.get('/api/duration/', {
                        params: {
                            durationInSec: self.durationInSec,
                        }
                    })
                        .then(function(response) {
                            for (const key in self.durationFormatted) {
                                if (self.durationFormatted.hasOwnProperty(key)) {
                                    self.durationFormatted[key].value = null;
                                }
                            }
                            for (const key in response.data) {
                                if (response.data.hasOwnProperty(key)) {
                                    self.durationFormatted[key].value = response.data[key];
                                }
                            }
                        })
                        .catch(function () {})
                        .finally(function () {
                            self.isLoading = false;
                        })
                    ;
                };
            }
        ]
    })
;