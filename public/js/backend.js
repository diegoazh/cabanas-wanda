$(document).ready(function(e) {
  /***************************************
  *  Info helper in forms
  * **************************************/
  var icons = $('.help-info > .help-icon');
  var texts = $('.help-info > .help-text');

  texts.hide();

  icons.click(function(event) {
    event.preventDefault();
    $(this).next().fadeToggle('slow', 'linear');
  });

  /***************************************
   *  Info helper in forms
   * **************************************/
  $('.img-clickable').click(function (event) {
      event.preventDefault();
      if ($(this).hasClass('img-clicked')) {
          $(this).removeClass('img-clicked');
          var name = $(this).attr('alt');
          var images = $('#actualImages').val();
          images += (name + '|');
          $('#actualImages').val(images);
      } else {
        $(this).addClass('img-clicked');
        var name = $(this).attr('alt');
        var images = $('#actualImages').val();
        images = images.split('|');
        images.pop();
        for (var i = images.length - 1; i >= 0; i--) {
          if(images[i] === name) {
            images.splice(i--, 1);
            break;
          }
        }
        if (images.length > 0) {
            images = images.join('|') + '|';
        }
        $('#actualImages').val(images);
      }
  })
});