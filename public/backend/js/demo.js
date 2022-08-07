//Skin tab content set height and show scroll
function setSkinListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.3)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });
}

//Setting tab content set height and show scroll
function setSettingListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.3)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });
}

//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.3)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '3px',
        railBorderRadius: '0'
    });
}

// Chat App List
$('.chat-app .chat .chat-history').slimscroll({
	height: '550px',
	color: 'rgba(0,0,0,0.5)',
	size: '4px',
	alwaysVisible: false,
	borderRadius: '3px',
	railBorderRadius: '0'
});
$('.chat-app .people-list .chat-list').slimscroll({
	height: '700px',
	color: 'rgba(0,0,0,0.5)',
	size: '4px',
	alwaysVisible: false,
	borderRadius: '3px',
	railBorderRadius: '0'
});
$('.chat-widget .chat-scroll-list').slimscroll({
	height: '334px',
	color: 'rgba(0,0,0,0.5)',
	size: '4px',
	alwaysVisible: false,
	borderRadius: '3px',
	railBorderRadius: '0'
});

$('.right-sidebar .slim-scroll').slimscroll({
	height: 'calc(100vh - 56px)',
	color: 'rgba(0,0,0,0.5)',
	size: '2px',
	alwaysVisible: false,
	borderRadius: '3px',
	railBorderRadius: '0'
});



// Theme Light and Dark  =====================================================
$('.theme-light-dark .t-dark').on('click', function () {
    $('body').removeClass('light');     
});
$('.theme-light-dark .t-light').on('click', function () {
    $('body').addClass('light');     
});
