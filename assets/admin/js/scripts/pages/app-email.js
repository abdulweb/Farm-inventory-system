//	Notifications & messages scrollable

$(function() {
	"use strict";

	if($('#users-list').length > 0){
		var users_list = new PerfectScrollbar("#users-list");
	}

	// Main menu toggle should hide app menu
	$('.menu-toggle').on('click',function(e){
		$('.app-content .sidebar-left .email-app-menu').removeClass('show');
		$('.app-content .content-overlay').removeClass('show');
	});

	// Email sidebar toggle
	$('.sidebar-toggle').on('click',function(e){
		e.stopPropagation();
		$('.app-content .sidebar-left .email-app-menu').toggleClass('show');
		$('.app-content .content-overlay').addClass('show');
	});
	$('.app-content .content-overlay').on('click',function(e){
		$('.app-content .sidebar-left .email-app-menu').removeClass('show');
		$('.app-content .content-overlay').removeClass('show');
	});

	// Email Right sidebar toggle
	$('.email-app-list #users-list .media').on('click',function(e){
		e.stopPropagation();
		$('.app-content .content-right').toggleClass('show');
	});

	$('.go-back').on('click',function(e){
		e.stopPropagation();
		$('.app-content .content-right').removeClass('show');
	});

	// For chat sidebar on small screen
	if ($(window).width() > 768) {
		if($('.app-content .content-overlay').hasClass('show')){
			$('.app-content .content-overlay').removeClass('show');
		}
	}
	if ($(window).width() > 992) {
		if($('.app-content .content-right').hasClass('show')){
			$('.app-content .content-right').removeClass('show');
		}
	}

	// Favorite star click
    $(".favorite i").on("click", function() {
      $(this).parent('.favorite').toggleClass("warning");
    });

});

$(window).on("resize", function() {
	// remove show classes from sidebar and overlay if size is > 992
	if ($(window).width() > 768) {
		if($('.app-content .content-overlay').hasClass('show')){
			$('.app-content .sidebar-left .email-app-menu').removeClass('show');
			$('.app-content .content-overlay').removeClass('show');
		}
	}
	if ($(window).width() > 992) {
		if($('.app-content .content-right').hasClass('show')){
			$('.app-content .content-right').removeClass('show');
		}
	}
});