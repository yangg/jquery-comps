(function() {
    function FillCalendar(element, options) {
        this.element = $(element);
        this.options = $.extend({}, this.constructor.DEFAULTS, options);
        var today = new Date();
        this.init(today.getFullYear(), today.getMonth() + 1);
    }
    FillCalendar.DEFAULTS = {
        firstDay: 0,
        weekNames: ['日', '一', '二', '三', '四', '五', '六'],
//            weekNames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
//            monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
//                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        dayClick: $.noop
    };
    FillCalendar.prototype = {
        constructor: FillCalendar,
        init: function(year, month) {
            var today = new Date();
            today.setHours(0, 0, 0, 0);
            var monthDay = new Date(year, month - 1, 1);
            var d, day;
            var start = monthDay;

            this.html = new strbuf('<table class="fill-calendar">\n<thead>');
            this.html.push('<tr>');
            this.html.push('<th align=center colspan="7"><a href="javascript:" class="goto-prev"><i class="icon i-angleleft"></i></a><span class="current-month">{0}年{1}月</span><a href="javascript:" class="goto-next"><i class="icon i-angleright"></i></a></th>', monthDay.getFullYear(), monthDay.getMonth() + 1);
            this.html.push('</tr>');
            this.html.push('<tr>');
            for(var i = this.options.firstDay; i < this.options.firstDay + 7; i++) {
                d = i % 7;
                this.html.push('<th>星期{0}</th>', this.options.weekNames[d]);
            }
            this.html.push('</tr>');
            this.html.push('</thead>\n<tbody>');
            var monthEnd = new Date(monthDay.getFullYear(), monthDay.getMonth() + 1, 0);
            var end  = monthEnd;
            // days in previous month
            if(monthDay.getDay() != this.options.firstDay) { // 当月第一天不是本周第一天
                this.html.push('<tr>');
                d = (this.options.firstDay - monthDay.getDay() - 6) % 7;
                start = new Date(monthDay.getFullYear(), monthDay.getMonth(), d);
                for(; d < 1; d++ ) {
                    day = new Date(monthDay.getFullYear(), monthDay.getMonth(), d);
                    this.renderDay(day, 'other-month');
                }
            }
            // days in this month
            for(d = 1; d <= monthEnd.getDate(); d++ ) {
                day = new Date(monthDay.getFullYear(), monthDay.getMonth(), d);
                if(day.getDay() == this.options.firstDay) {
                    this.html.push('<tr>');
                }
                this.renderDay(day, day.getTime() == today.getTime() ? 'today' : '');
                if(day.getDay() == ((this.options.firstDay + 6) % 7)) {
                    this.html.push('</tr>\n');
                }
            }
            // days in next month
            if(monthEnd.getDay() != ((this.options.firstDay + 6) % 7)) {  // 当月最后一天不是本周最后一天
                for(d = monthEnd.getDate() + 1; d < monthEnd.getDate() + (7 + this.options.firstDay - monthEnd.getDay()); d++ ) {
                    day = new Date(monthDay.getFullYear(), monthDay.getMonth(), d);
                    this.renderDay(day, 'other-month');
                }
                this.html.push('</tr>\n');
                end = day;
            }
            this.html.push('</tbody></table>');
            this.element.html(this.html.toString());
            var self = this;
            this.element.find('.goto-prev, .goto-next').click(function() {
                self.init(year, month + ($(this).hasClass('goto-prev') ? -1 : 1));
            });
            this.element.find('tbody').on('click', 'td', function(e) {
                self.options.dayClick.call(self, e, this);
            });

            $.getJSON(this.options.data.url, {start: start.getTime(), end: end.getTime()})
                .done(function(json) {
                    if(json.code === 0) {
                        self.element.find('tbody td').each(function() {
                            var cell = $(this);
                            var data = json.data[cell.data('day')];
                            cell.append(self.options.data.transform(this, data));
                        });
                    }
                });
        },
        renderDay: function(day, cls) {
            var dayStr = day.getFullYear() + '-' + (day.getMonth() + 1) + '-' + day.getDate();
            this.html.push('<td class="{0}" data-day="{1}"><div class="day-number">{2}</div></td>', cls || '', dayStr, day.getDate());
        }
    };
    ControlManager.register(FillCalendar);
})();