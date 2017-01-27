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
 *  Function to set modals with forms
 * **************************************/
function setModalForms($this, method, files, splitAction, modalSize, $formOptional, textsToDisplay) {
    var classes = $this.attr('class');
    classes = classes.split(' ').pop();
    classes = classes.split('-');
    var id = classes.pop();
    var inputValue = classes.pop();
    $('.span-delete').html('<i class="fa fa-hashtag" aria-hidden="true"></i> ' + inputValue);
    $('#cottage_id').val(inputValue);
    var $btnSubmit = $('.modal-footer > button.btn-primary');
    if (method.toUpperCase() === 'DELETE') {
        $btnSubmit.removeClass('btn-primary').addClass('btn-danger');
        $btnSubmit.html('<i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar');
    } else {
        $btnSubmit.removeClass('btn-primary').addClass('btn-warning');
        $btnSubmit.html('<i class="fa fa-exchange" aria-hidden="true"></i> Actualizar');
    }
    if (modalSize !== '' && modalSize !== undefined && modalSize !== null) {
        $('.modal-dialog').addClass(modalSize);
    }
    var $form;
    ($formOptional !== '' && $formOptional !== undefined && $formOptional !== null) ? $form = $formOptional : $form = $('#modalForms');
    $form.attr('mothod', method.toUpperCase());
    (typeof(files) === "boolean") ? ((files) ? $form.attr('enctype', 'multipart/form-data'): null) : $form.attr('enctype', files);
    var action = $form.attr('action');
    action = action.split(splitAction);
    action[1] = id;
    action = action.join(splitAction);
    $form.attr('action', action);
    $btnSubmit.click(function () {
        $form.submit();
    });
}

/***************************************
 *  Button delete Cottage
 * **************************************/
$('.delete-cottage').click(function (event) {
    setModalForms($(this), 'DELETE', false, 'admin/cottages/');
});

/***************************************
 *  Button edit type User
 * **************************************/
$('.btn-edit-type').click(function (event) {
    setModalForms($(this), 'PUT', false, 'admin/users/', 'modal-sm');
});