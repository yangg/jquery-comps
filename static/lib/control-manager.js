(function() {
  var hasProp = {}.hasOwnProperty;

  function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key))
        child[key] = parent[key];
    }
    function ctor() {
      this.constructor = child;
    }

    ctor.prototype = parent.prototype;
    child.prototype = new ctor();
    child.__super__ = parent.prototype;
    return child;
  }

  $.inherit = extend;

  function getName(func) {
    var fnName = func.name || (func.toString().match(/^function\s+([\w\$]+)\s*\(/) || [0, 0])[1];
    if(!fnName) {
      throw new TypeError('Cannot get function name!\n' + func.toString());
    }
    return fnName;
  }

  var ControlManager = {
    triggers: [],
    init: function () {
      $(function () {
        this.render(document);
      }.bind(this));
      // bootstrap modal loaded or custom loaded event
      $(document).on('loaded.bs.modal loaded', function (e) {
        this.render(e.target);
      }.bind(this));
    },
    render: function (context) {
      var selector = this.triggers.map(function (trigger) {
        return '[data-toggle=' + trigger + ']';
      }).join(',');
      $(selector, context).each(function () {
        var toggle = $(this).data('toggle');
        if (!$.fn[toggle]) {
          return console.error('$.fn."%s" is not defined', toggle);
        }
        $(this)[toggle]();
      });
    },
    register: function (Cls) {
      var fnName = getName(Cls).replace(/^[A-Z]/, function ($0) {
        return $0.toLowerCase();
      });
      $.fn[fnName] = function (option) {
        var args = arguments;
        return this.each(function () {
          var $this = $(this);
          var data = $this.data('inst.' + fnName);
          if (!data) {
            $this.data('inst.' + fnName, new Cls(this, $.extend({}, $this.data(), option)));
          } else {
            data[option] && data[option].apply(data, [].slice.call(args, 1));
          }
        });
      };
      $.fn[fnName].Constructor = Cls;
      this.triggers.push(fnName);
    }
  };
  //ControlManager.init();
  window.ControlManager = ControlManager;
})();
