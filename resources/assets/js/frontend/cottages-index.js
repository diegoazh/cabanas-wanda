$(document).ready(function (event) {
    $('img.img-fluid.rounded').click(function (e) {
        e.preventDefault();
        var $padre = $(this).parent('div.col-12');
        var $hno = $padre.siblings('div.col-12');
        var $anchor = $hno.find('a.btn.btn-outline-info');
        var $url = $anchor.attr('href');
        window.location = $url;
    });
});
