<?php
/**
 * Created by brook
 * Date: 3/30/16 3:22 PM
 */
/* @var $this \yii\web\View */

$this->title = 'Reserving System';

$this->params['breadcrumbs'][] = ['label' => 'Demo', 'url' => '/demo'];
$this->params['breadcrumbs'][] = $this->title;

common\assets\vendor\FullCalendarAsset::register($this);
common\assets\vendor\NotifyAsset::register($this);

$this->registerCssFile('@asset/css/backend/reserving.css');
?>
<style>
h1, h2 { font-weight: 100; }
h1 { text-align: center; display: none; }

.fc th { font-weight: 400; }
</style>
<div id="calendar"></div>
<dl class="text-muted usage">
    <dt>使用帮助</dt>
    <dd>
        <ol>
            <li>点击或拖选区域创建预约</li>
            <li>拖动更改预约时间</li>
            <li>拖动预约下面的=号更改预约时长</li>
    </dd>
</dl>


<script id="pop_tpl" type="text/html">
<div class="bubble">
    <a class="close" href="javascript:">&times;</a>
    <form action="reservation-update" method="post">
        <input name="id" type="hidden" value="${id}"/>
        <input name="start" type="hidden" value="${start}"/>
        <input name="end" type="hidden" value="${end}"/>
        <div class="group-wrap">
            <label>时间：</label>
            <div class="input-wrapper">${time}</div>
        </div>
        <div class="group-wrap">
            <label>标题：</label>
            <div>
                <input class="input" type="text" name="title" value="${title}"/>
                <span class="text-muted space-before">例如：技术部周例会</span>
            </div>
        </div>
        <div class="group-wrap">
            <label>地点：</label>
            <select class="input-wrapper" name="room_id"></select>
        </div>
        <div class="group-wrap" style="padding-bottom:3px">
            <label></label>
            <div class="input-wrapper">
                <a href="event-del" class="pull-right btn-delete" data-id="${id}">删除</a>
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
    <div class="arrow"></div>
