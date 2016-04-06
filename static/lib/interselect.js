
(function() {
  function InterSelect(element, options) {
    this.element = $(element);
    this.options = $.extend({}, this.constructor.DEFAULTS, options);
    this.render();
  }

  InterSelect.prototype = {
    constructor: InterSelect,
    render: function () {
      var that = this;
      this.options.cls && this.element.addClass(this.options.cls);
      this.selects = $($.map(this.options.names, function (name) {
        return $('<select class=""/>').addClass(that.options.selectCls).attr('name', strbuf(that.options.nameTemplate, that.options.name, name))[0];
      })).appendTo(this.element)
        .hide()
        .change(function () {
          var nextSelects = $(this).nextAll('select').hide().empty();
          if (this.value) {
            $(this).trigger("validate"); // trigger validate event to hide nice validator msg
            that.setOptions(nextSelects.first(), this.value);
          }
        });
      this.val(this.options.value);
    },
    val: function (value) {
      this.setOptions(this.selects.eq(0), this.options.root_id, value[0]);
      for (var i = 0; i < value.length; i++) {
        value[i] && this.setOptions(this.selects.eq(i + 1), value[i], value[i + 1]);
      }
    },
    setOptions: function (select, parent_id, selectedId) {
      var dataSource = this.options.data;
      var options = new strbuf('<option value="">请选择</option>');
      for (var i = 0; i < dataSource.length; i++) {
        var item = dataSource[i];
        if (item[this.options.keys[2]] == parent_id) {
          var selected = selectedId && selectedId == item[this.options.keys[0]] ? 'selected' : '';
          options.push('<option value="{0}" {2}>{1}</option>', item[this.options.keys[0]], item[this.options.keys[1]], selected);
        }
      }
      options.__data.length > 1 && select.html(options.toString()).show();
      return select;
    }
  };

  InterSelect.DEFAULTS = {
    cls: 'inter-select',
    selectCls: 'form-control',
    name: '',
    names: [0, 1, 2],
    nameTemplate: '{1}',
    keys: ['id', 'name', 'parent_id'],
    value: [],
    root_id: 0,
    data: []
  };

  ControlManager.register('interSelect', InterSelect);
})();
