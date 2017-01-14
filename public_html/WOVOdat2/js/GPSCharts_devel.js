//GPSCharts_devel.js
//
// Initialize map
function setupMaps(sta, divnum){
    if ($("#vd_name"+divnum).val() != "") {
        $("#viewcontent"+divnum).hide();
        
        if ($("#filter"+divnum).val() && $("#dp_max"+divnum).val() >= $("#dp_min"+divnum).val()) {
            // Center map on volcano + add stations + add seismic events
            $.ajax({
                method: "get",
                url: "/php/getvd_info_pur.php",
                data: "vd_id=" + $("#vd_name"+divnum).val() +
                '&vd_name=' + $("#vd_name"+divnum+" :selected").text() +
                '&divnum='+ divnum +
                '&staplot='+ sta +
                '&filter=' + $("#filter"+divnum).val() +
                '&qty=' + $("#events"+divnum+" :selected").text() +
                '&date_ss_d='+$("#ss_d"+divnum+ " :selected").val()+
								'&date_ss_m='+$("#ss_m"+divnum+ " :selected").val()+
								'&date_ss_y='+$("#ss_y"+divnum).val()+
								'&date_se_d='+$("#se_d"+divnum+ " :selected").val()+
								'&date_se_m='+$("#se_m"+divnum+ " :selected").val()+
								'&date_se_y='+$("#se_y"+divnum).val()+
//                '&date_start=' + $("#ss_start"+divnum).val() +
//                '&date_end=' + $("#ss_end"+divnum).val() +
                '&dr_start=' + $("#dp_min"+divnum).val() +
                '&dr_end=' + $("#dp_max"+divnum).val() +
                '&eqtype=' + $("#eqtype"+divnum+" :selected").val(),
				
                beforeSend: function(){
                    $("#filLoading").show("fast");
                },
                complete: function(){
                    $("#filLoading").hide("fast");
                },
                success: function(html){
                    $("#bigmap" +divnum).dialog("destroy");
                    $("#bigmap" +divnum).html(html);
                    $("#dataType"+divnum).val(1);
                    
                    if(sta!=1){
	                    if(sta!=7){
	                     	$("#reloadEqk" +divnum).hide();
  	                    $("#filterSS" +divnum).hide();
    	                  $("#plfil" +divnum).hide();
      	                $("#minfil" +divnum).hide(); 
        	              $("#filterBtn" +divnum).hide();
          	            $("#displayEquakeInformation" +divnum).hide();
	                    	if(sta==0 || sta==9){
  	                  	  $("#temporal" +divnum).show();
    	              		}
        	            }
        	            if(sta==7){$("#reloadEqk" +divnum).show();}
                    }else{
                        $("#temporal" +divnum).show();
                    }
                }
            });
            // Prepare station available
            var funcstationcheck="stationcheck" + '('+divnum+')';
            eval(funcstationcheck);
            // Prepare data types
            var funcdatatypecheck="datatypecheck" + '('+sta+','+divnum+')';
            eval(funcdatatypecheck);
            //Plot map
            $('#bigmap'+divnum).show();
        }
    }else {
        $("#temporal"+divnum).show();
        $('#bigmap'+divnum).hide();
    }
}

function stationcheck(divnum) {
    $.ajax({
        method: "get",
        url: "/php/check_stations_try_devel.php",
        data: "vd_id=" + $("#vd_name"+divnum).val() +
        '&vd_name=' + $("#vd_name"+divnum+" :selected").text() +
        '&divnum='+ divnum +
        '&nvolc=' + divnum,
        beforeSend: function(){
            $("#filLoading").show("fast");
        },
        complete: function(){
            $("#filLoading").hide("fast");
        },
        success: function(html){
            $("#volcano"+divnum+"_info").show();
            $("#volc"+divnum+"_info2").html(html);
        }
    });
}

function datatypecheck(sta,divnum) {
    $.ajax({
        method: "get",
        url: "/php/check_data.php",
        data: "vd_id=" + $("#vd_name"+divnum).val() +
        '&divnum='+divnum+
        '&staplot='+sta,
        beforeSend: function(){
            $("#filLoading").show("fast");
        },
        complete: function(){
            $("#filLoading").hide("fast");
        },
        success: function(html){
					$("#temporal" +divnum).show();
					$("#selectData"+divnum).html(html);
        }
    });
}

// Change data type
function changedDataType(divnum) {
    $.ajax({
        method: "get",
        url: "/php/get_stations.php",
        data: "vd_id=" + $("#vd_name"+divnum).val() +
        '&dataType=' + $("#dataType"+divnum+" :selected").val() +
        '&divnum='+ divnum +
        '&nvolc=' + divnum,
        beforeSend: function(){
            $("#filLoading").show("fast");
        },
        complete: function(){
            $("#filLoading").hide("fast");
        },
        success: function(html){
            $("#selectStationDiv"+divnum).html(html);
        }
    });
}

