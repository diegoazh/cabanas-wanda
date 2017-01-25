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
      $(this).addClass('img-clicked');
  })
});