</div>
</script>
<script>
$(function() {

    $.notify.defaults({
        autoHideDelay: 3000,
        globalPosition: 'top center',
        elementPosition: 'right middle',
        className: 'success'
    });

    var rooms = [
        { id: 0, name: '培训室(40人)', color: '', deleted: 0 },
        { id: 1, name: 'VIP会议室(20人)', color: '#42c176'},
        { id: 2, name: '会议室1(10人)', color: '#f99338'},
        { id: 3, name: '会议室2(8人)', color: '#bd4af1'},
        { id: 4, name: '会议室3(10人)', color: '#608ff5'}
    ];
    var roomsAvailable = rooms.filter(function(room) {
        return !room.deleted;
    });
    var options = new strbuf();
    options.pushArray('<option value="${id}">${name}</option>', roomsAvailable);

    function popAdd(evt, jsEvent, view) {
        popClose(); // close other pops

        if(!('id' in evt) && (evt.start - 480*60*1000 < new Date())) {
            $.notify('预约时间必须大于当前时间！', 'warn');
            calendar.fullCalendar('unselect');
            return;
        }

        var eventData = {
            id: evt.id,
            title: evt.title,
            start: evt.start.unix(),
            end: evt.end ? evt.end.unix() : '',
            time: $.fullCalendar.formatRange(evt.start, evt.end || evt.start.add(1, 'hour'), 'MMMM D H:mm')
        };
        var html = strbuf($('#pop_tpl').html(), eventData, '');
        var pop = $(html).appendTo(document.body);
        pop.find('.close').click(function() {
            popClose();
            calendar.fullCalendar('unselect'); // cancel selected.
        });
        pop.keydown(function(e) {
            if(e.which === 27) {
                pop.find('.close').click();
            }
        });
        pop.find('[name=title]').select();
        var selectRoom = pop.find('[name=room_id]').html(options.toString());
        if(evt.room_id != null && rooms[evt.room_id].deleted) { // deleted room

        } else {
            selectRoom.val(evt.room_id || roomsAvailable[0].id);
        }
        pop.find('.btn-delete').toggle('id' in evt).click(function() {
            var id = $(this).data('id');
            $.post('reservation-del', { id: id }, function(json) {
                if(json.code === 0 ) {
                    calendar.fullCalendar('removeEvents', id );
                    $.notify('删除成功！');
                    popClose();
                }
            });
            return false;
        });
        // position
        var element = $(jsEvent.target).closest('.fc-event');
        var sty = element.offset(), cls = 'bubble-top';
        if(!sty) {
            sty = { left: jsEvent.pageX, top: jsEvent.pageY };
        }
        sty.left -= (pop.outerWidth() - element.outerWidth()) / 2;
        if(sty.top - pop.outerHeight() - 12 > $(document).scrollTop()) {
            sty.top -= pop.outerHeight() + 12;
        } else {
            cls = 'bubble-bottom';
            sty.top += element.outerHeight() + 12;
        }
        pop.addClass(cls).css(sty);

        pop.find('form').submit(function() {
            var form = this;
            var titleInput = form.title;
            if(!titleInput.value.trim().length) {
                $(titleInput).notify('请输入标题！', 'warn')
                titleInput.focus();
                return false;
            }
            $.post(this.action, $(this).serialize(), function(json) {
                if(json.code === 0) {
                    if(json.data) { // add
                        var event = {
                            id: json.data,
                            title: form.title.value,
                            room_id: form.room_id.value,
                            start: form.start.value,
                            end: form.end.value
                        };
                        calendar.fullCalendar('renderEvent', event);
                        calendar.fullCalendar('unselect'); // unselect to update UI.
                    } else {
                        $.extend(evt, {
                            title: form.title.value,
                            room_id: form.room_id.value,
                            color: rooms[form.room_id.value].color
                        });
                        calendar.fullCalendar('updateEvent', evt);
                    }

                    $.notify('保存成功！');
                    popClose();
                }
            });
            return false;
        });
    }
    function popClose() {
        $('.bubble').remove();
    }
    $(document).click(function(e) {
        if(!$(e.target).closest('#calendar,.bubble').length) {
            popClose();
        }
    });

    function updateEvent(event, delta, revertFunc) {
        var params = {
            id: event.id,
            start: event.start.unix(),
            end: event.end ? event.end.unix() : ''
        };
        $.post('reservation-update', params, function(json) {
            if(json.code === 0 ) {
                $.notify('更新成功！');
            }
        });
    }

    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        defaultTimedEventDuration: '01:00',
        allDaySlot: false,
        scrollTime: '08:00',
        businessHours: {
            start: '9:00',
            end: '18:00'
        },
        height: 600,
        lang: /^en-/.test(navigator.language) ? 'en' : 'zh-cn',
        eventOverlap: function(stillEvent, movingEvent) {
            return true;
        },
        events: function(start, end, timezone, callback) {
            $.get('reservations', {start: start.unix(), end: end.unix()}, function(json) {
                if(json.code === 0) {
                    callback(json.data);
                }
            });
        },
        eventDataTransform: function(eventData) {
            if( 'room_id' in eventData ) {
                eventData.start = moment.unix(eventData.start - 0).utcOffset(0).format();
                eventData.end && (eventData.end = moment.unix(eventData.end - 0).utcOffset(0).format());
                eventData.color = eventData.room_id && rooms[eventData.room_id].color;
            }
            return eventData;
        },
        editable: true,
        eventDrop: updateEvent,
        eventResize: updateEvent,
        eventClick: popAdd,
        selectable: true,
        selectHelper: true,
        select: function(start, end, jsEvent, view) {
            popAdd.call(this, {start: start, end: end}, jsEvent, view);
        },
        unselectCancel: '.bubble',
        unselect: function() {
            popClose();
        },
        eventRender: function(event, element) {
            var start = moment.unix(event.start.unix() - 480*60).fromNow();
            if(event.room_id) { // 点击添加时没有 room_id
                element.attr('title', rooms[event.room_id].name + ' ' + start);
            }
        },
        loading: function() {

        }
    });

});
</script>
