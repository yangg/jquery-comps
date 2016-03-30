
(function() {

  $.fn.carousel = function() {
    // 幻灯片
    var element = $(this);
    var config = $.extend({
      autoPlay: true
    }, element.data());
    var w = element.width();
    var inner = element.find('.carousel-inner');
    var pager = element.find('.carousel-pager');
    var pagers = $(inner.children().map(function() {
      return '<a href="javascript:"/>';
    }).get().join('')).appendTo(pager);
    pager.css('marginLeft', -pager.width()/2);
    var count = inner.children().length;
    if(count === 1) {
      element.find('.carousel-pager,.carousel-next').hide();
      return; // do nothing if only one slide
    }
    inner.children().first().clone().appendTo(inner);
    inner.children().width(w);
    inner.width(w * inner.children().length);

    pagers.click(function() {
      index = $(this).index();
      go(index);
    });
    element.on('swipeLeft', function() {
      run();
    }).on('swipeRight', function() {
      run(true);
    }).on('click', '.carousel-next', function() {
      this.blur();
      run($(this).data('backward'));
    });

    var index = -1, timer;
    function go(index) {
      clearTimeout(timer);
      inner.stop(true, true).animate({marginLeft: (-index * 100) + '%'});
      pagers.eq(index % count).addClass('active').siblings().removeClass('active');
      config.autoPlay && (timer = setTimeout(run, 5000));
    }
    function run(backward) {
      index = typeof backward == 'undefined' ? index + 1 : index - 1;
      if(index == count + 1) {
        inner.css('margin-left', 0);
        index = 1;
      } else if(index == -1) {
        inner.css('margin-left', -(count * 100) + '%');
        index = count - 1;
      }
      go(index);
    }
    run();
  };
})();
