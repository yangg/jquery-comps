(function() {
    function CheckAll(element, config) {
        config = $.extend({
            selector: ':checkbox'
        }, config);
        var self = this;
        this.element = $(element);
        var tb = this.element.closest('table');
        this.element.change(function() {
            tb.find('tbody ' + config.selector).prop('checked', this.checked);
        });
        // also update value on checkAll changed
        tb.on('change', config.selector, function() {
            var chks = tb.find(config.selector);
            self.element.val(chks.serialize())
                .trigger('update');
        });
    }
    window.ControlManager && ControlManager.register(CheckAll);
})();