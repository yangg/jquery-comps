/**
 * Created by Brook on 2016/1/22.
 */

// see https://gist.github.com/yangg/1489875
!function(){function t(n){if(this.__data=[],n){var r,i=arguments;if(!(this instanceof t))return r=new t,r.push.apply(r,i).toString();this.push.apply(this,i)}}t.prototype={push:function(t,n,r){var i,o=arguments;return i=o.length<2?void 0===t?"":t:"object"==typeof n?t.replace(/\$\{([\w.]+)\}/g,function(t,i){for(var o=i.split("."),u=0,a=o.length,e=n;a>u;)try{e=e[o[u++]]}catch(s){e=t}return void 0===e?r:e}):t.replace(/\{(\d+)\}/g,function(t,n){return o[+n+1]}),this.__data.push(i),this},pushArray:function(t,n,r){for(var i,o=0;o<n.length;o++)i=n[o],this.push(t,i,r)},toString:function(t){return this.__data.join(void 0===t?"":t)}},window.strbuf=t}();

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
        return func.name || func.toString().match(/^function\s+([\w\$]+)\s*\(/)[1];
    }
    var ControlManager = {
        triggers: [],
        init: function() {
            $(function() {
              this.render(document);
            }.bind(this));
        },
        render: function(context) {
            var selector = this.triggers.map(function(trigger) {
                return '[data-toggle=' + trigger + ']';
            }).join(',');
            $(selector, context).each(function() {
                var toggle = $(this).data('toggle');
                if(!$.fn[toggle]) {
                    return console.error('$.fn."%s" is not defined', toggle);
                }
                $(this)[toggle]();
            });
        },
        register: function(Cls) {
            var fnName = getName(Cls).replace(/^[A-Z]/, function($0) {
                return $0.toLowerCase();
            });
            $.fn[fnName] = function(option) {
                var args = arguments;
                return this.each(function() {
                    var $this = $(this);
                    var data = $this.data('inst.' + fnName);
                    if(!data) {
                        $this.data('inst.' + fnName, new Cls(this, $.extend({}, $this.data(), option)));
                    } else {
                        data[option].apply(data, [].slice.call(args, 1));
                    }
                });
            };
            this.triggers.push(fnName);
        }
    };
    ControlManager.init();
    window.ControlManager = ControlManager;
})();

(function() {
    function Flash(config) {
        this.config = $.extend({}, this.constructor.DEFAULTS, config);
        this.render();
    }
    Flash.prototype.render = function() {
        var config = this.config;
        var modal = $('#' + config.id);
        if(!modal.length) {
            modal = $(strbuf('<div id="{0}"/>', config.id)).appendTo(document.body)
                .append(strbuf('<div class="weui_mask_transparent"></div><div class="weui_toast"><i class="flash-icon icon ${icon}"></i><p class="weui_toast_content">${msg}</p></div>', config));
        } else {
            modal.find('.weui_toast_content').text(config.msg);
            modal.find('.flash-icon').attr('class', 'flash-icon icon ' + config.icon);
            modal.show();
        }
        clearTimeout(this.constructor.timer);
        config.hideDelay && (this.constructor.timer = setTimeout(function() {
            modal.hide();
        }, config.hideDelay));
    };
    Flash.DEFAULTS = {
        id: 'flash_modal',
        icon: 'i-check',
        msg: '',
        hideDelay: 2000
    };
    /**
     *
     * @param {String/Object} msg
     * @param [icon]
     */
    $.flash = function(msg, icon) {
        new Flash(typeof msg == 'object' ? msg : {msg: msg, icon: icon});
    };
    $.loading = function(msg) {
        if(msg === false) {
            return new Flash({hideDelay: 1}); // great than 0 to start timer
        }
        new Flash({msg: msg || '加载中', hideDelay: 0, icon: 'loading-icon'});
    }
})();
(function() {
    function Alert(config) {
        this.config = $.extend({}, this.constructor.DEFAULTS, config);
        this.render();
    }
    Alert.prototype = {
        constructor: Alert,
        render: function() {
            var config = this.config;
            this.modal = $(strbuf('<div id="{0}"/>', config.id)).appendTo(document.body);
            this.modal.append(strbuf('<div class="weui_mask"></div>' +
                    '<div class="weui_dialog"><div class="weui_dialog_hd"><strong class="weui_dialog_title">${title}</strong></div><div class="weui_dialog_bd">${msg}</div>' +
                    '<div class="weui_dialog_ft"></div></div>', config))
                .find('.weui_dialog_ft').append(this.getButtons());
        },
        getButtons: function() {
            var btns = $('<a href="javascript:" class="weui_btn_dialog primary">确定</a>');
            btns.click(this.close.bind(this));
            return btns;
        },
        close: function() {
            this.modal.remove();
        }
    };
    Alert.DEFAULTS = {
        id: 'modal_alert',
        title: '提示',
        msg: ''
    };
    /**
     * alert
     * @param {String/Object} msg
     * @param [title]
     */
    $.alert = function(msg, title) {
        new Alert(typeof msg == 'object' ? msg : {msg: msg, title: title});
    };
    window.Alert = Alert;
})();
(function() {
    function Confirm() {
        this.constructor.__super__.constructor.apply(this, arguments);
    }
    $.inherit(Confirm, Alert);
    Confirm.prototype.getButtons = function() {
        var btnOk = this.constructor.__super__.getButtons.call(this);
        btnOk.click(this.config.callback);
        var btnCancel = $('<a href="javascript:" class="weui_btn_dialog default">取消</a>')
            .click(this.close.bind(this));
        return btnCancel.add(btnOk);
    };
    Confirm.DEFAULTS = $.extend({}, Alert.DEFAULTS, {
        id: 'modal_confirm',
        title: '确认',
        callback: $.noop
    });
    /**
     * confirm
     * @param {String/Object} msg
     * @param [title]
     * @param callback
     */
    $.confirm = function(msg, title, callback) {
        var config = typeof msg == 'object' ? msg : {msg: msg, title: title, callback: callback };
        if(typeof callback === 'undefined') {
            config.callback = title;
            delete config.title;
        }
        new Confirm(config);
    };
})();
