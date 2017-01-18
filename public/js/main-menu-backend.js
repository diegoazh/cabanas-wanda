// Fuente: https://webdesign.tutsplus.com/tutorials/orman-clarks-vertical-navigation-menu-the-css3-version--webdesign-5944

$(document).ready(function(e) {
  var menu_ul = $('.menu > li > ul'),
  menu_a  = $('.menu > li > a');

  path = window.location.pathname;
  path = path.split('/');
  path.shift();

  menu_ul.hide();

  if(path[1] === 'cottages') {
    for (var i = menu_a.length - 1; i >= 0; i--) {
      var a = menu_a[i];
      var t = menu_a[i].text;
      if(/cabañas/.test(t.toLowerCase())) {
        var b = $(a);
        b.addClass('active');
        b.next().stop(true,true).slideDown('normal');
      }
    }
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