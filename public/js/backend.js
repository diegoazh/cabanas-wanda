$(document).ready(function(e) {
  /***********************************************************************************
   *  This function remove image from input value
   *  @param $this - jQuery element - Element that will be removed and added.
   *  @param $removeTo - jQuery element - Element of which $this will be removed.
   *  @param $addTo - jQuery element - Element in which $this will be added.
   * *********************************************************************************/
  function removeAddFromInputValue($this, $removeTo, $addTo) {
    // elimina la imagen de $removeTo
    var images = $removeTo.val();
    images = images.split('|');
    images.pop();
    for (var i = images.length - 1; i >= 0; i--) {
        if(images[i] === $this.attr('alt')) {
            images.splice(i--, 1);
            break;
        }
    }
    if (images.length > 0) {
        images = images.join('|') + '|';
    }
    $removeTo.val(images);
    // agrega la imagen a $addTo
    $addTo.val($addTo.val() + $this.attr('alt') + '|');
  }

/*###############################################################################################*/
  /***************************************
  *  Info helpers in forms
  * **************************************/
  var icons = $('.help-info > .help-icon');
  var texts = $('.help-info > .help-text');

  texts.hide();

  icons.click(function(event) {
    event.preventDefault();
    $(this).next().fadeToggle('slow', 'linear');
  });

  /***************************************
   *  Helper in edits forms for images
   * **************************************/
  $('.img-clickable').click(function (event) {
    event.preventDefault();
    if ($(this).hasClass('img-clicked')) {
      $(this).removeClass('img-clicked');
      removeAddFromInputValue($(this), $('#removedImages'), $('#actualImages'));
    } else {
      $(this).addClass('img-clicked');
      removeAddFromInputValue($(this), $('#actualImages'), $('#removedImages'));
    }
  })
});