/**
 * Created by Luis Ngo on 19/12/2016.
 */
var file_to_submit = "booleanSubmit.php";

//Date time picker format
var datetimepicker_option = {
    dateFormat: "yy-mm-dd",
    timeFormat: "HH:mm:ss",
    changeMonth: true,
    changeYear:true,
    yearRange: "-200:+0"
}

/*************************************************
 * Number of selected optioned allowed in MainCategory
 **************************************************/
var maxSelectedMainCategory = 6;

/*************************************************
 * Number of selected optioned allowed in dropdownbox
 **************************************************/
var maxSelectedDropdownbox = 2;


$(document).ready( function() {
    // Display location tag when the browser is online
    addLocationTag();
    addTimePicker();
    //monitoringDataInput();
    //$('#featureSelect').material_select();
    //$("#featureSelect,#rockSelect,#eruptionSelect").multiselect();
    //
    build_data();
    //$("#featureSelect,#rockSelect,#eruptionSelect").multiselect("refresh");
    // var x = document.getElementById("featureSelect");
    // console.log(x);
    //Limit checkbox selection:
    var limit = 5;


    $("input.checkBox").on("change", function(e){
        if($(".checkBox:checked").length > limit){
            this.checked = false;
        }

        if(this.checked){
            //turn on hidden data
            $("#"+this.id+"_wrapper").css("display","block");
        }
        else{
            $("#"+this.id+"_wrapper").css("display","none");
        }
    });
    monitoringData();

    $("#advSearch").click(function() {
        $("advSearchId").toggle();
    })
    $("#boolean_form").submit(function(e) {
        $(this).attr("action",file_to_submit);
        removeRedundantDataToSubmit();
        $("#mainCategory").css("opacity",0.3);
        $('#loadingGif').css('visibility', 'visible');
        // var form = this;
        //    e.preventDefault();
        //    setTimeout(function () {
        //        form.submit();
        //    }, 3000); //Delay for 3000 milliseconds
        return true;
    });

    $("input[type='button']").click(function( e ) {
        clearAllData();
    });

    /**
     * Function for selecting time using slide bar\
     * Added by Luis Ngo 19/12/2016
     */
    var currentTime = new Date().getTime();
    var minDate =  new Date();
    minDate.setFullYear(1900);
    minDate.setMonth(0);
    minDate.setDate(1);
    minDate.setHours(1);
    minDate.setMinutes(1);
    minDate.setSeconds(1);

    var slider = document.getElementById('slider-range');
    noUiSlider.create(slider, {
        start: [minDate.getTime(), currentTime],
        connect: true,
        step: 1,
        range: {
            'min': minDate.getTime(),
            'max': currentTime,
        },
        //format: wNumb({
        //    decimals: 0
        //})
    });
    slider.noUiSlider.on('update',slideTime)


    function slideTime(values , handle){
        var value = values[handle];
        if ( handle ) {
            //End date
            var date1 =  new Date(parseInt(value));
            var endTimeStr = date1.getDate() + "-" + (date1.getMonth()+1) + "-" + date1.getFullYear() + " " + date1.getHours() + ":" + date1.getMinutes() + ":" +  date1.getSeconds();
            $("#priorityTimeMax").val(endTimeStr);
            //inputNumber.value = value;
        } else {
            //start date
            var date0 =  new Date(parseInt(value));
            var startTimeStr = date0.getDate() + "-" + (date0.getMonth()+1) + "-" + date0.getFullYear() + " " + date0.getHours() + ":" + date0.getMinutes() + ":" +  date0.getSeconds();
            $("#priorityTimeMin").val(startTimeStr);
            //select.value = Math.round(value);
        }


    }

    /**
     * Handle selection
     */
    $('select').material_select();
    $('#feature_checkAll').click(function(){
        $('select').material_select("destroy");
        var isCheck = this.checked;
        $("#feature > option").each(function() {
                this.selected = isCheck;

        });;
        $('select').material_select();
    });
    $('#rock_checkAll').click(function(){
        $('select').material_select("destroy");
        var isCheck = this.checked;

        $("#rock > option").each(function() {
            this.selected = isCheck;

        });;
        $('select').material_select();
    });

    disableMonitoringCheckbox();


});

