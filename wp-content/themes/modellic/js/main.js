(function($) {
	"use strict";

	$(document).ready(function() {

		// ======================================================
		// Header scroll function

		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			if (scroll > 50) {
				$("#header").removeClass("no-background").addClass("has-background");
			} else {
				$("#header").addClass("no-background").removeClass("has-background");
			}
		});

		// ======================================================
		// Mobile nav

		$(".sidenav-trigger").on('click', function(e){
			e.preventDefault();
			$("body").addClass("mobile-nav-open");
		});

		$("#sidenav-overlay").on('click', function(e){
			e.preventDefault();
			$("body").removeClass("mobile-nav-open");
		});

		$(window).on('resize', function(){
			$('body').removeClass("mobile-nav-open filter-open");
		});

		//=======================================================
		// Mobile Menu Dropdown

		$("#header li.dropdown").each(function() {
			var self = this;
			$("> a i", this).click(function(e) {
				e.preventDefault();
				$("> .dropdown-content", self).slideToggle();
			});
		});

		//=======================================================
		// Sidebar toogle

		$("#filter-trigger").on('click', function(e){
			e.preventDefault();
			$('body').addClass('filter-open');
		});

		$('#sidebar-closer').on('click', function(){
			$('body').removeClass('filter-open');
		});

		$(".sidebar-button").detach().insertAfter(".woocommerce-products-header, .title");

		$(".widget_facet h3").on('click', function(){
			$(this).toggleClass("active");
			$(this).siblings(".facetwidget").slideToggle();
		});

		if( $(".archive-template-fullwidth").length ) {
			$(".sidebar-button").show();
		}

		$(".widget_facet").last().addClass("last");

	});

})(jQuery);
