
(function() {
  function Rating(element, config) {
    this.element = $(element);
    this.config = $.extend({}, this.constructor.DEFAULTS, config);
    this.render();
  }
  Rating.prototype = {
    constructor: Rating,
    render: function() {
      this.element.addClass('rating');
      this.element.html('<div class="rating-score" ></div>');

      this.editable = !!this.config.name;
      if(this.editable) {
        this.hidden = $(strbuf('<input type="hidden" name="{0}" />', this.config.name)).appendTo(this.element);
        this.element.on('click mousemove', function(e) {
            var value = Math.ceil((e.offsetX / this.element.width()) * 5);
            this.val(value, e.type == 'click'); // only update hidden value when triggered by 'click'
          }.bind(this))
          .on('mouseleave', function() {
            this.val(this.hidden.val());
          }.bind(this));
      }
      this.val(this.config.value);
    },
    val: function(value, updateVal) {
      if(updateVal === undefined) {
        updateVal = this.editable;
      }

      var fontSize = parseFloat(this.element.css('font-size'));
      var letterSpacing = parseFloat(this.element.css('letter-spacing')) / fontSize;
      var width = fontSize * value + fontSize * letterSpacing * Math.floor(value);
      //var width = value*20 + '%';
      this.element.find('.rating-score').width(width);
      updateVal && this.hidden.val(value);
    }
  };
  Rating.DEFAULTS = {
    name: null,
    value: 0
  };
  window.ControlManager && ControlManager.register(Rating);
})();
