/**
 * Created by brook on 1/16/16.
 */

(function() {

    function CatTree(element, config) {
        this.config = $.extend({}, this.constructor.DEFAULTS, config);
        this.element = $(element).addClass('cat-tree');
        this.init();
    }
    CatTree.prototype = {
        constructor: CatTree,
        toggle: function(show) {
            show = !!show;
            this.element.toggleClass('form-control-focused search-container-below', show);
            this.pop.toggle(show);
        },
        init: function() {
            var that = this;
            this.label = $('<div class="tree-label">&nbsp;</div>').appendTo(this.element)
                .click(function() {
                    that.toggle(!that.element.hasClass('form-control-focused'));
                });
            this.input = $(strbuf('<input type=hidden name="{0}"/>', this.config.name)).appendTo(this.element);

            this.pop = $('<div class="cat-box">' +
                '<div class="search-wrap"><input type="text" class="form-control input-sm" placeholder="搜索"/></div>' +
                '<div class="tree-wrap"></div>' +
                '</div>').appendTo(this.element);

            var isInputSupported = 'oninput' in document.createElement('input');
            this.pop.find('input').on(isInputSupported ? ' input' : 'propertychange keyup paste', function() {
                that.tree.jstree(true).search(this.value);
            });

            $(document).click(function(e) {
                var target = $(e.target);
                if(target.closest('.cat-tree')[0] == that.element[0]) {
                    return;
                }
                that.toggle(false);
            });

            this.renderTree();
        },
        renderTree: function() {
            var that = this;
            this.tree = this.pop.find('.tree-wrap')
                .on("select_node.jstree", $.proxy(this.nodeSelected, this))
                .on('ready.jstree', function(e, data) {
                    var selectedId = that.config.value.slice(-1)[0];
                    data.instance.select_node(selectedId);
                })
                .jstree({
                    core : {
                        animation: true,
                        multiple: false,
                        themes: {
                            icons: false
                        },
                        data: {
                            url: '/demo/cat-tree',
                            dataType : "json"
                        }
                    },
                    plugins : [ "search" ],
                    search: {
                        show_only_matches: true
                    }
                });
        },
        nodeSelected: function(e, data) {
            var selectedNode = data.node;
            if(!selectedNode.children.length) { // is leaf
                var selectedIds = [selectedNode.id].concat(selectedNode.parents);
                selectedIds.reverse();
                selectedIds.shift();
                this.input.val('[' + selectedIds + ']');
                this.label.text(selectedNode.text);
                this.toggle(false);
            }
        }
    };
    CatTree.DEFAULTS = {
        value: [],
        name: null
    };
    window.ControlManager && ControlManager.register(CatTree);
})();
