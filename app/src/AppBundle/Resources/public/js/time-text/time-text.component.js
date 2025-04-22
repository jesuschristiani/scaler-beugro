angular
    .module('timeText')
    .component('timeText', {
        bindings: {
            text: '<',
            value: '<',
            isLast: '<',
            isFirst: '<',
        },
        template:
            '<span ng-if="$ctrl.value">' +
                '{{ $ctrl.separator() }}{{ $ctrl.value }} {{ $ctrl.text }}{{ $ctrl.value > 1 ? "s" : "" }}' +
            '</span>',
        controller: [function TimeTextController() {
            const self = this;

            this.separator = function separator() {
                if (self.isFirst) {
                    return '';
                }

                if (self.isLast) {
                    return ' and ';
                }

                return ', ';
            }
        }]
    })
;