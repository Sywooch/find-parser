$(document).ready(function ($) {
    $("[name=btn_text]").attr("class", "btn btn-success btn-lg");
    $("[name=btn_text]").attr("src", "");
    $("[name=btn_text]").attr("style", "border:none");
    $("[name=btn_text]").attr("value", "Оплатить");
    //$("[name=btn_text]").val("<i class='fa fa-envelope-o icon-fa'></i>");

    $(document).on('pjax:end', function (a, b) {
        $(a.target).stop().animate({'opacity': 1});
    });

    // анимация скрытия контента перед загрузкой через pjax
    $(document).on('pjax:beforeSend', function (a, b) {
        $(a.target).stop().animate({'opacity': 0});
    });

    $(document).on("pjax:timeout", function (event) {
        event.preventDefault();
    });

    initProcessScroll();
});
function initProcessScroll() {
    var $win = $(window),
        $nav = $('#site-header'),
        navTop = $nav.length && $nav.offset().top + 116,
        isFixed = 0;

    processScroll();

    $win.on('scroll', processScroll);

    function processScroll() {
        var i, scrollTop = $win.scrollTop();
        if (scrollTop >= navTop && !isFixed) {
            isFixed = 1;
            $nav.addClass('affix');
        } else if (scrollTop <= navTop && isFixed) {
            isFixed = 0;
            $nav.removeClass('affix');
        }
    }
}