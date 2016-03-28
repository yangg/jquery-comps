/**
 * Created by brook on 4/17/15.
 */

(function() {

  function TabsSelect(element, config) {
    element = this.element = $(element);
    this.config = $.extend({cls: 'tabs-select'}, config);

    var that = this;
    this.searchBox = element.addClass(this.config.cls).find('.search-box');
    this.searchInput = element.find('.item-search input').focus(function () {
      that.toggle(true);
    }).keypress(function () {
      return false;
    }).prop('readonly', true);
    this.itemList = element.find('.item-list').on('click', '.item-remove', function () {
      var id = $(this).parent().remove().find('input').val();
      that.findItems([id]).removeClass('active');
      that.element.trigger('change');
    });
    element.find('.search-tab').on('click', 'li', function () {
      var active = $(this).addClass('active');
      active.siblings().removeClass('active');
      var currentTab = active.data('letters');
      var scrollBody = active.parent().next(); // .tab-content
      var position = scrollBody.children().children()
          .filter('[data-letters="' + currentTab + '"]').position();
      if(!position) {
        return;
      }
      var scrollTop = position.top;
      scrollBody.animate({scrollTop: scrollTop}, 'fast');
    });
    element.find('.tab-content').on('click', 'li', function () {
      var item = $(this);
      if (item.hasClass('active')) {
        return;
      }
      item.addClass('active');
      that.addItem({text: item.text(), id: item.data('id')});
      that.element.trigger('change');
    }).on('scroll', function () {
      var items = $(this).children().children();
      var scrollTop = this.scrollTop;
      items.each(function () {
        // find the first visible item
        var $this = $(this);
        if ($this.position().top > scrollTop) {
          element.find('.search-tab li[data-letters="' + $this.data('letters') + '"]')
            .addClass('active').siblings().removeClass('active');
          return false;
        }
      });
    });
    element.click(function (e, isInit) {
      if (!isInit) { // don't focus when initializing selected item.
        if (!that.element.hasClass('form-control-focused')) {
          that.searchInput.focus();
        } else {
          if ($(e.target).closest('.search-box')[0] != that.searchBox[0] && e.target != that.searchInput[0]) {
            // 点击弹出层中的内容不隐藏
            that.toggle(false);
          }
        }
      }
      e.stopPropagation();
    });
    $(document).click(function () {
      that.toggle(false);
    });
    var vals = element.data('value');
    if (vals && vals.length) {
      this.findItems(vals).trigger('click', [true]);
    }
  }

  TabsSelect.prototype = {
    constructor: TabsSelect,
    toggle: function (show) {
      show = !!show;
      this.element.toggleClass('form-control-focused search-container-below', show);
      this.searchBox.toggle(show);
    },
    findItems: function (ids) {
      return this.element.find(ids.map(function (v) {
        return 'li[data-id="' + v + '"]';
      }).join(','));
    },
    addItem: function (data) {
      var itemHtml = strbuf('<li class="list-item">${text} <span class="item-remove">&times;</span><input type="hidden" value="${id}" name="' + this.config.name + '" /></li>', data);
      this.itemList.find('.item-search').before(itemHtml);
    }
  };
  window.ControlManager && ControlManager.register(TabsSelect);
})();
