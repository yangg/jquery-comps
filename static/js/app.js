(function() {
    //$.fn.modal.Constructor.DEFAULTS.backdrop = 'static';
    $.modal = function(option, _relatedTarget) {
        // TODO: styling loading.
        option.remote && (option.content = '<div class="loading"><i class="fa fa-refresh fa-spin"></i> Loading</div>');
        var $target = $(option.target);
        if(!option.target) {
            var targetHtml = '<div class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="loading text-muted"><i class="fa fa-refresh fa-spin"></i> Loading...</div></div></div></div>';
            $target = $(targetHtml).appendTo(document.body);
            option.width && $target.find('.modal-dialog').width(option.width);
            //option.target && $target.attr('id', option.target.replace(/^#/, ''));
        } else {
            if(!$target.find('.modal-dialog').length) {
                $target.wrapInner('<div class="modal-dialog"><div class="modal-content"></div></div>');
            }
        }
        $target.one('show.bs.modal', function (showEvent) {
            if (showEvent.isDefaultPrevented()) return; // only register focus restorer if modal will actually get shown
            $target.one('hidden.bs.modal', function () {
                var $related = $(_relatedTarget);
                _relatedTarget && $related.is(':visible') && $related.trigger('focus')
            })
        });
        if($target.data('bs.modal')) {
            option = 'toggle';
        }
        return $target.modal(option, _relatedTarget)
            .on('hidden.bs.modal', function (e) {
                !this.id && $(this).remove();
            });

    };
    $(document).off('.modal.data-api')
        .on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
            var $this   = $(this);
            var href    = $this.attr('href');
            var option = $.extend({ remote: !/#/.test(href) && href }, $this.data());

            if ($this.is('a')) e.preventDefault();

            $.modal(option, this);
        });

    $.flash = function(config, type) {
        config = $.extend({}, {
            type: 'ok',
            hide: 2000
        }, typeof config == 'object' ? config : {msg: config, type: type});
        config.icon = {ok: 'check', error: 'times'}[config.type];
        var html = strbuf('<div class="flash flash-${type}"><i class="fa fa-${icon}"></i>${msg}</div>', config);
        var obj = $(html).appendTo(document.body);
        setTimeout(function() {
            obj.addClass('show');
            setTimeout(function() {
                obj.removeClass('show');
            }, config.hide);
        }, 0);
    };
})();



$(function() {
    function doRequest() {
        var link = $(this),
            href = this.href || link.data('href'),
            params = link.data('params');
        $.post(href, params, function(json) {
            if(json.code === 0) {
                link.trigger($.Event('complete', {json: json}));
            } else {
                //$.flash(json.msg, 'error');
            }
        }, 'json');
    }

    $('body').popover({
        selector: '[data-toggle="confirm"]',
        placement: 'auto bottom',
        content: function() {
            var target = $(this);
            var body = $('<div class="confirm-body">'+ $(this).data('msg') +'</div><div class="confirm-footer text-center" ><button type="button" class="btn" data-dismiss="popover">取消</button><button type="button" class="btn btn-primary">确认</button></div>');
            body.find('[data-dismiss]').click(function() {
                target.popover('destroy');
            });
            body.find('.btn-primary').click(function() {
                doRequest.call(target[0]);
                target.popover('destroy');
            });
            return body;
        },
        container: 'body',
        html: true
    });
    $(document).on('click', '[data-toggle=confirm],[data-toggle=request]', function(e) {
        var $this = $(this);
        if ($this.is('a')) {
            e.preventDefault();
        }
        if($this.data('toggle') == 'request') {
            doRequest.call(this);
        }
    }).on('complete', '[data-toggle=confirm],[data-toggle=request]', function(e) {
        if(e.json.href) {
            location.href = e.json.href;
        } else {
            location.reload();
        }
    });


    $.extend($.fn.button.Constructor.DEFAULTS, {loadingText: '保存中...'});
    $.extend($.fn.tooltip.Constructor.DEFAULTS, {container: 'body'});
    ControlManager.triggers.push('tooltip'); // trigger bootstrap tooltip
    ControlManager.init(); // init after all controls loaded
});