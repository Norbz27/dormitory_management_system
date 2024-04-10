(function($) {

    "use strict";

    $(document).ready(function() {
        var section = $('.ftco-section');

        if (section.length) {
            var today = new Date(),
                year = today.getFullYear(),
                month = today.getMonth(),
                monthTag = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                day = today.getDate(),
                days = section.find('td'),
                selectedDay,
                setDate,
                daysLen = days.length;

            function Calendar(selector, options) {
                this.options = options;
                this.draw();
            }

            Calendar.prototype.draw = function() {
                this.getCookie('selected_day');
                this.getOptions();
                this.drawDays();
                var that = this,
                    reset = section.find('#reset'),
                    pre = section.find('.pre-button'),
                    next = section.find('.next-button');

                pre.on('click', function() { that.preMonth(); });
                next.on('click', function() { that.nextMonth(); });
                reset.on('click', function() { that.reset(); });

                days.on('click', function() { that.clickDay(this); });
            };

            Calendar.prototype.drawHeader = function(e) {
                var headDay = section.find('.head-day'),
                    headMonth = section.find('.head-month');

                e ? headDay.html(e) : headDay.html(day);
                headMonth.html(monthTag[month] + " - " + year);
            };

            Calendar.prototype.drawDays = function() {
                var startDay = new Date(year, month, 1).getDay(),
                    nDays = new Date(year, month + 1, 0).getDate(),
                    n = startDay;

                days.each(function(index) {
                    var currentDay = $(this);
                    currentDay.html('').removeAttr('id').removeClass();

                    if (index >= startDay && index < startDay + nDays) {
                        currentDay.html(index - startDay + 1);
                    }
                });

                for (var j = 0; j < 42; j++) {
                    var currentDay = days.eq(j);
                    if (currentDay.html() === "") {
                        currentDay.attr('id', 'disabled');
                    } else if (j === day + startDay - 1) {
                        if ((this.options && (month === setDate.getMonth()) && (year === setDate.getFullYear())) || (!this.options && (month === today.getMonth()) && (year === today.getFullYear()))) {
                            this.drawHeader(day);
                            currentDay.attr('id', 'today');
                        }
                    }
                    if (selectedDay) {
                        if ((j === selectedDay.getDate() + startDay - 1) && (month === selectedDay.getMonth()) && (year === selectedDay.getFullYear())) {
                            currentDay.addClass("selected");
                            this.drawHeader(selectedDay.getDate());
                        }
                    }
                }
            };

            Calendar.prototype.clickDay = function(o) {
                var selected = section.find(".selected"),
                    len = selected.length;
                if (len !== 0) {
                    selected.removeClass("selected");
                }
                $(o).addClass("selected");
                selectedDay = new Date(year, month, $(o).html());
                this.drawHeader($(o).html());
                this.setCookie('selected_day', 1);
            };

            Calendar.prototype.preMonth = function() {
                if (month < 1) {
                    month = 11;
                    year = year - 1;
                } else {
                    month = month - 1;
                }
                this.drawHeader(1);
                this.drawDays();
            };

            Calendar.prototype.nextMonth = function() {
                if (month >= 11) {
                    month = 0;
                    year = year + 1;
                } else {
                    month = month + 1;
                }
                this.drawHeader(1);
                this.drawDays();
            };

            Calendar.prototype.getOptions = function() {
                if (this.options) {
                    var sets = this.options.split('-');
                    setDate = new Date(sets[0], sets[1] - 1, sets[2]);
                    day = setDate.getDate();
                    year = setDate.getFullYear();
                    month = setDate.getMonth();
                }
            };

            Calendar.prototype.reset = function() {
                month = today.getMonth();
                year = today.getFullYear();
                day = today.getDate();
                this.options = undefined;
                this.drawDays();
            };

            Calendar.prototype.setCookie = function(name, expiredays) {
                if (expiredays) {
                    var date = new Date();
                    date.setTime(date.getTime() + (expiredays * 24 * 60 * 60 * 1000));
                    var expires = "; expires=" + date.toGMTString();
                } else {
                    var expires = "";
                }
                document.cookie = name + "=" + selectedDay + expires + "; path=/";
            };

            Calendar.prototype.getCookie = function(name) {
                if (document.cookie.length) {
                    var arrCookie = document.cookie.split(';'),
                        nameEQ = name + "=";
                    for (var i = 0, cLen = arrCookie.length; i < cLen; i++) {
                        var c = arrCookie[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1, c.length);
                        }
                        if (c.indexOf(nameEQ) === 0) {
                            selectedDay = new Date(c.substring(nameEQ.length, c.length));
                        }
                    }
                }
            };

            var calendar = new Calendar();
        }
    });

})(jQuery);
