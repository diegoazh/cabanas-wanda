$(document).ready(function(e) {
  var icons = $('.help-info > .help-icon');
  var texts = $('.help-info > .help-text');

  texts.hide();

  icons.click(function(event) {
    event.preventDefault();
    $(this).next().fadeToggle('slow', 'linear');
  });
});