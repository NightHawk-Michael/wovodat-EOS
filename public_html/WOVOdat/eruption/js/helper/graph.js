/** Use for overview and time serie graph only **/
define(function (require) {
    'use strict';
    // var this = require('helper/math');
    return {
        processData: function (plotData, range) {
            var minX = range.minX;
            var maxX = range.maxX;
            var data = plotData.data;
            var min = undefined;
            var max = undefined;
            var startPos = undefined;
            var endPos = undefined;
            var length = 0;
            if (plotData.points.show) {
                for (var i = 0; i < data.length; i++) {

                    var x = data[i][0];
                    var value = data[i][1];
                    var error = data[i][2] | 0;

                    if (x >= maxX) {
                        if (startPos === undefined) {
                            endPos = undefined;
                        } else {
                            endPos = startPos + length;
                        }
                        break;
                    }
                    if (x > minX) {
                        length++;
                        if (startPos === undefined) {
                            startPos = i;
                        }
                        if (value + error > max || max === undefined) {
                            max = value + error;
                        }
                        if (value - error < min || min === undefined) {
                            min = value - error;
                        }
                    }


                }

            }


            if (plotData.bars.show) {
                length = 0;
                for (var i = 0; i < data.length; i++) {
                    var x1 = data[i][0];
                    var x2 = data[i][1];
                    var value = data[i][3];
                    var error = data[i][4] | 0;
                    min = 0;
                    if (x1 >= maxX) {
                        if (startPos === undefined) {
                            endPos = undefined;
                        } else {
                            endPos = startPos + length;
                        }
                        break;
                    }
                    if (x2 > minX) {
                        length++;
                        if (startPos === undefined) {
                            startPos = i;
                        }
                        if (value + error > max || max === undefined) {
                            max = value + error;
                        }
                    }
                }

            }
            if (endPos === undefined && startPos !== undefined) {
                endPos = data.length;
            }
            if (endPos > data.length) {
                endPos = data.length;
            }
            if (min === undefined || max === undefined) {
                min = -1;
                max = 1;
            } else {
                var temp = Math.max(Math.abs(max), Math.abs(min)) * 0.1;
                max = max + temp;
                min = min - temp;

            }
            if (max == 0 && min == 0) {
                min = -1;
                max = 1;
            }
            return {minY: min, maxY: max, dataSize: length, startPos: startPos, endPos: endPos};

        },


        formatData: function (graph, filters, allowErrorbar, allowAxisLabel, selectingTimeSeries) {
            var minX = undefined,
                maxX = undefined,
                minY = undefined,
                maxY = undefined,
                data = [],
                errorbars = undefined;
            for (var i = 0; i < filters.length; i++) {
                var filter = filters[i];
                //console.log(filter);
                var filterName = filter.filterName;
                //console.log(filter.filterAttributes[j]);
                var list = [];
                var timeSeries = selectingTimeSeries.get({sr_id: filter.sr_id});
                var filterData = timeSeries.get("data").data[filterName];
                var style = timeSeries.get('data').style; // plot style [bar,circle,dot,horizontalbar]
                var errorbar;
                var axisLabel; // show unit on Y-axis

                // Set up filter color for special earthquake types
                var filterColor = filter.color;
                //console.log(filterColor);


                if (!allowErrorbar) {
                    errorbar = false;
                } else {
                    errorbar = timeSeries.get('data').errorbar; // has error bar or not [true,false]
                }


                if (!allowAxisLabel) {
                    axisLabel = undefined;
                }
                else {
                    axisLabel = timeSeries.get('data').unit;
                }
                ;

                /*Limit number of data to be rendered
                this to prevent the overload of data in Overview Graph
                when the number of data is too large.
                Here we limit the amount of data to be presented on Graph to 5000 data
                */
                var requiredData = [];

                requiredData = filterData;


                //requiredData is the array of filterData that has been restricted in amount.
                requiredData.forEach(function (d) {
                    var maxTime;
                    var minTime;
                    var upperBound = undefined;
                    var lowerBound = undefined;
                    var error;
                    if (errorbar) {
                        error = d.error;
                    } else {
                        error = 0;
                    }
                    ;
                    var value = d.value
                    if (style == 'bar' || style == 'horizontalbar') {
                        maxTime = d.etime
                        minTime = d.stime;
                    }
                    else if (style == 'dot' || style == 'circle') {
                        maxTime = minTime = d.time;
                    }
                    if (minX === undefined || minTime < minX) {
                        minX = minTime;
                    }
                    if (maxX === undefined || maxTime > maxX) {
                        maxX = maxTime;
                    }
                    if (minY === undefined || value - error < minY) {
                        minY = value - error;
                    }
                    if (maxY === undefined || value + error > maxY) {
                        maxY = value + error;
                    }

                    var tempData = [];
                    // parameters for bar data: left, right,bottom, top,error
                    if (style == 'bar') {
                        tempData.push(d.stime, d.etime, 0, d.value);
                    }
                    else if (style == 'horizontalbar') {

                        tempData.push(d.stime, d.etime, d.value + 0.5, d.value - 0.5); // add the upperBound and lowerBound to show the bar

                    }
                    else if (style == 'dot' || style == 'circle') {
                        tempData.push(d['time'], d['value']);
                    }


                    if (errorbar) {
                        tempData.push(error);
                    }
                    list.push(tempData);
                });

                var styleParams = {
                    style: style,
                    errorbar: errorbar,
                    axisLabel: axisLabel,
                    filterColor: filterColor // Pre-coded color for certain earthquake type
                }
                var lineConnected = false;
                if (timeSeries.get("data_type") == "EDM") lineConnected = true;
                data.push(this.formatGraphAppearance(list, timeSeries.get("showingName"), filterName, styleParams, lineConnected));


            }

            graph.minX = minX - 86400000;
            graph.maxX = maxX + 86400000;


            /** setup y-axis tick **/
            if (maxY != undefined && minY != undefined) {
                //     maxY = maxY*1.1;//1.1
                //    minY = minY*0.9;


                if (Math.abs(maxY) > Math.abs(minY)) {
                    var temp = maxY * 0.1;
                    minY = minY - temp;
                    maxY = maxY + temp;
                } else {
                    var temp = minY * 0.1;
                    minY = minY - temp;
                    maxY = maxY + temp;

                }


                // graph.ticks = this.generateTick(minY, maxY);
                // graph.minY = graph.ticks[0];
                // graph.maxY = graph.ticks[graph.ticks.length - 1]
                graph.minY = minY;
                graph.maxY = maxY;
                // graph.ticks.push();
            }
            graph.timeRange.set({
                'startTime': graph.minX,
                'endTime': graph.maxX,
            });
            // graph.timeRange.trigger('change');
            graph.data = data;
            // console.log(data);
        }
        ,
        /** setup effect for the graph
         *   data : data for floting
         *   filterName: filter name
         *   styleParams: params for styling graph {barwith,errorbar, y-axis unit....}
         **/
        formatGraphAppearance: function (data, timeSerieName, filterName, styleParams, lineConnected) {

            var dataParam = {
                data: data, //data is 3D array (y-error value is included in the data passed in)
                label: filterName + ":" + timeSerieName,
                color: null,
                lines: {
                    show: lineConnected
                },
                yaxis: {
                    axisLabel: ""
                },
                // shadowSize: 2,
                points: {
                    show: false,
                    radius: 2,
                    // lineWidth: 2, // in pixels
                    fill: false,
                    fillColor: null,
                    symbol: "circle",

                },
                bars: {
                    // wovodat: true;
                    show: false,
                    fullparams: true,
                    lineWidth: 2,
                    barWidth: 0,
                    fill: false,
                    fillColor: 0,
                    align: "left", // "left", "right", or "center"
                    horizontal: false,
                    zero: true
                }
            };

            // Set up for special earthquake type Colors
            if (styleParams.filterColor) {
                dataParam.color = styleParams.filterColor;
            }

            if (styleParams.errorbar) {
                dataParam.points.errorbars = "y";
                dataParam.points.yerr = {
                    show: true,
                    color: "#000000",
                    upperCap: "-",
                    lowerCap: "-",
                    radius: 2,
                }
            }

            if (styleParams.axisLabel) {
                dataParam.yaxis.axisLabel = styleParams.axisLabel;
                //console.log(dataParam.yaxis.axisLabel);
            }
            ;

            if (styleParams.earthquakeTypeColor != null) {
                dataParam.color = styleParams.earthquakeTypeColor;
                console.log(dataParam.earthquakeTypeColor);
            }

            if (styleParams.style == 'dot') {
                dataParam.points.show = true;
                dataParam.points.fill = true; // Set whether point color is be filled
                dataParam.points.fillColor = dataParam.color; //"#000000";
                // console.log(dataParam);
            }
            else if (styleParams.style == 'circle') {
                dataParam.points.show = true;
                dataParam.points.fill = false;
                // console.log(dataParam);
            }
            else if (styleParams.style == 'horizontalbar' || styleParams.style == 'bar') {
                dataParam.bars.show = true;
                dataParam.bars.horizontal = true;
                dataParam.points.shadowSize = 0;

                // Have not accounted for the case horizontal bar with no start time and end time

            }
            //console.log(dataParam);
            // parameter to enable error-bar presentation.
            return dataParam;
        }


    };
})
;