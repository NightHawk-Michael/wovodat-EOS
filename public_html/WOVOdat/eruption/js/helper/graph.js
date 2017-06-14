/** Use for overview and time serie graph only **/
define(function (require) {
    'use strict';
    // var this = require('helper/math');
    return {
        generateTick: function(min,max){
            if(min == undefined || max == undefined){
                return [-0.5,0,0.5];
            }
            if(min == max){
                var temp = this.exponentialDegree(min);
                if(temp == 0){
                    temp = 1;
                }
                var diff = 0.5*temp;
                return [min - diff,min,min+diff];
            }
            var ticks = [];
            var numStep = 7;
            /** compute exponential Degree **/


            var expDeg = undefined
            if(this.exponentialDegree(min) < this.exponentialDegree(max)){
                expDeg = this.exponentialDegree(max);
            }else{
                expDeg = this.exponentialDegree(min);
            }


            if(expDeg > 5) {
                var step = this.roundNumber((max-min)/numStep,expDeg); // step of ticks
                //if step is 0.xxx in computing exponential Degree, decrement expDeg
                while(step == 0){
                    expDeg--;
                    step = this.roundNumber((max-min)/numStep,expDeg);
                }
                min = this.roundNumber(min,expDeg);
                max = this.roundNumber(max,expDeg);

                step = step.toExponential();
                /**** compute ticks ****/
                var startTick = this.roundNumber(min -step,expDeg); // start tick
                var endTick = this.roundNumber(max+step,expDeg); // end tick
                startTick = startTick.toExponential();
                endTick = endTick.toExponential();
                var curTick = startTick;
                if(curTick == endTick){
                    ticks.push(curTick);
                }else{
                    for(var i=0; curTick<endTick;i++){
                        curTick = this.roundNumber(startTick + i *step,expDeg);
                        ticks.push(curTick);

                    }
                }
            }
            else {
                //	var step = (max-min)/(numStep-2);
                var step = (max-min)/numStep;

                if (step < 1){
                    var rounded = Math.round( step * 10 ) / 10;
                    var fixed = rounded.toFixed(1);
                    //return parseFloat( val.toFixed(2) )
                    step = fixed;
                    step = Math.max(step,0.2);
                }else{
                    //step = parseInt(step);
                    //step = this.roundNumber(step);
                }

                //var startTick = min - step;
                // var endTick = max + step;
                var startTick = undefined;
                var maxTick = undefined;
                var curTick = undefined;
                var endTick = undefined;
                while (startTick == undefined ||startTick >= min){
                    if (step >= 1){
                        maxTick = this.roundNumber(max+step,expDeg);
                    }else{
                        maxTick  = Math.round(max);
                    }

                    startTick  = maxTick - (step * numStep);    // start tick
                    step = step+step;
                    endTick  = maxTick; // end tick

                    curTick = startTick;

                }
                if (curTick == endTick) {
                    ticks.push(curTick);
                } else {
                    for (var i = 0; curTick < endTick; i++) {
                        curTick = startTick + i * step;
                        ticks.push(curTick);

                    }
                }
            }
            return ticks;
        },
        formatData: function (graph, filters, allowErrorbar, allowAxisLabel, limitNumberOfData) {
            var minX = undefined,
                maxX = undefined,
                minY = undefined,
                maxY = undefined,
                data = [],
                errorbars = undefined;
            for (var i = 0; i < filters.length; i++) {
                var filter = filters[i];
                //console.log(filter);
                for (var j = 0; j < filter.filterAttributes.length; j++) {
                    var filterName = filter.filterAttributes[j].name;
                    //console.log(filter.filterAttributes[j]);
                    var list = [];
                    var filterData = filter.timeSerie.getDataFromFilter(filterName);
                    var style = filter.timeSerie.get('data').style; // plot style [bar,circle,dot,horizontalbar]
                    var errorbar;
                    var axisLabel; // show unit on Y-axis

                    // Set up filter color for special earthquake types
                    var filterColor = filter.filterAttributes[j].color;
                    //console.log(filterColor);


                    if (!allowErrorbar) {
                        errorbar = false;
                    } else {
                        errorbar = filter.timeSerie.get('data').errorbar; // has error bar or not [true,false]
                    }

                    if (!allowAxisLabel) {
                        axisLabel = undefined;
                    }
                    else {
                        axisLabel = filter.timeSerie.get('data').unit;
                    }
                    ;

                    /*Limit number of data to be rendered
                     this to prevent the overload of data in Overview Graph
                     when the number of data is too large.
                     Here we limit the amount of data to be presented on Graph to 5000 data
                     */
                    var requiredData = [];
                    if (limitNumberOfData && filterData.length > 5000) {
                        //threshold = 5000 data to be rendered each Overview Graph
                        var threshold = parseInt(filterData.length / 5000) + 1;
                        for (var k = 0; k < filterData.length; k += threshold) {
                            requiredData.push(filterData[k]);
                        }
                    }
                    else {
                        requiredData = filterData;
                    }
                    ;

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
                        ;

                        if (errorbar) {
                            tempData.push(error);
                        }
                        list.push(tempData);
                    });
                    //console.log(list.length);

                    var styleParams = {
                        style: style,
                        errorbar: errorbar,
                        axisLabel: axisLabel,
                        filterColor: filterColor // Pre-coded color for certain earthquake type
                    }
                    var lineConnected = false;
                    if (filter.timeSerie.get("data_type") == "EDM") lineConnected  = true;
                    data.push(this.formatGraphAppearance(list, filter.timeSerie.getName(), filterName, styleParams, lineConnected));

                }


            }

            graph.minX = minX - 86400000;
            graph.maxX = maxX + 86400000;


            /** setup y-axis tick **/
            if (maxY != undefined && minY != undefined) {
                maxY = maxY + (maxY-minY)/5;//1.1
                minY = minY - (maxY-minY)/5;
                if (minY == maxY) {
                    if (minY != 0) {
                        minY = minY * 0.99;
                        maxY = maxY * 1.01;
                    } else {
                        minY = -0.5;
                        maxY = 0.5;
                    }
                }
                graph.ticks = this.generateTick(minY, maxY);
                graph.minY = graph.ticks[0];
                graph.maxY = graph.ticks[graph.ticks.length - 1]
                graph.ticks.push();
            }
            graph.timeRange.set({
                'startTime': graph.minX,
                'endTime': graph.maxX,
            });
            // graph.timeRange.trigger('change');
            graph.data = data;
            // console.log(data);
        },
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
                shadowSize: 3,
                points: {
                    show: false,
                    radius: 3,
                    lineWidth: 2, // in pixels
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
            ;

            if (styleParams.errorbar) {
                dataParam.points.errorbars = "y";
                dataParam.points.yerr = {
                    show: true,
                    color: "#D50000",
                    upperCap: "-",
                    lowerCap: "-",
                    radius: 2,
                }
            }
            ;

            if (styleParams.axisLabel) {
                dataParam.yaxis.axisLabel = styleParams.axisLabel;
                //console.log(dataParam.yaxis.axisLabel);
            }
            ;

            if (styleParams.earthquakeTypeColor != null) {
                dataParam.color = styleParams.earthquakeTypeColor;
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
                // console.log(dataParam);
            }
            // parameter to enable error-bar presentation.
            return dataParam;
        },
        decimalPlaces: function (value) {
            if (Math.floor(value) === value) return 0;
            return value.toString().split(".")[1].length || 0;
        },
        //expDegree always greater than expDegree of numberStr
        // Round the number to expDegree
        roundNumber: function (numberStr, desExpDegree) {
            var desCoe; // destination Coefficient
            var number = parseFloat(numberStr)
                number = number / Math.pow(10, desExpDegree);
            //   var sourceExpDegree = this.exponentialDegree(number); //expoential Degree of this number

            //   var sourceCoe = this.coefficient(number);
            //   if(sourceExpDegree >=desExpDegree){
            //     var differExpDeg = sourceExpDegree-desExpDegree;
            //     desCoe = sourceCoe * Math.pow(10,differExpDeg);
            // }else{
            //    desCoe = 0;
            //  }

            number = Math.ceil(number);
            return number * Math.pow(10, desExpDegree);
        },
        exponentialDegree: function (v) {
            v = v.toExponential();
            var a =  v.toString().split("e")[1];
            var exp = parseInt(a);
            return exp;

        },
        /** no decimal place **/
        coefficient: function (value) {
            value = value.toExponential();
            var a = value.toString().split("e")[0];
            var coe = parseFloat(a);
            coe = Math.round(coe);
            return coe;
        },

    };
});