function volcanochronology11(){
    $.ajax({
        method: "get",
        url: "/php/check_volcano_chrono_x.php",
        data: "vdi=" + $("#vd_name1").val() +
        '&nvolc=' + 1,
        success: function(html){
            $('#chronoholder1').html(html);
        }
    });
}

function volcanostatus1(){
    $.ajax({
        method: "get",
        url: "/php/check_volcano_status_x.php",
        data: "vdi=" + $("#vd_name1").val(),
        success: function(html){
            $('#viewcontent1').hide();
            $("#status_1").html(html);
        }
    });
    $('#displayEquakeInformation1').html('');
}
function volcanostatus2(){
    $.ajax({
        method: "get",
        url: "/php/check_volcano2_status_x.php",
        data: "vdi2=" + $("#vd_name2").val(),
        success: function(html){
            $('#viewcontent2').hide();
            $("#status_2").html(html);
        }
    });
    $('#displayEquakeInformation2').html('');
}
   
function secondvolcano() {
    $.ajax({
        method: "get",
        url: "/php/second_volcano.php",
        data: "vdid=" + $("#vd_name1").val(),
        beforeSend: function(){
            $("#filLoading").show("fast");
        },
        complete: function(){
            $("#filLoading").hide("fast");
        },
        success: function(html){
            $("#volanocateg").html(html);
        document.getElementById('vd_name2').onchange(); //vanduytuan: disable this option because it double-calls the onchange() method.
        }
    });
    //document.getElementById('vd_name2').onchange();

}

// Show spatial div---left
function showSpatial(){
    window.maporgraph = 0;
    $('#viewcontent').hide();
    $('#bigmap1').height('80%');
    $('#bigmap1').width('90%');
    $('#temporal1').hide();
    $('#spatial1').show();
    $('#bigmap1').show();
    return false;
}
  
