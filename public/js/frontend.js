$(document).ready(function (event) {
    setInterval(backgroundChange, 10000);
    var contador = 1;
    function continuousNumber(min, max) {
        var result = min + contador;
        contador++;
        if (result > max) { contador = 1, result = 1; };
        return result;
    }
    function backgroundChange() {
        $('#overlay').animate({
            'opacity': 1
        }, 1500, function () {
            $('#header').css('background-image', 'url("http://homestead.app/images/cabanas'+ continuousNumber(1, 11) +'.jpg")');
            $('#overlay').animate({
                'opacity': 0
            }, 1500);
        });

    }
});
