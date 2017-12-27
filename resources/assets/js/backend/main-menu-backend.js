// Fuente: https://webdesign.tutsplus.com/tutorials/orman-clarks-vertical-navigation-menu-the-css3-version--webdesign-5944

$(document).ready(function(e) {
    var menu_ul = $('.menu > li > ul'),
        menu_a  = $('.menu > li > a');

    function activeMenu (regExp, findIn) {
        for (var i = findIn.length - 1; i >= 0; i--) {
            var a = findIn[i];
            var t = findIn[i].text;
            if(regExp.test(t.toLowerCase())) {
                $(a).addClass('active').next().stop(true,true).slideDown('normal');
            }
        }
    }

    let path = window.location.pathname;
    path = path.split('/');
    path.shift();

    menu_ul.hide();

    let $menu =  $('#main_content');

    if(/cottages/.test(path)) {
        activeMenu(/cabañas/, menu_a);
        if (path[2])
            $menu.removeClass('col-md-4').addClass('col-md-6 offset-md-1');
        else
            $menu.removeClass('col-md-4').addClass('col-md-8');
    } else if (/users/.test(path)) {
        activeMenu(/usuarios/, menu_a);
        $menu.removeClass('col-md-4').addClass('col-md-8');
    } else if (/frontend/.test(path)) {
        activeMenu(/página principal/, menu_a);
        $menu.removeClass('col-md-4').addClass('col-md-6 offset-md-1');
    } else if (/food/.test(path)) {
        $menu.removeClass('col-md-4').addClass('col-md-8');
    } else if (/reports/.test(path)) {
        $menu.removeClass('col-md-4').addClass('col-md-12');
    } else {
        activeMenu(/panel/, menu_a);
        $menu.removeClass('col-md-4').addClass('col-md-8');
    }


    menu_a.click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });
});