var monitoringData = function() {
    var hasDrop = ["sd_evn_eqtype","gd_concentration","gd_plu_emit","gd_plu_mass","gd_plu_etot","gd_sol_tflux","gd_sol_high","gd_sol_htemp"];
    for (var i =0; i<hasDrop.length; i++) {
        getJsonObject(hasDrop[i]);
    }
    $(".dataType").each(function() {
        $(this).children().each(function() {
            //inside _wrapper
            $(this).children(".range, .selectOpt, .selectOptNoRange").each(function() {
                $(this).children("label").addClass("data-header col s4");
            });
        });
    });



    //$("select[multiple='multiple']").multiselect();



    //$('.wowSpecies').multiselect();
    var displayWithSpe = function(idd) {
        $('#' + idd).children('#thresholdWithoutSpe').css("display", "none");
        $('#' + idd).children('#thresholdWithSpe').css("display", "block");
    };

    var displayWithoutSpe = function(idd) {
        $('#' + idd).children('#thresholdWithoutSpe').css("display", "block");
        $('#' + idd).children('#thresholdWithSpe').css("display", "none");
    };

    $('.selectOpt').each(function() {
        var selectOpt = $(this);
        var select = $(this).children('.wowSpecies');
        select.on("change", function() {
            var chosen = select.children('option:selected').val();
            var div = selectOpt.children('div');
            console.log(div.attr('id'));
            switch(chosen) {
                case "thresholdWithSpe":
                    displayWithSpe(div.attr('id'));
                    break;
                case "thresholdWithoutSpe":
                    displayWithoutSpe(div.attr('id'));
                    break;
            }
        });
    });

    var addSelectedWithRange = function(val, container) {
        var select = container.children('select');
        var selected = container.children('div#selected');
        var range = $("<div class='hiddenData' id='" + val + "'></div>");
        var label = $("<label style='display: block'>" + val + ": </label>");
        label.addClass('data-header');
        var minName = select.attr('id') + '_min_' + val;
        var maxName = select.attr('id') + '_max_' + val;

        range.append(label);
        range.append($('<input type="text" name="' + minName + '" id="' + minName + '">'));
        range.append($('<p style="display:inline">to</p>'));
        range.append($('<input type="text" name="' + maxName + '" id="' + maxName + '">'));
        selected.append(range);
    };

    var displayInSelected = function(val, selected, display) {
        if (display) selected.children('#' + val).css('display', 'block');
        else selected.children('#' + val).css('display', 'none');
    }

    $("div#thresholdWithSpe").each(function() {
        var container = $(this);
        var select = container.children('select');
        var selected = container.children('div#selected');
        $(this).children('select').children('option').each(function() {
            //console.log(select.attr('id'));
            //console.log(selected.attr('class'));
            var val = $(this).val();
            addSelectedWithRange(val, container);
        });

        select.on("change", function(){
            select.children('option').each(function() {
                displayInSelected($(this).val(), selected, false);
            });
            select.children('option:selected').each(function() {
                displayInSelected($(this).val(), selected, true);
            });
        });
    });

    $("div.selectOptNoRange").each(function() {
        var container = $(this);
        var select = container.children('select');
        var selected = container.children('div#selected');
        select.on("change", function() {
            selected.text("");
            select.children("option:selected").each(function() {
                if (selected.text() !== "") selected.append(", ");
                selected.append($(this).val());
            });
        });
    });

}

var removeRedundantDataToSubmit = function(){
    var list = $("#mainCategory").find("input");
    list.each(function(){
        var val = $(this).val();
        if(this.type == "text"){
            if(val == ""){
                $(this).attr("disabled","disabled");
            }
        }
        else{
            if($(this).prop("checked") && this.type == "checkbox"){
                //Do nothing here
            }
            else{
                $(this).attr("disabled","disabled");
            }
        }
    });
}

var clearAllData = function(){
    $("#featureSelect,#rockSelect,#eruptionSelect").multiselect("uncheckAll");
    $("input[name='veiMin']").val("");
    $("input[name='veiMax']").val("");
    $("input[name$='TimeMin']").datetimepicker( "setDate", "" );
    $("input[name$='TimeMax']").datetimepicker( "setDate", "" );
    $("input[name='veiMin']").val("");
    $("input[name='veiMax']").val("");
    $("input[type='checkbox']").prop("checked",false);
    $("input[id$='_input']").val("");
    $("input[id$='_input']").css("display","none");
    $("label[id$='_hidden']").css("display","none");
    $("input[id='googleMap-radius']").val("");
    $("input[id='googleMap-location']").val("");
};

var monitoringDataInput = function(){
    var list = ["sd_evn","sd_evs","sd_int","sd_ivl","sd_trm","sd_rsm","sd_ssm","dd_ang","dd_edm","dd_gps","dd_gpv","dd_lev","dd_str","dd_tlt","dd_tlv","fd_ele","fd_gra","fd_mag","fd_mgv","gd","gd_plu","gd_plu_emit","gd_sol","hd","td","med"];
    var has_dropdownbox= ["sd_evn","sd_evs","sd_ivl","sd_trm","gd","gd_plu","gd_plu_emit","gd_sol","hd"];


    for(var i = 0; i<list.length; i++){
        var val = list[i];
        var $container = $("<div id='"+val+"_wrapper'></div>");
        $container.addClass("hiddenData data-wrapper");

        var labelText = $('label[for="' + list[i] + '"]').html();
        var $header = $("<p>"+labelText+": </p>");
        $header.addClass("data-header");
        $container.append($header);

        if ( $.inArray(val,has_dropdownbox)!=-1 ) {
            addDropdownBox($container, val);
        }
        else
            addHiddenInput($container, val);

        $("#wrapHiddenData").append($container);
    }

};

