$(document).ready(function (event) {
    $(document).ready(function(){
        var altura = $('.general-menu').offset().top;

        $(window).on('scroll', function(){
            if ( $(window).scrollTop() > altura ){
                $('.general-menu').addClass('menu-fixed');
                $('#arrow_left, #arrow_right').css('top', '15px').css('margin-bottom', '50px');
                $('#overlay').css('margin-top', '50px');
                $('.container-logo').css('top', '17.5%');
            } else {
                $('.general-menu').removeClass('menu-fixed');
                $('#arrow_left, #arrow_right').removeAttr('style');
                $('#overlay').removeAttr('style');
                $('.container-logo').removeAttr('style');
            }
        });

    });

    $('img.img-responsive.img-rounded').click(function (e) {
        e.preventDefault();
        var $padre = $(this).parent('div.col-md-12');
        var $hno = $padre.siblings('div.col-md-12');
        var $anchor = $hno.find('a.btn.btn-primary.btn-sm');
        var $url = $anchor.attr('href');
        window.location = $url;
    });
});
