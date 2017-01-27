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

  if($('#removedImages').val() !== '' && $('#removedImages').val() !== undefined) {
    var removed = $('#removedImages').val();
    if(removed !== '') {
      removed = removed.split('|');
    }
    removed.pop();
    var images = $('.img-clickable');
    for (var i = images.length - 1; i >= 0; i--) {
      for (var j = removed.length - 1; j >= 0; j--) {
        if(images[i] === removed[j]) {
          images[i].addClass('img-clicked');
        }
      }
    }
  }

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

/***************************************
 *  Button delete Cottage
 * **************************************/
$('.delete-cottage').click(function (event) {
    var cottage = $(this).attr('class');
    cottage = cottage.split(' ').pop();
    cottage = cottage.split('_');
    var number = cottage.pop();
    cottage = cottage[0].split('-').pop();
    $('.cottage-delete').html('<i class="fa fa-hashtag" aria-hidden="true"></i> ' + number);
    $('#cottage_id').val(parseInt(number));
    $('.modal-footer > button.btn-primary').removeClass('btn-primary').addClass('btn-danger');
    var form = $('#delete_cottage_form');
    var action = form.attr('action');
    action = action.split('admin/cottages/');
    action[1] = cottage;
    action = action.join('admin/cottages/');
    form.attr('action', action);
    $('#submit_form').click(function () {
       form.submit();
    });
});

/***************************************
 *  Button edit type User
 * **************************************/
$('.btn-edit-type').click(function (event) {
    var type = $(this).attr('class');
    type = type.split(' ').pop();
    type = type.split('-').pop();
    $('#user_type').val(type);
    $('.modal-dialog').addClass('modal-sm');
    $('.modal-footer > button.btn-primary').removeClass('btn-primary').addClass('btn-warning');
});