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

    if(/cottages/.test(path)) {
        activeMenu(/cabañas/, menu_a);
        (path[2]) ? null : $('#main_content').removeClass('col-md-4').addClass('col-md-6');
        (/create/.test(path) || /edit/.test(path)) ? $('.panel').addClass('form-panel') : null;
    } else if (/users/.test(path)) {
        activeMenu(/usuarios/, menu_a);
        $('#main_content').removeClass('col-md-4').addClass('col-md-6');
    } else if (/frontend/.test(path)) {
        activeMenu(/página principal/, menu_a);
        $('#main_content').removeClass('col-md-4').addClass('col-md-6');
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