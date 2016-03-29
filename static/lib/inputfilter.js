/**
 * Created by brook on 4/20/15.
 */

(function($) {
  function InputFilter(input, config) {
    this.input = $(input);
    this.config = $.extend({}, config);
    this.pattern = "\\d";
  }

  InputFilter.prototype = {
    constructor: InputFilter,
    init: function () {
      this.input
        .keypress($.proxy(this.pressFilter, this))
        .on('input propertychange', $.proxy(this.inputFilter, this));
      this.fixReg = new RegExp('[^' + this.pattern + ']', 'g');
      this.pattern = new RegExp('[' + this.pattern + ']');
    },
    pressFilter: function (e) {
      // ignore the following keys in firefox
      // Tab, Backspace, F5, Home, End, Left, Up, Right, Down, Delete
      if (e.ctrlKey || [8, 9, 116, 35, 36, 37, 38, 39, 40, 46].indexOf(e.keyCode) > -1) {
        return true;
      }
      // http://api.jquery.com/event.which/
      var ch = String.fromCharCode(e.which);
      return this.pattern.test(ch);
    },
    inputFilter: function () {
      var input = this.input;
      var caretPos = this.getCaret();
      if (caretPos == input.val().length) {
        // do not set caret position if the cursor is at the end
        caretPos = null;
      }

      var newVal = this.fixVal();

      // set val when necessary to speed up in IE 8
      input.val() !== newVal && input.val(newVal);
      caretPos && this.setCaret(caretPos);
    },
    fixVal: function () {
      var newVal = this.input.val().trim();
      newVal = newVal.replace(this.fixReg, '');
      return newVal;
    },
    setCaret: function (caretPos) {
      var input = this.input[0];

      if ('selectionStart' in input) {
        input.focus();
        input.setSelectionRange(caretPos, caretPos);
      } else if (input.createTextRange) {
        var range = input.createTextRange();
        range.move('character', caretPos);
        range.select();
      }
    },
    getCaret: function () {
      // http://stackoverflow.com/a/2897510/1063091
      var input = this.input[0];
      if ('selectionStart' in input) {
        // Standard-compliant browsers
        return input.selectionStart;
      } else if (document.selection) {
        // IE
        input.focus();
        var sel = document.selection.createRange();
        var selLen = document.selection.createRange().text.length;
        sel.moveStart('character', -input.value.length);
        return sel.text.length - selLen;
      }
    }
  };

  function NumberFilter() {
    this.constructor.__super__.constructor.apply(this, arguments);
    this.config = $.extend({
      decimal: 0
    }, this.config);
    this.config.decimal && (this.pattern = "\\d\\.");

    this.init();
  }

  $.inherit(NumberFilter, InputFilter);
  NumberFilter.prototype.pressFilter = function (e) {
    var ret = this.constructor.__super__.pressFilter.apply(this, arguments);
    var ch = String.fromCharCode(e.which);
    if (this.config.decimal) {
      // 首位 或者 已经输入 "." 的不能再输入 "."
      if (ch == '.' && (this.getCaret() === 0 || this.input[0].value.indexOf(ch) > -1)) {
        return false;
      }
    }
    return ret;
  };
  NumberFilter.prototype.fixVal = function () {
    var newVal = this.constructor.__super__.fixVal.call(this);
    var decs = this.config.decimal;
    if (decs && (newVal.match(/\.(\d+)/) || [0, ''])[1].length > decs) {
      newVal = parseFloat(newVal).toFixed(decs);
    }
    return newVal;
  };

  function Masked() {
    this.constructor.__super__.constructor.apply(this, arguments);
    var input = this.input;

    this.hiddenField = $('<input type="hidden" name="' + input.attr('name') + '"/>').insertAfter(input);
    input.removeAttr('name');
    this.init();

    if (input.val()) {
      this.inputFilter();
    }
  }

  $.inherit(Masked, InputFilter);
  Masked.prototype.fixVal = function () {
    var newVal = this.constructor.__super__.fixVal.call(this);
    newVal = newVal.replace(/(\d{4})(?=\d)/g, '$1 ');
    this.updateHidden();
    return newVal;
  };
  Masked.prototype.updateHidden = function () {
    this.hiddenField.val(this.input.val().replace(/\s+/g, ''));
  };

  ControlManager.register('numberFilter', NumberFilter);
  ControlManager.register('masked', Masked);
})($);
