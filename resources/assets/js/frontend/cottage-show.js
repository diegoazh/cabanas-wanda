$(document).ready(function (event) {
    moment.locale('es');
    $('h2.title-sections').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $children = $this.children('i');
        var $slideElement = $this.siblings('.element-slide');
        $slideElement.slideToggle('slow');
        if($children.hasClass('fa-caret-down')) {
            $children.removeClass('fa-caret-down').addClass('fa-caret-right');
        } else {
            $children.removeClass('fa-caret-right').addClass('fa-caret-down');
        }
    });

    (function cottageCalendar() {
        if ($('#calendar').length) {
            var $calendar = $('#calendar');
            $calendar.clndr({
                daysOfTheWeek: moment.weekdays(),
            });
            var $table = $('.clndr-table');
        }
    }());

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
});
