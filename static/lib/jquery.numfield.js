(function() {
    function NumField(element, config) {
        var element = $(element).addClass('num-field');
        var input = this.input = element.find('input');
        this.config = $.extend({
            step: 1
        }, {
            min: input.attr('min'),
            step: input.attr('step'),
            max: input.attr('max')
        }, config);
        this.config.min = typeof this.config.min != 'undefined' ? parseFloat(this.config.min) : 0;
        this.config.max = typeof this.config.max != 'undefined' ? parseFloat(this.config.max) : Math.pow(2, 31) - 1;
        this.value = this._oldvalue = parseFloat(input.val());

        this.btns = $('<a href="javascript:" class="minus">-</a>').insertBefore(input)
        .add($('<a href="javascript:" class="plus">+</a>').insertAfter(input));


        input.keypress($.proxy(this.patternfilter, this))
            .change($.proxy(this.rangefilter, this));
        this.btns.click($.proxy(this.increase, this));
    }
    NumField.prototype = {
        constructor: NumField,
        pattern: /\d/,
        patternfilter: function(e) {
            return new RegExp(this.pattern).test(String.fromCharCode(e.which));
        },
        increase: function(e) {
            this.value += this.config.step * (e.target == this.btns[0] ? -1 : 1);
            this.input.val(this.value).change();
        },
        rangefilter: function(e) {
            var val = parseFloat(this.input.val()),
                min = this.config.min,
                max = this.config.max,
                newVal = null;
            if(isNaN(val)) {
                newVal = this._oldvalue;
            }
            if(val < min ) {
                newVal = min;
            }
            if(val > max) {
                newVal = max;
            }
            if(newVal !== null) {
                // min or max may also equal this._oldvalue
                newVal === this._oldvalue && e.stopImmediatePropagation();
                val = newVal;
                // update input if value changed
                this.input.val(val);
            }
            this.value = this._oldvalue = val;
        }
    };

    ControlManager.register('numField', NumField);
})();
