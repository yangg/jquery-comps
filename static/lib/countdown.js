// 倒计时插件
(function() {
  function CountDown(element, config) {
    this.element = $(element);
    this.config = $.extend({}, this.constructor.DEFAULTS, config);

    this.start();

  }

  CountDown.prototype.start = function () {
    var config = this.config;
    var end = new Date(config.end * 1000).getTime();
    var ts = Math.max((end + config.TS_LOCAL_SERVER - new Date()) / 1000, 0); // gte 0
    //console.log(config.TS_LOCAL_SERVER);
    var countData = {};
    countData.day = ts / (3600 * 24);
    countData.hour = ts / 3600 % 24;
    countData.minute = ts / 60 % 60;
    countData.second = ts % 60;
    for (var k in countData) {
      countData[k] = Math.floor(countData[k]);
    }
    this.element.html(strbuf(config.template, countData));

    if (ts < 1) {
      return config.onEnd(this.element);
    }
    var args = arguments;
    setTimeout(function () {
      args.callee.apply(this, args);
    }.bind(this), 1000);
  };
  CountDown.DEFAULTS = {
    template: '${hour}:${minute}:${second}',
    end: null,
    onEnd: $.noop,
    TS_LOCAL_SERVER: 0
  };

  ControlManager.register('countDown', CountDown);
})();