var addDropdownBox = function ( $container,val ) {

    var limit_select_value = function(e,ui) {
        console.log($(this));
        if( $(this).multiselect("widget").find("input:checked").length > 0 ){
            $("#"+val+"_wrapper div.validation_alert").css("display","none");
        }
        if( $(this).multiselect("widget").find("input:checked").length > maxSelectedDropdownbox ){
            return false;
        }
        var $p = $("#"+val+"_wrapper p.selected_list");
        $p.text("");
        $(this).multiselect("widget").find("input:checked").each(function() {
            if ( $p.text() != "" ) $p.append(", ");
            $p.append($(this).attr("title"));
        });
        return true;
    };

    var $select = $("<select id='" +val + "Select" +"' name='"+val+"[]' multiple='multiple' ></select>");

    $.ajax({
        type:"GET",
        dataType:"json",
        url:"model/booleanIndex_m.php",
        data: "dataType="+val,
        success:function(result) {
            if (result.length == 0) {
                $select.append(new Option("Nodata","Nodata"));
            } else {
                if ( val == "sd_evn" || val == "sd_evs" || val ==  "sd_ivl" ) {
                    for(var i = 0; i < result.length; i++)
                        $select.append(new Option(result[i][0], result[i][1]));
                }  else {
                    for(var i  = 0; i < result.length; i++) {
                        $select.append(new Option(result[i],result[i]));
                    }
                }
            }

            var $div_validation = $("<div>Please select at least one option!</div>");
            $div_validation.addClass("validation_alert hiddenData");

            $selected_list = $("<p></p>");
            $selected_list.addClass("selected_list");

            $container.append($select).append($selected_list);
            $select.multiselect({
                header:false,
                minWidth:350,
                height:150,
                noneSelectedText: "Maximum "+maxSelectedDropdownbox+" criteria are able to select",
                selectedText: "Maximum "+maxSelectedDropdownbox+" criteria are able to select",
                click: limit_select_value
            });

            $container.append($div_validation);

            loadSpecificSelectData(val);
        }
    });

}

var loadSpecificSelectData = function (  value  ) {

    var select = $("select[name^='"+value+"']").multiselect("widget");
    // var vals = booleanStorage[value] || [];
    // for(var i = 0; i < vals.length; i++) {
    //  	var val = vals[i];
    //  	select.find("input[value='"+val+"']").each(function() {
    // 		this.click();
    // 	});
    // }
}


var addHiddenInput = function($container, val) {
    var $input = $("<input type='hidden' value='' name="+val+">");
    $container.append($input);
}

