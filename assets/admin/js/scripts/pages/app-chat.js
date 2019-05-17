//  Notifications & messages scrollable
if($('.sidebar-fixed').length > 0){
	var sidebar_fixed = new PerfectScrollbar('.sidebar-fixed');
}

(function($) {
	"use strict";

	// Main menu toggle should hide app menu
	$('.menu-toggle').on('click',function(e){
		$('.app-content .sidebar-left').removeClass('show');
		$('.chat-application .content-overlay').removeClass('show');
	});

	// Chat sidebar toggle
	$('.sidebar-toggle').on('click',function(e){
		e.stopPropagation();
		$('.app-content .sidebar-left').toggleClass('show');
		$('.chat-application .content-overlay').addClass('show');
	});
	$('.chat-application .content-overlay').on('click',function(e){
		$('.app-content .sidebar-left').removeClass('show');
		$('.chat-application .content-overlay').removeClass('show');
	});

	// For chat sidebar on small screen
	if ($(window).width() > 992) {
		if($('.chat-application .content-overlay').hasClass('show')){
			$('.chat-application .content-overlay').removeClass('show');
		}
	}

	// Scroll Chat area
	$(".chat-app-window").scrollTop($(".chat-app-window > .chats").height());

})(jQuery);

$(window).on("resize", function() {
	// remove show classes from sidebar and overlay if size is > 992
	if ($(window).width() > 992) {
		if($('.chat-application .content-overlay').hasClass('show')){
			$('.app-content .sidebar-left').removeClass('show');
			$('.chat-application .content-overlay').removeClass('show');
		}
	}
});

// Add message to chat
function enter_chat(source) {
   var message = $(".message").val();
   if(message != ""){
	var html = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
	$(".chat:last-child .chat-body").append(html);
	$(".message").val("");
	$(".chat-app-window").scrollTop($(".chat-app-window > .chats").height());
   }
}