// Show temporal div
function showTemporal()
{
    window.maporgraph = 1;
    $('#viewcontent').show();
    $('#temporal1').show();
    $('#spatial1').hide();
    $("#displayEquakeInformation1").hide();
    $('#bigmap1').hide();
    return false;
}
function showEquakeInformationPanel(divnum){
    $.ajax({
        method: "get",
        url: "/precursor/DisplayEquakeInformation.php",
        data: "vdid="+$("#vd_name" + divnum).val()  +
        '&vd_name=' + $("#vd_name" + divnum + " option:selected").text() +
        '&divnum='+ divnum +
        '&qty=' + $("#events"+divnum+" :selected").text() +
//        '&date_start=' + $("#ss_start"+divnum).val() +
//        '&date_end=' + $("#ss_end"+divnum).val() +
        //'&date_start=' + $("#ss_m"+divnum+'option:selected').val() +'/'+ $("#ss_d"+divnum+"option:selected").val() +'/'+ $("#ss_y"+divnum).val()+
        //'&date_end=' +$("#se_m"+divnum+"option:selected").val()+'/'+ $("#se_d"+divnum+"option:selected").val() +'/'+$("#se_y"+divnum).val()+
        '&date_ss_d='+$("#ss_d"+divnum+ " :selected").val()+
        '&date_ss_m='+$("#ss_m"+divnum+ " :selected").val()+
        '&date_ss_y='+$("#ss_y"+divnum).val()+
        '&date_se_d='+$("#se_d"+divnum+ " :selected").val()+
        '&date_se_m='+$("#se_m"+divnum+ " :selected").val()+
        '&date_se_y='+$("#se_y"+divnum).val()+
        '&dr_start=' + $("#dp_min"+divnum).val() +
        '&dr_end=' + $("#dp_max"+divnum).val() +
        '&eqtype=' + $("#eqtype"+divnum+" :selected").val(),
        beforeSend: function(){
            $("#filLoading").show("fast");
        },
        complete: function(){
            $("#filLoading").hide("fast");
        },
        success: function(html){
            $("#displayEquakeInformation" + divnum).html(html);
        }
    });
    $("#displayEquakeInformation" +divnum).show();
}
// When page is loaded
$(document).ready(function(){
    // Hide elements on load
    $("#filLoading").hide();
    $("#filterSS1").hide();
    $("#filterSSG1").hide();
    $("#plfil1").hide();
    $("#minfil1").hide();
    $("#plfilG1").hide();
    $("#minfilG1").hide();
    $("#filterBtn1").hide();
    $("#reloadBtn1").hide();

    $("#viewcontent").hide();
    $("#volc_single").hide();
    $("#volcano1_info").hide("fast");
    $("#volcano2_info").hide("fast");
    $("#display_left_2").hide();
    $("#ShowVolcano2Btn").hide();
    $("#temporal1").show();

    $("#filterSS2").hide();
    $("#filterSSG2").hide();
    $("#plfil2").hide();
    $("#minfil2").hide();
    $("#plfilG2").hide();
    $("#minfilG2").hide();
    $("#filterBtn2").hide();
    $("#reloadBtn2").hide();
    $("#displayEquakeInformation1").hide();
    $("#displayEquakeInformation2").hide();
    //	$("#chronoholder1").hide();

	
    $("#startdate").datepicker({
        changeMonth: true,
        changeYear: true
    });
    $("#enddate").datepicker({
        changeMonth: true,
        changeYear: true
    });
    $("#ss_start").datepicker({
        changeMonth: true,
        changeYear: true
    });
    $("#ss_end").datepicker({
        changeMonth: true,
        changeYear: true
    });

    // render as buttons and tabs
    $("button", "#dateBtns1").button();
    $("button", "#gbutton1").button();
    $("#filterBtn1").button();
    $("#reloadBtn1").button();
    $("#reloadSta1").button();
    $("#removeSta1").button();
    $("#viewcontrol").tabs();
    $("#viewcontent").tabs();

    // render as buttons "2" and tabs
    $("button", "#dateBtns2").button();
    $("button", "#gbutton2").button();
    $("#filterBtn2").button();
    $("#reloadBtn2").button();
    $("#reloadSta2").button();
    $("#removeSta2").button();
	
    // When "VolcanoCompareBtn" is clicked
    $("#ShowVolcano2Btn").click(function() {
        $("#volc_single").hide("fast");
        $("#volc_compare").show();
        $("#SingleVolcanoBtn").show();
        $("#ShowVolcano2Btn").hide();
        $("#map2").show();
        $("#status_2").show();
        $("#gotogvp2").show();
        document.getElementById('volc2').onchange();
    });
	
    // When "SingleVolcanoBtn" is clicked
    $("#SingleVolcanoBtn").click(function() {
        $("#volc_compare").hide("fast");
        $("#volc_single").show();
        $("#ShowVolcano2Btn").show();
        $("#SingleVolcanoBtn").hide();
        $("#map2").hide();
        $("#status_2").hide();
        $("#gotogvp2").hide();
        $("#filLoading").hide("fast");
    });
	
    // When go2gvp1 or 2 button is clicked
    $("#go2gvp1").click(function() {
        var locat= $("#vd_name1 :selected").text();
        var locati=locat.split("_");
        open("http://www.volcano.si.edu/world/volcano.cfm?vnum="+locati[1]);
    });
    $("#go2gvp2").click(function() {
        var locat= $("#vd_name2 :selected").text();
        var locati=locat.split("_");
        open("http://www.volcano.si.edu/world/volcano.cfm?vnum="+locati[1]);
    });

    // When "no filter" 1,2 is clicked (for temporal div)
    $("#minfilG1").click(function() {
        $("#filterSSG1").hide("fast");
        $(this).hide();
        $("#filterG1").val("0");
        $("#plfilG1").show();
    });
    $("#minfilG2").click(function() {
        $("#filterSSG2").hide("fast");
        $(this).hide();
        $("#filterG2").val("0");
        $("#plfilG2").show();
    });
	
    // When filter button 1 or 2 is clicked
    $("#filterBtn1").click(function() {
        showEquakeInformationPanel(1);
        setupMaps(7,1);
    });
    $("#filterBtn2").click(function() {
        showEquakeInformationPanel(2);
        setupMaps(7,2);
    });
	
    // When reload map button 1,2 is clicked
    $("#reloadBtn1").click(function() {
        setupMaps(7,1);
    });
    $("#reloadBtn2").click(function() {
        setupMaps(7,2);
    });
	
    // When reloadEqk 1,2 button is clicked
    $("#reloadEqk1").click(function() {	    
        $("#plotntitle1").hide();    
        $("#temporal1").hide();
        $("#plfil1").show();
        $("#filter1").val("0");
        setupMaps(7,1);
        showEquakeInformationPanel(1);
    });
    $("#reloadEqk2").click(function() {
        $("#plotntitle2").hide();
        $("#temporal2").hide();
        $("#plfil2").show();
        setupMaps(7,2);
        showEquakeInformationPanel(2);
    });
	
    // When "use filter" 1 or 2 is clicked
    $("#plfil1").click(function() {
        $("#filterSS1").show("fast");
        $("#filterBtn1").show();
        $("#reloadBtn1").hide();
        $(this).hide();
        $("#filter1").val("1");
        $("#minfil1").show();
    });
    $("#plfil2").click(function() {
        $("#filterSS2").show("fast");
        $("#filterBtn2").show();
        $("#reloadBtn2").hide();
        $(this).hide();
        $("#filter2").val("1");
        $("#minfil2").show();
    });
	
    // When "no filter" 1 or 2 is clicked
    $("#minfil1").click(
        function() {
            $("#filterSS1").hide("fast");
            $(this).hide();
            $("#filter1").val("0");
            $("#plfil1").show();
            $("#filterBtn1").hide();
            $("#reloadBtn1").hide();
        }
        );
    $("#minfil2").click(
        function() {
            $("#filterSS2").hide("fast");
            $(this).hide();
            $("#filter2").val("0");
            $("#plfil2").show();
            $("#filterBtn2").hide();
            $("#reloadBtn2").hide();
        }
        );

    // When reload Sta button is clicked
    $("#reloadSta1").click(function() {
        $("#spatial1").show();
         setupMaps(9,1);
    });
    // When reload Sta 2 button is clicked
    $("#reloadSta2").click(function() {
        $("#spatial2").show();
        setupMaps(9,2);
    });
    // When remove Sta button is clicked
    $("#removeSta1").click(function() {
        $("#spatial1").hide();
        $("#displayEquakeInformation1").hide();
        $("#viewcontent1").hide();
        setupMaps(0,1);
    });
    // When remove Sta 2button is clicked
    $("#removeSta2").click(function() {
        $("#spatial2").hide();
        $("#displayEquakeInformation2").hide();
        $("#viewcontent2").hide();
        setupMaps(0,2);
    });
	
    // When "use filter" is clicked (for temporal div)
    $("#plfilG").click(function() {
        $("#filterSSG").show("fast");
        $(this).hide();
        $("#filterG").val("1");
        $("#minfilG").show();
    });
    // When "use filter 2" is clicked (for temporal div)
    $("#plfilG2").click(function() {
        $("#filterSSG2").show("fast");
        $(this).hide();
        $("#filterG2").val("1");
        $("#minfilG2").show();
    });
    window.mapcreated = false;
    $('#ss_start1 , #ss_start2 , #ss_end1, #ss_end2').val('MM/DD/YYYY');
    if ($('#dp_min1').val() == '')
        $('#dp_min1').val('0');
    if ($('#dp_min2').val() == '')
        $('#dp_min2').val('0');
    $('#dp_max1, #dp_max2').val('700');
    $('#dp_min1, #dp_min2').blur(function(){
        if(this.value == ''){
            this.value = '0';
            this.style.color = '#AAAAAA';
        }
    });
    $('#dp_min1, #dp_min2').focus(function(){
        if(this.value == '0'){
            this.value = '';
        }
        this.style.color = 'black';
    });
    $('#dp_max1, #dp_max2').blur(function(){
        if(this.value == ''){
            this.value = '700';
            this.style.color = '#AAAAAA';
        }
    });
    $('#dp_max1, #dp_max2').focus(function(){
        if(this.value=='700'){
            this.value='';
        }
        this.style.color = 'black';
    });
    $('#ss_start1 , #ss_start2 , #ss_end1, #ss_end2').blur(function(){
        if(this.value == '') {
            this.value='MM/DD/YYYY';
            this.style.color = '#AAAAAA';
        }
    });
    $('#ss_start1 , #ss_start2 , #ss_end1, #ss_end2').focus(function(){
        if(this.value == 'MM/DD/YYYY')
            this.value ='';
        this.style.color='black';
    });
});
function showTooltip(x, y, contents,name) {
    $('<div id="' + name + '">' + contents + '</div>').css( {
        position: 'absolute',
        display: 'none',
        top: y + 5,
        left: x + 5,
        border: '1px solid #fdd',
        padding: '2px',
        'background-color': '#fee',
        opacity: 0.80
    }).appendTo("body").fadeIn(200);
}
var CONSTANTS = {};
CONSTANTS.height = "130px";
CONSTANTS.width = "300px";
function removeAllToolTip(){
    $('#equakeXGraph1ToolTip').remove();
    $('#equakeYGraph1ToolTip').remove();
    $('#equakeTimeSeriesGraph1ToolTip').remove();
    $('#equakeXGraph2ToolTip').remove();
    $('#equakeYGraph2ToolTip').remove();
    $('#equakeTimeSeriesGraph2ToolTip').remove();
}
function is_int(value){
    if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
        return true;
    } else {
        return false;
    }
}
function kmFormatter(v, axis){
    return v.toFixed(axis.tickDecimals) + "km";
}

