/*!
 * Start Bootstrap - Agency Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
	$(".galeria2014").colorbox({rel:'2014', transition:"fade"});
    $(".galeria2015").colorbox({rel:'2015', transition:"fade"});
    $(".galeria2016").colorbox({rel:'2016', transition:"fade"});
    $(".video2015").colorbox({iframe:true, width:"80%", height:"80%"});
    $(".video2014").colorbox({iframe:true, width:"80%", height:"80%"});
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})
