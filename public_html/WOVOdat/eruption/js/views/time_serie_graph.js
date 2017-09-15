define(function (require) {
    'use strict';
    var
        $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
        // flot = require(['jquery.flot', 'jquery.flot.time', 'jquery.flot.navigate', 'jquery.flot.selection', 'jquery.flot.errorbars', 'jquery.flot.axislabels','jquery.flot.legendoncanvas']),
        JSZip = require('jszip'),
        FileSaver = require('FileSaver'),
        serieTooltipTemplate = require('text!templates/tooltip_serie.html'),
        template = require('text!templates/time_serie_graph.html'),
        Tooltip = require('views/series_tooltip'),
        TimeRange = require('models/time_range'),
        Handlebars = require('handlebars'),
        GraphHelper = require('helper/graph');
    // materialize = require('material');

    return Backbone.View.extend({
        // template: _.template(template),
        events: {
            'change input': 'onChange',
            'click a': 'onClick'
        },
        initialize: function (options) {
            this.container = options.container;
            this.filter = options.filter;
            this.selectedVolcano = options.selectedVolcano;
            this.eruptionTimeRange = options.eruptionTimeRange;
            // this.serieGraphTimeRange = options.serieGraphTimeRange;
            // this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
            this.selectingTimeSeries = options.selectingTimeSeries;
            this.timeRange = new TimeRange();
            // console.log(Tooltip);
            this.tooltip = new Tooltip({
                template: serieTooltipTemplate
            });
            // console.log(this.serieGraphTimeRange);
            var temp = this.filter.split(".");
            var timeSeries = this.selectingTimeSeries.get({sr_id: temp[0]});
            this.filter = {sr_id: temp[0], filterName: temp[1], id:this.filter}


            this.$el.attr('id', this.filter.id);
            this.hasErrorBar = timeSeries.get('data').errorbar;

            this.timeRangeLimit = options.timeRangeLimit;
            this.owner = timeSeries.get('data').data_owner[0];
            this.owner_link = timeSeries.get('data').data_owner[1];
            this.reference = timeSeries.get('data').reference[0];
            this.ref_link = timeSeries.get('data').reference[1];


            //console.log(this.filters.timeSerie.get('data').data);
            /*
             Add data Owner
             */
            //console.log(this.$el[0]);
            var padding_left = 500;
            var dataOwner = "<div id=\"data-owner\" style = \"display:none; float:right; margin-right:20px;\">";
            // for (var ii = 0; ii < timeSerie.attributes.data.data[0].data_owner.length; ii = ii + 2) {
                var cc_code = this.owner;
                var dataOwnerVal = this.owner_link;
                dataOwner += "<a href = \"" + dataOwnerVal + "\" target=\"_blank\" style = \"font-size: 10px;color: black;padding-left: " + padding_left / 4 + "px; right:0px; \"> " + cc_code + "</a> "
            // }

            dataOwner += " - ";
            // for (var ii = 0; ii < this.filters.timeSerie.attributes.data.data[0].reference.length; ii = ii + 2) {
                var reference_code = this.reference;
                var reference_val = this.ref_link;
                dataOwner += "<a href = \"" + reference_val + "\" target=\"_blank\" style = \"font-size: 10px;color: black; right:0px; \"> " + reference_code + "</a>"
            // }


            dataOwner += "</div>";

            var preHtml = Handlebars.compile(template);
            var options = {
                id: this.id,
                hasErrorBar: this.hasErrorBar,


            };
            var html = preHtml(options);
            this.$el.html(html);
            this.$el.append(dataOwner);

            this.allowErrorBar = true;
            this.token = "";
            this.prepareData();

        },
        updateTimeRangeLimit: function (timeRange){
            this.timeRangeLimit = timeRange;
        },
        timeRangeChanged: function (TimeRange) {
            if(TimeRange == undefined){
                return;
            }
            if(this.graph==undefined){
                this.minX = TimeRange.minX;
                this.maxX = TimeRange.maxX;
                this.render();
            }
            // console.log("zoom");
            var xaxis =this.graph.getAxes().xaxis;
            xaxis.options.min = TimeRange.minX;
            xaxis.options.max = TimeRange.maxX;
            var data = this.graph.getData()[0];
            var temp = GraphHelper.processData(data,TimeRange);
            var yaxis = this.graph.getAxes().yaxis;
            yaxis.options.min  = temp.minY;
            yaxis.options.max = temp.maxY;
            var dataSize = temp.dataSize;
            this.graph.setupGrid();
            this.graph.draw(false,temp.startPos,temp.endPos);
        },

        onScroll: function (event, minX, maxX) {
            console.log(event.data);
        },

        onHover: function (event, pos, item) {
            // if(item!=null){
            var tooltip = event.data;
            tooltip.update(pos, item);
            // }

        },
        show: function () {

            //this.timeRangeChanged(this.timeRange);
            this.render();
        },

        onChange: function (e) {
            if (e.currentTarget.id == ("checkbox." + this.id)) {
                this.allowErrorBar = !e.currentTarget.checked;
                var oldMinX = this.minX;
                var oldMaxX = this.maxX;
                this.prepareData();
                this.minX = oldMinX;
                this.maxX = oldMaxX;
                this.render();
            }

        },
        onClick: function (e) {
            if (e.currentTarget.id == ("csv." + this.id)) {
                this.popUpInfoForm();
            }

        },
        showFunctions: function () {
            //checkbox
            var functions = $('[id="functions.' + this.id + '"]');
            functions.css({display: "block"});
            var checkbox = $('[id="checkbox.' + this.id + '"]');
            var self = this;
            // checkbox.
            if (checkbox[0] != undefined) {
                checkbox[0].checked = !this.allowErrorBar;
            }

            //data owner
            var owner = $('[id="owner.' + this.id + '"]');
            owner.css({display: "block"});
            $('[id ="data-owner"]').css({display: "block"});

        },
        render: function () {
            if (this.data == undefined) {
                return;
            }

            this.showFunctions();
            var unit = undefined;
            var minY = Number.MAX_VALUE;
            var maxY = Number.MIN_VALUE;
            var d = this.data[0].data;
            var count = 0;
            for (var j = 0; j < d.length; j++) {
                if (d[j][0] < this.maxX && d[j][0] > this.minX) {
                    count++;
                    var l = d[j].length;
                    if (l == 3) l = 2;
                    minY = Math.min(minY, d[j][l - 1]);
                    maxY = Math.max(maxY, d[j][l - 1]);
                }
            }
            if (count == 0) {
                this.minY = -1;
                this.maxY = 1;
            } else {
                this.minY = minY;
                this.maxY = maxY;
            }
            if (this.data.length > 1) {
                var d2 = this.data[1].data;
                for (var j = 0; j < d2.length; j++) {
                    if (d2[j][0] < this.maxX && d2[j][0] > this.minX) {
                        var l = d[j].length;
                        d2[j][l - 1] = (this.minY + this.maxY) / 2;

                    }
                }
            }

            for (var i = 0; i < this.data.length; i++) {
                if (this.data[i].yaxis.axisLabel != undefined) {

                    if (this.data[i].data)
                        unit = this.data[i].yaxis.axisLabel;
                }
            }
            ;
            //this.data.yaxis = 1;


            var options = {
                virtual:true,
                grid: {
                    margin: 20,
                    hoverable: true,
                    autoHighlight: false,
                },
                xaxis: {
                    mode: 'time',
                    timeformat: "%d-%b<br>%Y",
                    min: this.minX,
                    max: this.maxX,

                    autoscale: true,
                    canvas: true,
                    ticks: 6,
                    panRange: [this.timeRangeLimit.MinX, this.timeRangeLimit.MaxX],
                    zoomRangeLimit: [this.timeRangeLimit.MinX, this.timeRangeLimit.MaxX],
                    limit: 500
                },
                yaxis: {
                    show: true,
                    min: this.minY,
                    max: this.maxY,
                    ticks: 6, //this.ticks
                    labelWidth: 50,
                    tickFormatter: function (val, axis) {
                        var string = val.toString();
                        if (string.length > 7) {
                            return val.toPrecision(2);
                        }
                        return val;
                    },
                    zoomRange: false,
                    panRange: false,
                    axisLabel: unit,
                    //label : "test",
                    canvas: true,
                    autoscaleMargin: 15,
                },

                zoom: {
                    interactive: true,

                },
                pan: {
                    interactive: true,

                },

                tooltip: {
                    show: true,
                },

            };
            if (!this.data || !this.data.length) {
                this.$el.html('');
                return;
            }

            this.$el.width('auto');
            this.$el.height(200);
            this.$el.addClass('time-serie-graph');
            //this.$el.append(' Individual graph display </br>');
            // plot the time series graph after being selected (eg. onSelect in OverViewGraph).
            // config graph theme colors
            options.colors = ["#000000", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"];

            //Push data eruption

            //this.data.push
            this.graph = $.plot(this.$el, this.data, options);

            //console.log(this.$el);

            //this.$el.append("<div><input type=\"checkbox\" >aaa</div>");
            this.$el.bind('plothover', this.tooltip, this.onHover);
            //this.tooltip.update()

            var eventData = {
                startTime: this.minX,
                endTime: this.maxX,
                target: this,
                // isTrigger : this.isTrigger,
            }
            // this.eventData =  eventData;


            this.$el.bind('plotzoom', eventData, this.onTimeRangeChange);
            this.$el.bind('plotpan', eventData, this.onTimeRangeChange);


        },
        onTimeRangeChange: function (event, plot) {
            var xaxis = plot.getXAxes()[0];
            /* The zooming range cannot wider than the original range */

            var timeRange = {
                minX: xaxis.min,
                maxX: xaxis.max
            };
            //event.data.timeRange.trigger('zoom');
            event.data.target.container.trigger('update-time-range',timeRange,this.id);
        },
        prepareData: function () {
            if (this.filter == undefined) {
                this.data = undefined;
                return;
            }

            var filters = [this.filter];
            var allowErrorbar = this.allowErrorBar;
            var allowAxisLabel = true;
            GraphHelper.formatData(this, filters, allowErrorbar, allowAxisLabel, this.selectingTimeSeries);
        },
        /**
         *Generate CSV file when click CSV button
         volcano-name (vd_name),
         station/seismic network name (ds/ss/sn_name),
         date-time (dd_tlt_time),
         code of data (dd_tlt_code, sd_ivl_code, etc.),
         data (dd_tlt1),
         data-uncertainty (dd_tlt_err1),
         data owner (cc_code).
         */
        generateCSV: function () {
            var listContent = [];

            var content = [];
            var volcanoName = this.selectedVolcano.get("vd_name");
            var stationName = this.filters.timeSerie.attributes.station_code1;
            var showingName = this.data[0].label;
            var filterName = this.filters.filterAttributes[0].name;

            var data = this.filters.timeSerie.attributes.data.data;
            for (var p = 0; p < data.length; p++) {
                if (data[p].filter != filterName) continue;
                var startTimeStr;
                var endTimeStr;
                var startTime
                var dateFormat = {
                    year: "numeric", month: "short",
                    day: "numeric", hour: "2-digit", minute: "2-digit"
                }
                if (data[p].time != undefined) {
                    startTime = data[p].time;
                    var startDateTime = new Date(startTime);
                    startTimeStr = startDateTime.getDate() + "-" + (startDateTime.getMonth() + 1) + "-" + startDateTime.getFullYear() + " " + startDateTime.getHours() + ":" + startDateTime.getMinutes() + ":" + startDateTime.getSeconds();
                    endTimeStr = "";
                } else {
                    startTime = data[p].stime;
                    var startDateTime = new Date(startTime);
                    var startTimeStr = startDateTime.getDate() + "-" + (startDateTime.getMonth() + 1) + "-" + startDateTime.getFullYear() + " " + startDateTime.getHours() + ":" + startDateTime.getMinutes() + ":" + startDateTime.getSeconds();
                    var endTime = data[p].etime;
                    var endDateTime = new Date(endTime);
                    endTimeStr = endDateTime.getDate() + "-" + (endDateTime.getMonth() + 1) + "-" + endDateTime.getFullYear() + " " + endDateTime.getHours() + ":" + endDateTime.getMinutes() + ":" + endDateTime.getSeconds();
                }

                var value = data[p].value;
                var owner = data[p].data_owner[0];
                var owner_link = data[p].data_owner[1];
                var dataOwner = owner + " - " + owner_link;
                //var dataOwner  =  this.filters.dataOwner;
                var station = this.filters.timeSerie.get("station_code1");
                var dataCode = data[p].data_code;
                var network = this.filters.timeSerie.get("short_data_type");
                var monitoringData = this.filters.timeSerie.get("component") + " (" + filterName + ")";
                var uncertainty = data[p].error;
                if (uncertainty == undefined) uncertainty = "";
                if (startTime >= this.minX && startTime <= this.maxX) {
                    //console.log (value);
                    var d = {
                        volcano: volcanoName,
                        network: network,
                        station: station,
                        monitoringData: monitoringData,
                        data: value,
                        startTime: startTimeStr,
                        endTime: endTimeStr,
                        uncertainty: uncertainty,
                        dataOwner: dataOwner,
                        showingName: showingName
                    }
                    content.push(d);
                }

            }

            if (this.data == undefined) return;

            var headers = ['Volcano', 'Network', 'Station', 'Monitoring Data (Type)', 'Data', 'Start Time', 'End Time',
                'Data Uncertainty', 'Data Owner'];
            //var z = new Zip();
            //console.log(z);
            var zip = new JSZip();
            // for (var i = 0 ; i < listContent.length; i++){
            var csvContent = "data:text/csv;charset=utf-8,";
            var total = 0;

            // var content = listContent[i];
            // if (content == undefined) continue;
            var dataString = "";
            for (var p = 0; p < content.length; p++) {
                total++;
                var d = content[p];
                dataString += d.volcano + ",\"" + d.network + "\",\"" + d.station + "\",\"" + d.monitoringData + " \",\"" + d.data + "\",\""
                    + d.startTime + "\",\"" + d.endTime + " \",\"" + d.uncertainty + " \",\"" + d.dataOwner + " \"\n";
            }

            csvContent += "Total number of earthquakes: " + total + " \n";
            csvContent += "(100 km from volcanic vent)\n";
            csvContent += headers.join(",") + "\n";
            csvContent += dataString + "\n";
            zip.file(content[0].showingName + ".csv", csvContent);
            // }
            zip.generateAsync({type: "blob"})
                .then(function (blob) {
                    saveAs(blob, "data.zip");
                });


        },
        /**
         * Display a pop up to make user fill in their information
         * If user have been keyed in information, just donwload, no popup
         */
        popUpInfoForm: function () {
            var token = this.token;

            var dataToken = {
                data: "check_token",
                token: token,
            }
            var URL = "/eruption2/api/";
            var tokenExists;
            var self = this;
            $.get(URL, dataToken, function (data, status, xhr) {
                tokenExists = data;
                if (tokenExists) {
                    self.getDataForSendingEmail(URL, "", "", "");

                } else {
                    $('#formPopup').openModal();

                }
            }, "json")

        },
        /**
         * Prepare data for sending email and add to database
         */
        getDataForSendingEmail: function (URL, name, email, institution) {
            var startTimeStr = "";
            var endTimeStr = "";
            var volcanoName = this.filters.timeSerie.attributes.volcanoName;
            var filterName = this.filters.filterAttributes[0].name;
            var dataType = this.filters.timeSerie.attributes.component + " (" + filterName + ")";
            if (endTimeStr == "") endTimeStr = startTimeStr;

            this.generateCSV();
            var dataDownload = {
                data: "add_user",
                name: name,
                email: email,
                institution: institution,
                vd_name: volcanoName,
                dataType: dataType,
                startTimeStr: startTimeStr,
                endTimeStr: endTimeStr
            }
            $.get(URL, dataDownload);
        },
        submitDownloadForm: function (e) {
            var self = e.data;
            var name = $('#name')[0].value.trim();
            var email = $('#email')[0].value.trim();
            var institution = $('#institution')[0].value.trim();
            var filterName = self.filters.filterAttributes[0].name;
            var volcanoName = self.filters.timeSerie.attributes.volcanoName;
            var dataType = self.filters.timeSerie.attributes.component + " (" + filterName + ")";
            var agreeTerm = $("#agree-term")[0].checked;
            var atpos = email.indexOf("@");
            var dotpos = email.lastIndexOf(".");
            if (name === "") {
                return false;
            }
            if (institution === "") {
                return false;
            }
            if (email == "") {
                return false;
            }
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
                return false;
            }
            if (!agreeTerm) {
                return false;
            }

            var dataToken = {
                data: "gen_token",
                name: name,
                email: email,
            }
            var URL = "/eruption/api/";
            var a = this;
            $.getJSON(URL, dataToken, function (data) {
                a.token = data.token;
                $("#token").append(data);
            });


            var data = {
                data: "add_user",
                id: new Date(),
                name: name,
                email: email,
                institution: institution,
                vd_name: volcanoName,
                dataType: dataType


            }
            $.get(URL, data);
            self.generateCSV();
            $('#formPopup').closeModal();

            //document.getElementById("download").appendChild(input);
            //document.getElementById("download").submit();

        },
    });
});
