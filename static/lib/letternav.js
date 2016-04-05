/**
 * jquery letter navigation plugin
 * Compatible with Zepto
 * Created by Brook Yang on 2015/1/21.
 */

(function() {
  function LetterNav(element, config) {
    this.element = $(element);
    this.config = $.extend({
      anchorSelector: 'dt'
    }, config);
    this.init();
  }

  LetterNav.prototype = {
    init: function () {
      var anchorHtml = this.element.find(this.config.anchorSelector).map(function () {
        return '<div>' + $(this).text() + '</div>';
      }).get().join('');
      this.anchorList = $('<div class="anchor-list"/>').html(anchorHtml).appendTo(this.element);

      this.bindEvent();
    },
    scrollTo: function (target) {
      this.touchData.current = target;
      var anchor = target.text();
      var anchorTarget = $('#anchor_' + anchor, this.element);

      // disable -webkit-overflow-scrolling: touch
      // before set scrollTop to avoid performance issue
      // disable `position: sticky` before get proper offsetTop
      this.element.find('.nav-main').addClass('scrolling')
        .scrollTop(anchorTarget[0].offsetTop)
        .removeClass('scrolling');
    },
    bindEvent: function () {
      this.anchorList
        .on('touchstart MSPointerDown pointerdown', function (e) {
          this.anchorList.jquery && (e = e.originalEvent); // get touches data from originalEvent in jquery
          if (e.touches && e.touches.length === 1) {
            this.touchData = {};
            // this.touchData.y1 = e.touches[0].pageY;
            this.touchData.start = $(e.target);
            this.touchData.y1 = this.touchData.start.offset().top;
            this.scrollTo(this.touchData.start);
            e.preventDefault();
          }
        }.bind(this))
        .on('touchmove MSPointerMove pointermove', function (e) {
          this.anchorList.jquery && (e = e.originalEvent);
          if (e.touches && e.touches.length === 1 && this.touchData) {
            this.touchData.y2 = e.touches[0].pageY;
            var offsetPx = this.touchData.y2 - this.touchData.y1;
            var offset = Math.floor(offsetPx / this.touchData.start.height());
            var targetIndex = this.touchData.start.index() + offset;
            var targets = this.anchorList.children();
            targetIndex = targetIndex < 0
              ? 0 : targetIndex > targets.length - 1
              ? targets.length - 1 : targetIndex;
            var target = targets.eq(targetIndex);
            if (target[0] != this.touchData.current[0]) {
              this.scrollTo(target);
              e.preventDefault();
            }
          }
        }.bind(this))
        .on('touchend MSPointerUp pointerup', function () {
          this.touchData = null;
        }.bind(this));
    }
  };
  ControlManager.register('letterNav', LetterNav);
})();
