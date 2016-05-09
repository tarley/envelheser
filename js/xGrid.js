(function ($) {
    var dataKey = "xGrid";

    var DEFAULT_SETTINGS = {
        dataSource: {},
        columns: [],

        onRowDataBound: null,
        onComplete: null
    };

    var methods = {
        init: function (options) {
            var settings = $.extend({}, DEFAULT_SETTINGS, options || {});

            return this.each(function () {
                $(this).data(dataKey, new $.Grid(this, settings));
            });
        },
        reload: function () {
            this.data(dataKey).reload();
            return this;
        },
        filter: function (params) {
            this.data(dataKey).filter(params);
            return this;
        }
    }

    $.fn.xGrid = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else {
            return methods.init.apply(this, arguments);
        }
    };

    $.Grid = function (element, settings) {
        var pageSizeValues = [1, 5, 10, 20, 50, 100, 250, 500, 1000];
        var pageSize = 20;
        var pageIndex = 1;
        var pageCount = 1;
        var sortColumn = "";
        var sortOrder = "ASC";
        var filterParam = "";

        var elem = $(element);
        var grid;

        prepare();
        initGrid();
        loadData();

        //
        // Public Functions
        //

        this.reload = function () {
            loadData();
        }

        this.filter = function (params) {
            filterParam = params;
            loadData();
        }

        //
        // Private Functions
        //

        function prepare() {
            if (settings.pager && $.inArray(settings.pager.pageSize, pageSizeValues) != -1)
                pageSize = settings.pager.pageSize;

            if (settings.sorting && settings.sorting.enabled) {
                if (settings.sorting.defaultSortColumn)
                    sortColumn = settings.sorting.defaultSortColumn;

                if (settings.sorting.defaultSortOrder)
                    sortOrder = settings.sorting.defaultSortOrder;
            }
        }

        function initGrid() {

            grid = $("<table>");

            createHeader();

            setAttributes(settings.gridAttributes, grid);
            elem.append(grid);
        }

        function createHeader() {
            var header = $("<tr>");
            header.attr("role", "headerRow");

            for (var i = 0; i < settings.columns.length; i++) {

                var col = settings.columns[i];
                var text = (col.title) ? col.title : col.field;
                var cell = $("<th>");

                if (settings.sorting && settings.sorting.enabled && col.field) {
                    var link = $("<a>");
                    link.prop("href", "#");
                    link.attr("data-field", col.field);
                    link.attr("data-dir", "ASC");
                    link.text(text);
                    link.click(changeSort);

                    cell.append(link);
                }
                else
                    cell.text(text);

                cell.attr("role", "headerCell");

                setAttributes(col.attributes, cell);

                if ($.isFunction(settings.onRowDataBound))
                    settings.onRowDataBound.call(this, col, cell);

                header.append(cell);
            }

            setAttributes(settings.headerAttributes, header);
            grid.append(header);
        }

        function loadData() {
            if (settings.dataSource.url) {

                var data = filterParam;
                data += (data != "") ? "&" : "";
                data += "pageSize=" + pageSize + "&";
                data += "pageIndex=" + pageIndex + "&";
                data += "sortColumn=" + sortColumn + "&";
                data += "sortOrder=" + sortOrder + "&";

                $.ajax({
                    url: settings.dataSource.url,
                    method: "POST",
                    data: data,
                    success: function (data) {
                    	
                    	var obj = jQuery.parseJSON(data);
                    	
                        pageCount = obj.PageCount;

                        if (pageIndex > pageCount)
                            pageIndex = pageCount;
                        
                        fillGrid(obj.Collection);
                        fillPager();
                    }
                });
            }
        }

        function fillGrid(data) {
            //Limpa os dados do grid antes de preencher
            $("tr[role='dataRow']", grid).remove();

            if (settings.rowAttributes && !settings.rowAltAttributes)
                settings.rowAltAttributes = settings.rowAttributes;

            for (var i = 0; i < data.length; i++) {
                var rowData = data[i];
                var row = $("<tr>");
                row.attr("role", "dataRow");

                setAttributes(((i % 2 == 0) ? settings.rowAttributes : settings.rowAltAttributes), row);

                for (var j = 0; j < settings.columns.length; j++) {
                    var column = settings.columns[j];
                    var cell = $("<td>");
                    cell.attr("role", "dataCell");

                    if (settings.lineClick) {
                        if (!settings.lineClick.cellsWithoutClick || jQuery.inArray(j, settings.lineClick.cellsWithoutClick) == -1) {
                            var key = rowData[settings.lineClick.keyField];
                            var controller = settings.lineClick.controller;
                            var action = settings.lineClick.action;
                            var url = replaceTemplateKeys(settings.lineClick.url, rowData) ;

                            if (settings.lineClick.onClick && $.isFunction(settings.lineClick.onClick))
                                cell.click({ key: key, row: row }, settings.lineClick.onClick);
                            else if (controller && action)
                                column.attributes = addAttribute(column.attributes, "onclick", "window.location='/" + controller + "/" + action + "/" + key + "'", true);
                            else if(url)
                            	column.attributes = addAttribute(column.attributes, "onclick", "window.location='" + url + "'", true);

                            column.attributes = addAttribute(column.attributes, "style", "cursor: pointer;", false);
                        }
                    }

                    if (column.field) {
                        var cellData = rowData[column.field];

                        if (column.type && column.type.toUpperCase() === "DATE") {
                            cellData = $.formatDate(cellData, column.format);
                        }

                        cell.text(cellData);
                    } else if (column.command) {
                        var cmd = $("<a>");
                        var key = rowData[column.command.keyField];

                        var controller = column.command.controller;
                        var action = column.command.action;

                        if (controller && action)
                            cmd.prop("href", "/" + controller + "/" + action + "/" + key);

                        if (column.command.text)
                            cmd.text(column.command.text);

                        if (column.command.toolTip)
                            cmd.attr("title", column.command.toolTip);

                        if (column.command.onCall && $.isFunction(column.command.onCall))
                            cmd.click({ key: key, row: row }, column.command.onCall);

                        if (column.command.confirm && !column.command.onCall)
                            cmd.attr("onclick", "return confirm('" + column.command.confirm + "');")

                        setAttributes(column.command.attributes, cmd);
                        cell.append(cmd);
                    }
                    else if (column.template) {
                        var template = replaceTemplateKeys(column.template, rowData);
                        cell.append(template);
                    }

                    setAttributes(column.attributes, cell);
                    row.append(cell);
                }

                grid.append(row);
            }
        }

        function fillPager() {
            if (settings.pager) {
                $("tr[role='pagerRow']", grid).remove();
                $("tr[role='headerRow']", grid).before(createPager());

                if (pageCount > 1 && pageIndex < pageCount)
                    grid.append(createPager());
            }
        }

        function createPager() {
            var pager = $("<tr>");
            pager.attr("role", "pagerRow");

            var pagerCell = $("<td>");
            pagerCell.attr("role", "pagerCell");
            pagerCell.attr("colspan", settings.columns.length);

            createPageCtrl(pagerCell);
            createPageSizer(pagerCell);

            pager.append(pagerCell);

            setAttributes(settings.pager.attributes, pager);

            return pager;
        }

        function createPageCtrl(pagerCell) {
            $(".page-ctrl", pagerCell).remove();

            var pageCtrl = $("<div>");
            pageCtrl.prop("class", "page-ctrl");

            if (pageIndex != 1) {
                var first = $("<a>").text("Primeira");
                first.attr("data-page", 1);
                first.click(changePage);
                pageCtrl.append(first);

                var prev = $("<a>").text("Anterior");
                prev.attr("data-page", pageIndex - 1);
                prev.click(changePage);
                pageCtrl.append(prev);
            }

            var pages = $("<span>");
            pages.text("Página " + pageIndex + "/" + pageCount);
            pageCtrl.append(pages);

            if (pageIndex < pageCount) {
                var next = $("<a>").text("Próxima");
                next.attr("data-page", pageIndex + 1);
                next.click(changePage);
                pageCtrl.append(next);

                var last = $("<a>").text("Ultima");
                last.attr("data-page", pageCount);
                last.click(changePage);
                pageCtrl.append(last);
            }

            pagerCell.append(pageCtrl);
        }

        function createPageSizer(pagerCell) {
            if (settings.pager.allowPageSize) {
                $(".page-sizer", pagerCell).remove();

                var pageSizer = $("<div>");
                pageSizer.prop("class", "page-sizer");

                var drop = $("<select>");

                for (var i = 0; i < pageSizeValues.length; i++)
                    drop.append("<option value='" + pageSizeValues[i] + "'>" + pageSizeValues[i] + "</option>");

                var option = $("option[value='" + pageSize + "']", drop);
                option.prop("selected", true);

                drop.change(changePageSize);

                pageSizer.append(drop);
                pagerCell.append(pageSizer);
            }
        }

        // Event Functions - Start

        function changePageSize(e) {
            var drop = $(e.currentTarget);
            var option = $("option:selected", drop);
            pageSize = parseInt(option.val());
            loadData();
        }

        function changePage(e) {
            var a = $(e.currentTarget);
            pageIndex = parseInt(a.attr("data-page"));
            loadData();
        }

        function changeSort(e) {
            var a = $(e.currentTarget);
            sortColumn = a.attr("data-field");
            sortOrder = a.attr("data-dir");

            a.attr("data-dir", ((sortOrder == "ASC") ? "DESC" : "ASC"));
            loadData();
        }

        // Event Functions - End

        // Util Functions - Start

        function setAttributes(attrArray, elem) {
            if (attrArray) {
                for (var i = 0; i < attrArray.length; i++) {
                    elem.attr(attrArray[i]);
                }
            }
        }

        function addAttribute(attrArray, attrKey, attrValue, replaceExisting) {

            if (!attrArray)
                attrArray = [];

            var idx = searchObjByProp(attrArray, attrKey);

            if (idx >= 0) {
                if (replaceExisting)
                    attrArray[idx][attrKey] = attrValue;
                else if (attrArray[idx][attrKey].indexOf(attrValue) == -1)
                    attrArray[idx][attrKey] += attrValue;
            }
            else {
                var obj = {}
                obj[attrKey] = attrValue;

                attrArray.push(obj);
            }

            return attrArray;
        }

        function searchObjByProp(objArray, propName) {
            for (var i = 0; i < objArray.length; i++) {
                if (objArray[i][propName]) {
                    return i;
                }
            }

            return -1;
        }

        function replaceTemplateKeys(html, rowData) {
            var keys = html.match(/\{#.*?}/g);

            if (keys) {
                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i].replace(/\{#(.*?)}/g, "$1");

                    if (rowData[prop]) {
                        html = html.replace(keys[i], rowData[prop])
                    }
                }
            }

            return html;
        }

        //Util Functions - End

    }
}(jQuery));

//============= DATE FORMAT ==============//
(function ($) {

    var daysInWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var shortDaysInWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var shortMonthsInYear = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var longMonthsInYear = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var shortMonthsToNumber = { 'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04', 'May': '05', 'Jun': '06', 'Jul': '07', 'Aug': '08', 'Sep': '09', 'Oct': '10', 'Nov': '11', 'Dec': '12' };

    var YYYYMMDD_MATCHER = /\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.?\d{0,3}[Z\-+]?(\d{2}:?\d{2})?/;

    $.formatDate = function (value, format) {

        if (!format)
            format = "dd/MM/yyyy";

        return date(value, format);

        function numberToLongDay(value) {
            // 0 to Sunday
            // 1 to Monday
            return daysInWeek[parseInt(value, 10)] || value;
        }

        function numberToShortDay(value) {
            // 0 to Sun
            // 1 to Mon
            return shortDaysInWeek[parseInt(value, 10)] || value;
        }

        function numberToShortMonth(value) {
            // 1 to Jan
            // 2 to Feb
            var monthArrayIndex = parseInt(value, 10) - 1;
            return shortMonthsInYear[monthArrayIndex] || value;
        }

        function numberToLongMonth(value) {
            // 1 to January
            // 2 to February
            var monthArrayIndex = parseInt(value, 10) - 1;
            return longMonthsInYear[monthArrayIndex] || value;
        }

        function shortMonthToNumber(value) {
            // Jan to 01
            // Feb to 02
            return shortMonthsToNumber[value] || value;
        }

        function parseTime(value) {
            // 10:54:50.546
            // => hour: 10, minute: 54, second: 50, millis: 546
            // 10:54:50
            // => hour: 10, minute: 54, second: 50, millis: ''
            var time = value,
                values,
                subValues,
                hour,
                minute,
                second,
                millis = '',
                delimited,
                timeArray;

            if (time.indexOf('.') !== -1) {
                delimited = time.split('.');
                // split time and milliseconds
                time = delimited[0];
                millis = delimited[1];
            }

            timeArray = time.split(':');

            if (timeArray.length === 3) {
                hour = timeArray[0];
                minute = timeArray[1];
                // '20 GMT-0200 (BRST)'.replace(/\s.+/, '').replace(/[a-z]/gi, '');
                // => 20
                // '20Z'.replace(/\s.+/, '').replace(/[a-z]/gi, '');
                // => 20
                second = timeArray[2].replace(/\s.+/, '').replace(/[a-z]/gi, '');
                // '01:10:20 GMT-0200 (BRST)'.replace(/\s.+/, '').replace(/[a-z]/gi, '');
                // => 01:10:20
                // '01:10:20Z'.replace(/\s.+/, '').replace(/[a-z]/gi, '');
                // => 01:10:20
                time = time.replace(/\s.+/, '').replace(/[a-z]/gi, '');
                return {
                    time: time,
                    hour: hour,
                    minute: minute,
                    second: second,
                    millis: millis
                };
            }

            return { time: '', hour: '', minute: '', second: '', millis: '' };
        }

        function padding(value, length) {
            var paddingCount = length - String(value).length;
            for (var i = 0; i < paddingCount; i++) {
                value = '0' + value;
            }
            return value;
        }

        function parseDate(value) {
            var parsedDate = {
                date: null,
                year: null,
                month: null,
                dayOfMonth: null,
                dayOfWeek: null,
                time: null
            };

            if (typeof value == 'number') {
                return parseDate(new Date(value));
            } else if (typeof value.getFullYear == 'function') {
                parsedDate.year = String(value.getFullYear());
                // d = new Date(1900, 1, 1) // 1 for Feb instead of Jan.
                // => Thu Feb 01 1900 00:00:00
                parsedDate.month = String(value.getMonth() + 1);
                parsedDate.dayOfMonth = String(value.getDate());
                parsedDate.time = parseTime(value.toTimeString() + "." + value.getMilliseconds());
            } else if (value.search(YYYYMMDD_MATCHER) != -1) {
                /* 2009-04-19T16:11:05+02:00 || 2009-04-19T16:11:05Z */
                values = value.split(/[T\+-]/);
                parsedDate.year = values[0];
                parsedDate.month = values[1];
                parsedDate.dayOfMonth = values[2];
                parsedDate.time = parseTime(values[3].split('.')[0]);
            } else if (value.search("/Date") != -1) {
                /* .NET JSON Date return format */
                return parseDate(new Date(parseInt(value.substring(6))));
            } else {
                values = value.split(' ');

                if (values.length === 6 && isNaN(values[5])) {
                    values[values.length] = '()';
                }

                switch (values.length) {
                    case 6:
                        /* Wed Jan 13 10:43:41 CET 2010 */
                        parsedDate.year = values[5];
                        parsedDate.month = shortMonthToNumber(values[1]);
                        parsedDate.dayOfMonth = values[2];
                        parsedDate.time = parseTime(values[3]);
                        break;
                    case 2:
                        /* 2009-12-18 10:54:50.546 */
                        subValues = values[0].split('-');
                        parsedDate.year = subValues[0];
                        parsedDate.month = subValues[1];
                        parsedDate.dayOfMonth = subValues[2];
                        parsedDate.time = parseTime(values[1]);
                        break;
                    case 7:
                        /* Tue Mar 01 2011 12:01:42 GMT-0800 (PST) */
                    case 9:
                        /* added by Larry, for Fri Apr 08 2011 00:00:00 GMT+0800 (China Standard Time) */
                    case 10:
                        /* added by Larry, for Fri Apr 08 2011 00:00:00 GMT+0200 (W. Europe Daylight Time) */
                        parsedDate.year = values[3];
                        parsedDate.month = shortMonthToNumber(values[1]);
                        parsedDate.dayOfMonth = values[2];
                        parsedDate.time = parseTime(values[4]);
                        break;
                    case 1:
                        /* added by Jonny, for 2012-02-07CET00:00:00 (Doctrine Entity -> Json Serializer) */
                        subValues = values[0].split('');
                        parsedDate.year = subValues[0] + subValues[1] + subValues[2] + subValues[3];
                        parsedDate.month = subValues[5] + subValues[6];
                        parsedDate.dayOfMonth = subValues[8] + subValues[9];
                        if (subValues.length > 10)
                            parsedDate.time = parseTime(subValues[13] + subValues[14] + subValues[15] + subValues[16] + subValues[17] + subValues[18] + subValues[19] + subValues[20]);
                        break;
                    default:
                        return null;
                }
            }
            parsedDate.date = new Date(parsedDate.year, parsedDate.month - 1, parsedDate.dayOfMonth);
            parsedDate.dayOfWeek = String(parsedDate.date.getDay());

            return parsedDate;
        }

        function date(value, format) {
            try {

                var parsedDate = parseDate(value);

                if (parsedDate === null) {
                    return value;
                }

                var date = parsedDate.date,
                    year = parsedDate.year,
                    month = parsedDate.month,
                    dayOfMonth = parsedDate.dayOfMonth,
                    dayOfWeek = parsedDate.dayOfWeek,
                    time = parsedDate.time;

                var pattern = '',
                    retValue = '',
                    unparsedRest = '',
                    inQuote = false;

                /* Issue 1 - variable scope issue in format.date (Thanks jakemonO) */
                for (var i = 0; i < format.length; i++) {
                    var currentPattern = format.charAt(i);
                    // Look-Ahead Right (LALR)
                    var nextRight = format.charAt(i + 1);

                    if (inQuote) {
                        if (currentPattern == "'") {
                            retValue += (pattern === '') ? "'" : pattern;
                            pattern = '';
                            inQuote = false;
                        } else {
                            pattern += currentPattern;
                        }
                        continue;
                    }
                    pattern += currentPattern;
                    unparsedRest = '';
                    switch (pattern) {
                        case 'ddd':
                            retValue += numberToLongDay(dayOfWeek);
                            pattern = '';
                            break;
                        case 'dd':
                            if (nextRight === 'd') {
                                break;
                            }
                            retValue += padding(dayOfMonth, 2);
                            pattern = '';
                            break;
                        case 'd':
                            if (nextRight === 'd') {
                                break;
                            }
                            retValue += parseInt(dayOfMonth, 10);
                            pattern = '';
                            break;
                        case 'D':
                            if (dayOfMonth == 1 || dayOfMonth == 21 || dayOfMonth == 31) {
                                dayOfMonth = parseInt(dayOfMonth, 10) + 'st';
                            } else if (dayOfMonth == 2 || dayOfMonth == 22) {
                                dayOfMonth = parseInt(dayOfMonth, 10) + 'nd';
                            } else if (dayOfMonth == 3 || dayOfMonth == 23) {
                                dayOfMonth = parseInt(dayOfMonth, 10) + 'rd';
                            } else {
                                dayOfMonth = parseInt(dayOfMonth, 10) + 'th';
                            }
                            retValue += dayOfMonth;
                            pattern = '';
                            break;
                        case 'MMMM':
                            retValue += numberToLongMonth(month);
                            pattern = '';
                            break;
                        case 'MMM':
                            if (nextRight === 'M') {
                                break;
                            }
                            retValue += numberToShortMonth(month);
                            pattern = '';
                            break;
                        case 'MM':
                            if (nextRight === 'M') {
                                break;
                            }
                            retValue += padding(month, 2);
                            pattern = '';
                            break;
                        case 'M':
                            if (nextRight === 'M') {
                                break;
                            }
                            retValue += parseInt(month, 10);
                            pattern = '';
                            break;
                        case 'y':
                        case 'yyy':
                            if (nextRight === 'y') {
                                break;
                            }
                            retValue += pattern;
                            pattern = '';
                            break;
                        case 'yy':
                            if (nextRight === 'y') {
                                break;
                            }
                            retValue += String(year).slice(-2);
                            pattern = '';
                            break;
                        case 'yyyy':
                            retValue += year;
                            pattern = '';
                            break;
                        case 'HH':
                            retValue += padding(time.hour, 2);
                            pattern = '';
                            break;
                        case 'H':
                            if (nextRight === 'H') {
                                break;
                            }
                            retValue += parseInt(time.hour, 10);
                            pattern = '';
                            break;
                        case 'hh':
                            /* time.hour is '00' as string == is used instead of === */
                            hour = (parseInt(time.hour, 10) === 0 ? 12 : time.hour < 13 ? time.hour
                                : time.hour - 12);
                            retValue += padding(hour, 2);
                            pattern = '';
                            break;
                        case 'h':
                            if (nextRight === 'h') {
                                break;
                            }
                            hour = (parseInt(time.hour, 10) === 0 ? 12 : time.hour < 13 ? time.hour
                                : time.hour - 12);
                            retValue += parseInt(hour, 10);
                            // Fixing issue https://github.com/phstc/jquery-dateFormat/issues/21
                            // retValue = parseInt(retValue, 10);
                            pattern = '';
                            break;
                        case 'mm':
                            retValue += padding(time.minute, 2);
                            pattern = '';
                            break;
                        case 'm':
                            if (nextRight === 'm') {
                                break;
                            }
                            retValue += time.minute;
                            pattern = '';
                            break;
                        case 'ss':
                            /* ensure only seconds are added to the return string */
                            retValue += padding(time.second.substring(0, 2), 2);
                            pattern = '';
                            break;
                        case 's':
                            if (nextRight === 's') {
                                break;
                            }
                            retValue += time.second;
                            pattern = '';
                            break;
                        case 'S':
                        case 'SS':
                            if (nextRight === 'S') {
                                break;
                            }
                            retValue += pattern;
                            pattern = '';
                            break;
                        case 'SSS':
                            retValue += time.millis.substring(0, 3);
                            pattern = '';
                            break;
                        case 'a':
                            retValue += time.hour >= 12 ? 'PM' : 'AM';
                            pattern = '';
                            break;
                        case 'p':
                            retValue += time.hour >= 12 ? 'p.m.' : 'a.m.';
                            pattern = '';
                            break;
                        case 'E':
                            retValue += numberToShortDay(dayOfWeek);
                            pattern = '';
                            break;
                        case "'":
                            pattern = '';
                            inQuote = true;
                            break;
                        default:
                            retValue += currentPattern;
                            pattern = '';
                            break;
                    }
                }
                retValue += unparsedRest;
                return retValue;
            } catch (e) {
                if (console && console.log) {
                    console.log(e);
                }
                return value;
            }
        }

        function prettyDate(time) {
            var date;
            var diff;
            var day_diff;

            if (typeof time === 'string' || typeof time === 'number') {
                date = new Date(time);
            }

            if (typeof time === 'object') {
                date = new Date(time.toString());
            }

            diff = (((new Date()).getTime() - date.getTime()) / 1000);

            day_diff = Math.floor(diff / 86400);

            if (isNaN(day_diff) || day_diff < 0) {
                return;
            }

            if (diff < 60) {
                return 'just now';
            } else if (diff < 120) {
                return '1 minute ago';
            } else if (diff < 3600) {
                return Math.floor(diff / 60) + ' minutes ago';
            } else if (diff < 7200) {
                return '1 hour ago';
            } else if (diff < 86400) {
                return Math.floor(diff / 3600) + ' hours ago';
            } else if (day_diff === 1) {
                return 'Yesterday';
            } else if (day_diff < 7) {
                return day_diff + ' days ago';
            } else if (day_diff < 31) {
                return Math.ceil(day_diff / 7) + ' weeks ago';
            } else if (day_diff >= 31) {
                return 'more than 5 weeks ago';
            }
        }

        function toBrowserTimeZone(value, format) {
            return date(new Date(value), format || 'MM/dd/yyyy HH:mm:ss');
        }
    }

}(jQuery));
