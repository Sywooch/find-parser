$(document).ready(function ($) {

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

$('#olx-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_olx/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#comfy-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_comfy/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#foxmart-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_foxmart/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#microtron-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_microtron/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#rst-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_rst/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#rozetka-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_rozetka/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#allo-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_allo/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#auto-ria-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_auto_ria/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});

$('#dom-ria-button').click(function(){
    $.ajax({
        method: "POST",
        url: "/admin/parsing/save_dom_ria/",
        async: true,
        success: function(){
            alert('Load was performed.');
        },
        beforeSend: function(){
            $('#loader').addClass('loading');
        },
        complete: function(){
            $('#loader').removeClass('loading');
        }
    });
});
