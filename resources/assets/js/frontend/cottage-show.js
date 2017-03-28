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
});
