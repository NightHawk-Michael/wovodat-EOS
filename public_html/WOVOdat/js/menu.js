$(document).ready(function() {

	addMenuHover();
	addHoverSubMenu1();
	addHoverSubMenu2();
});
var addMenuHover = function () {
	$(".menu-item").hover(
		function() {
			$(this).find("span").addClass("active-menu");
			var value = $(this).find("span").text();
			if (value=="Home") {
				$(".sub-menu-1").show();
			}
			if (value=="Volcano") {
				$(".sub-menu-2").show();
			}
		},
		function() {
			$(this).find("span").removeClass("active-menu");
			var value = $(this).find("span").text();
			if (value=="Home") {
				$(".sub-menu-1").hide();
			}
			if (value=="Volcano") {
				$(".sub-menu-2").hide();
			}
		} );
}

var addHoverSubMenu1 = function() {
	$(".sub-menu-1").hover(
		function() {
			$(this).show();
		},
		function() {
			$(this).hide();
		});
}

var addHoverSubMenu2 = function() {
	$(".sub-menu-2").hover(
		function() {
			$(this).show();
		},
		function() {
			$(this).hide();
		});
}