var addTimePicker = function(){
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        max: new Date(),
        autoclose: true,
        donetext: 'OK',
        format: 'yyyy-mm-dd',
        selectYears: 100 // Creates a dropdown of 15 years to control year
    });
    //$('.timepicker').pickatime({
    //    default: 'now',
    //    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    //    donetext: 'OK',
    //    autoclose: true,
    //    format: 'hh:mm:ss',
    //    vibrate: true // vibrate the device when dragging clock hand
    //});

    var picker = new MaterialDatetimePicker({})
        .on('submit', function(d) {
            output.innerText = d;
        });

    var el = document.querySelector('.c-datepicker-btn');
    el.addEventListener('click', function() {
        picker.open();
    }, false);




    //$("input[name$='TimeMin']").addClass("PriorityTime").datetimepicker(datetimepicker_option);
    //$("input[name$='TimeMax']").addClass("PriorityTime").datetimepicker(datetimepicker_option);

};
function dateFormat(date, fmt) {
    var o = {
        "M+": date.getMonth() + 1,
        "d+": date.getDate(),
    };
    if (/(y+)/.test(fmt)){
        fmt = fmt.replace(RegExp.$1, (date.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(fmt)){
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    return fmt;
}

function addGoogleMap() {

    $("#googleMap").locationpicker({

        location: {latitude: $('#vd_inf_slat1').val(), longitude: $('#vd_inf_slon1').val()},
        elevation: $('#vd_inf_sleve1').val(),
        radius: 300,

        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {

        }

    });
}
var addLocationTag = function(){


    if(navigator.onLine){
        $("#map_location").click(function(){

            $("#location").append(" <div class=\"col s2\">Latitude: <div class=\"input-field inline\"> <input id=\"vd_inf_slat1\" type=\"text\" value='1.3553794' style = 'font-size:inherit;'  onchange='addGoogleMap()'> </div>");
            $("#location").append(" <div class=\"col s2\">Longitude: <div class=\"input-field inline\"> <input id=\"vd_inf_slon1\" type=\"text\" value='103.86774439999999' style = 'font-size:inherit;' onchange='addGoogleMap()'> </div> ");
            $("#location").append(" <div class=\"col s2\">Elevation: <div class=\"input-field inline\"> <input id=\"vd_inf_sleve1\" type=\"text\" value='0' style = 'font-size:inherit;' onchange='addGoogleMap()'> </div>");
            $("#location").append("<div id='googleMap' style='height: 400px;' class ='col s9'></div>");
            addGoogleMap();
            $("#map_location").off();
        })


    }
    else{
        $("#location").hide();
    }
};

/**
 * Build data for selection
 */
var build_data = function(){
    list = ["feature","rock","edPhase"];
    for(var i = 0; i < list.length; i++){
        getJsonObject(list[i]);
    }
};

var getJsonObject = function(val,isCheckAll){

    Mafic = ["Basalt", "Tephrite Basanite", "Foidite", "Trachybasalt", "Picrobasalt"];
    Intermediate = ["Basaltic Andesite", "Basaltic Trachyandesite", "Phonotephrite", "Andesite", "Trachyandesite", "Tephra-phonolite"];
    Felsic = ["Dacite", "Trachyte", "Trachydacite", "Phonolite", "Rhyolite"];
    var addRock = function(key,value) {
        var add = function(type) {
            $("#"+type).append($("<option></option>").attr("value",value).text(value));
        }

        if ($.inArray(value, Mafic) != -1) add("Mafic");
        else if ($.inArray(value, Intermediate) != -1) add("Intermediate");
        else if ($.inArray(value, Felsic) != -1) add("Felsic");
        else add("other");
    }


    $.ajax({
        type:"GET",
        dataType:"json",
        url:"model/booleanIndex_m.php",
        data:"dataType="+val,
        success: function(result){
            if (result.length == 0) $("#"+val).append(new Option("Nodata","Nodata"));
            else if ( val == "sd_evn_eqtype" || val == "sd_evs" || val ==  "sd_ivl" ) {
                for(var i = 0; i < result.length; i++)
                    $("#"+val).append(new Option(result[i][0], result[i][1]));
            } else
                $.each(result, function(key,value) {
                    $("#"+val).append("<option value='" + value + "' >"+value + "</option>");
                });

        },
        error: function(xhr, ajaxOptions, thrownError){
        },
        async: false,
    });
};

function checkgdPluFlag(type){
    var selectVal = $("#gdPlu" + type + "Flag").val();
    type = type.toLowerCase();
    if (selectVal == "thresholdWithoutSpe") {
        $("#gd_plu_" + type + "_without_spec").css("display","block");
        $("#gd_plu_" + type + "_with_spec").css("display","none");
    }else{

        $("#gd_plu_" + type + "_without_spec").css("display","none");
        $("#gd_plu_" + type + "_with_spec").css("display","block");
    }
}

function checkgdPluSpec(type){
    type = type.toLowerCase();
    console.log(type);
    var selectVal = $("#gd_plu_" + type).val();

    var template =  "<div class = \"row col s12\">" +
        "<p class = \"data-header col s2\">CO2:</p>" +
        "<div id='gd_plu_CO2' class='row col s9'>" +
        "<input class= \"col s5\" type=\"text\" name=\"gd_plu_" + type + "_min_CO2\" id=\"gd_plu_" +type + "_min_CO2\">" +
        "<p class= \"col s2\" style=\"display:inline\">to</p>" +
        "<input class= \"col s5\" type=\"text\" name=\"gd_plu_" + type +"_max_CO2\" id=\"gd_plu_" + type + "_max_CO2\"></div> </div>"
    var contentGDPluSpec = "";
    for (v in selectVal){
        var t  = template.split("CO2").join(selectVal[v]);
        contentGDPluSpec +=t;
    }
    $("#gd_plu_" + type + "_spec").html(contentGDPluSpec);

}

function checkAdvanceSearch(){
    var checkBox = [];
    $("#gd_plu_wrapper").css("display","none");
    $("#gas").css("display","none");
    $("#Monitoring_Data_Lists input:checked").each(function(){
        checkBox.push($(this).attr('name'));
        $("#gas").css("display","block");
        $("#gd_plu_wrapper").css("display","block");

    });
}

function disableMonitoringCheckbox(){
    var checkBox = [];
    $("#Monitoring_Data_Lists input").each(function(){
        if (!($(this).attr('name') == 'gd_plu')){
            $(this).prop('disabled', true);
        }else{
            $(this).prop('disabled', false);
        }
        checkBox.push($(this).attr('name'));


    });

}

