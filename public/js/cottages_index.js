$(document).ready(function (event) {
    $('img.img-responsive.img-rounded').click(function (e) {
        e.preventDefault();
        var $padre = $(this).parent('div.col-md-12');
        var $hno = $padre.siblings('div.col-md-12');
        var $anchor = $hno.find('a.btn.btn-primary.btn-sm');
        var $url = $anchor.attr('href');
        window.location = $url;
    });
});
