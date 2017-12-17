/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/backend/backend.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function (e) {
    /***********************************************************************************
    * Funciones útiles para trabajar con JavaScript
    * ---------------------------------------------------------------
    *
    *  Si no existe crea una funcion para determinar si es un Objeto.
    **/
    if (!Object.isObject) {
        Object.isObject = function (arg) {
            return Object.prototype.toString.call(arg) === '[object Object]';
        };
    }
    /**
     *  Si no existe crea una funcion para determinar si es un Array.
     **/
    if (!Array.isArray) {
        Array.isArray = function (arg) {
            return Object.prototype.toString.call(arg) === '[object Array]';
        };
    }

    /***********************************************************************************
     * Funciones necesarias la funcionalidad del backend siguiendo el principio DRY
     * ------------------------------------------------------------------------------
     *
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
            if (images[i] === $this.attr('alt')) {
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
    /*****************************************************************************************************************
     *  Function to set modals with forms
     *  ---------------------------------
     *  @param $this Objec jQuery - Boton que llama al modal y del cual se tama la clase.
     *  @param method - string - El metodo del formulario POST, PUT, etc.
     *  @param files - boolean or string - Indica si el form sube archivos, pude contener 'multipart/form-data'
     *  @param replaceInAction - string - String con que se reemplazará el texto subdir en el atributo action del form.
     *  @param textsToDisplay - Object or Array - Debe contener los textos a cargar en el modal.
     *         Con los siguientes indices o atributos:
     *         name - boolean -> indica si se mostrara en el título el nombre del objeto a modificar o el atributo que se modificará.
     *         tile - string -> El texto que se mostrará en el título del modal.
     *         infoText - string -> Texto que se mostrará en la etiqueta small dentro del titulo del modal.
     *         label - string -> Texto que se mostrará en la etiqueta label y en el div con clase input-group-addon.
     *         textBtn string -> Texto que se mostrará en el boton que envía el formulario.
     *         inputType - string -> Texto que define el atributo type del input del formulario.
     *         options - Array de Objects -> Array que se utilizará para crear las etiquetas options si el input es de
     *                   tipo select debe definir las propiedades value y text. Por ejemplo:
     *                   options: [
     *                              {value: 'valueOption', text: 'textOption'},
     *                              {value: 'valueOption', text: 'textOption'},
     *                              ...
     *                            ]
     *  @param modalSize - string - Clase para el tamaño del modal, modal-sm o modal-lg.
     *  @param $formOptional - Object jQuery or string - Objeto jQuery que contiene el form a configurar o texto que
     *         define el id del form a configurar.
     * ****************************************************************************************************************/
    function setModalForms($this, method, files, replaceInAction, textsToDisplay, modalSize, $formOptional) {
        var $row = $this.parents('tr');
        var id = $row.data('object');
        var inputValue = $this.data('objectValue');
        var name = $this.data('objectDisplay');
        var $btnSubmit = $('#submit_form');
        var $btnClose = $('.modal-footer > button.btn-default');
        var $form = $formOptional !== '' && $formOptional !== undefined && $formOptional !== null ? $formOptional : $('#modalFormId');
        if (!Object.isObject(textsToDisplay)) {
            var message = '' + 'El quinto parametro de la función debe ser un array de objetos y debe contener las siguientes propiedades:\n' + 'name - boolean -> indica si se mostrara en el título el nombre del objeto a modificar o el atributo que se modificará.\n' + 'tile - string -> El texto que se mostrará en el título del modal.\n' + 'infoText - string -> Texto que se mostrará en la etiqueta small dentro del titulo del modal.\n' + 'label - string -> Texto que se mostrará en la etiqueta label y en el div con clase input-group-addon.\n' + 'textBtn string -> Texto que se mostrará en el boton que envía el formulario.\n' + 'inputType - string -> Texto que define el atributo type del input del formulario.\n' + 'options - Array de Objects -> Array que se utilizará para crear las etiquetas options si el input es de\n' + 'tipo select debe definir las propiedades value y text. Por ejemplo:\n' + 'options: [                                                         \n' + '            {value: \'valueOption\', text: \'textOption\'},        \n' + '            {value: \'valueOption\', text: \'textOption\'},        \n' + '            ...                                                    \n' + '         ]                                                         \n';
            console.log(message);
            window.alert('Ver mensaje en consola');
            return;
        }
        if (Object.isObject(textsToDisplay)) {
            $('.modal-title').html('¿ ' + textsToDisplay.title + ' <span class="span-display label"></span> ? <br /> <small>' + textsToDisplay.infoText + '</small>');
            $('.sr-only, .input-group-addon').text(textsToDisplay.label);
        }
        if (modalSize !== '' && modalSize !== undefined && modalSize !== null) {
            $('.modal-dialog').addClass(modalSize);
        }
        $('.span-display').html( true ? name : inputValue);
        if (textsToDisplay.inputType.toLowerCase() === 'select') {
            $('#inputFormId').remove();
            $('.input-group').append($('<select>').attr('id', 'inputFormId').attr('name', 'inputFormId').addClass('form-control'));
            if (Array.isArray(textsToDisplay.options)) {
                $.each(textsToDisplay.options, function (i, item) {
                    $('#inputFormId').append($('<option>', {
                        value: item.value,
                        text: item.text
                    }));
                });
                $('#inputFormId').val(inputValue);
            } else {
                console.log(message);
            }
        } else {
            $('#inputFormId').remove();
            $('.input-group').append($('<input>').attr('id', 'inputFormId').attr('name', 'inputFormId').addClass('form-control'));
            $('#inputFormId').attr('type', textsToDisplay.inputType).val(inputValue);
        }
        if (method.toUpperCase() === 'DELETE') {
            $('#inputFormId').attr('disabled', 'disabled');
            $('.span-display').addClass('label-danger');
            $('.modal-title > small').addClass('text-danger');
            $btnSubmit.removeClass('btn-primary').addClass('btn-danger');
            $btnSubmit.html('<i class="fa fa-trash-o" aria-hidden="true"></i> ' + textsToDisplay.textBtn);
        } else {
            $('#inputFormId').removeAttr('disabled');
            $('.span-display').addClass('label-warning');
            $('.modal-title > small').addClass('text-warning');
            $btnSubmit.removeClass('btn-primary').addClass('btn-warning');
            $btnSubmit.html('<i class="fa fa-exchange" aria-hidden="true"></i> ' + textsToDisplay.textBtn);
        }
        $('input[name=_method]').val(method.toUpperCase());
        typeof files === "boolean" ? files ? $form.attr('enctype', 'multipart/form-data') : null : $form.attr('enctype', files);
        var oldAction = $form.attr('action');
        var action = oldAction.replace('subdir', replaceInAction).replace('{id}', id);
        $form.attr('action', action);
        $btnSubmit.click(function () {
            var data = $form.serialize();
            var url = $form.attr('action');
            $('#modalForms').hide();
            if (method.toLowerCase() === 'delete') {
                $('#inputFormId').removeAttr('disabled');
                $.post(url, data, function (response) {
                    $row.fadeOut();
                });
            } else {
                $form.submit();
            }
        });
        $('#modalForms').on('hide.bs.modal', function (e) {
            $form.attr('action', oldAction);
        });
    }

    /*********************************************************************
     * Funcionalidad y comportamientos del Backend del sitio.
     * --------------------------------------------------------
     *
     * Info helpers in forms
     *
     *******************************************/
    var icons = $('.help-info > .help-icon');
    var texts = $('.help-info > .help-text');

    texts.hide();

    icons.click(function (event) {
        event.preventDefault();
        $(this).next().fadeToggle('slow', 'linear');
    });

    /************************************************************************************
     *  Detecta si hay algo en el input hiden de imagenes que se eliminarán y agrega
     *  la clase correspondiente.
     * **********************************************************************************/
    if ($('#removedImages').val() !== '' && $('#removedImages').val() !== undefined) {
        var removed = $('#removedImages').val();
        if (removed !== '') {
            removed = removed.split('|');
        }
        removed.pop();
        var images = $('.img-clickable');
        for (var i = images.length - 1; i >= 0; i--) {
            for (var j = removed.length - 1; j >= 0; j--) {
                if (images[i] === removed[j]) {
                    images[i].addClass('img-clicked');
                }
            }
        }
    }

    /**************************************************************************
     *  Añade la clase img-clicked a las imágenes seleccionadas y agrega el
     *  nombre de la imágen al input removedImages para ser eliminadas al
     *  enviar el form.
     * *************************************************************************/
    $('.img-clickable').click(function (event) {
        event.preventDefault();
        if ($(this).hasClass('img-clicked')) {
            $(this).removeClass('img-clicked');
            removeAddFromInputValue($(this), $('#removedImages'), $('#actualImages'));
        } else {
            $(this).addClass('img-clicked');
            removeAddFromInputValue($(this), $('#actualImages'), $('#removedImages'));
        }
    });

    /******************************************************************
     *  Button delete Cottage
     * *****************************************************************/
    $('.delete-cottage').click(function (event) {
        texts = {
            name: false,
            title: 'Esta seguro que desea eliminar la cabaña',
            infoText: 'Esto eliminará permanentemente la cabaña de la base de datos.',
            label: 'Eliminar cabaña',
            textBtn: 'Eliminar cabaña',
            inputType: 'number',
            options: ''
        };
        setModalForms($(this), 'DELETE', false, 'cottages', texts);
    });

    /******************************************************************
     *  Button edit type User
     * *****************************************************************/
    $('.btn-edit-type').click(function (event) {
        texts = {
            name: true,
            title: 'Esta seguro que desea cambiar el rol del usuario',
            infoText: 'Esto pude dar mayor acceso al sistema a dicho usuario.',
            label: 'Roles',
            textBtn: 'Actualizar rol',
            inputType: 'select',
            options: [{ value: 'frecuente', text: 'Frecuente' }, { value: 'empleado', text: 'Empleado' }, { value: 'administrador', text: 'Administrador' }, { value: 'sysadmin', text: 'Sysadmin' }]
        };
        setModalForms($(this), 'PUT', false, 'users', texts);
    });

    /******************************************************************
     *  Button edit type User
     * *****************************************************************/
    $('.btn-delete-user').click(function (event) {
        texts = {
            name: true,
            title: 'Esta seguro que desea eliminar al usuario',
            infoText: 'Esto eliminará permanentemente el usuario de la base de datos.',
            label: 'Eliminar a',
            textBtn: 'Eliminar usuario',
            inputType: 'text',
            options: ''
        };
        setModalForms($(this), 'DELETE', false, 'users', texts);
    });
});

/***/ }),

/***/ "./resources/assets/js/backend/main-menu-backend.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// Fuente: https://webdesign.tutsplus.com/tutorials/orman-clarks-vertical-navigation-menu-the-css3-version--webdesign-5944

$(document).ready(function (e) {
    var menu_ul = $('.menu > li > ul'),
        menu_a = $('.menu > li > a');

    function activeMenu(regExp, findIn) {
        for (var i = findIn.length - 1; i >= 0; i--) {
            var a = findIn[i];
            var t = findIn[i].text;
            if (regExp.test(t.toLowerCase())) {
                $(a).addClass('active').next().stop(true, true).slideDown('normal');
            }
        }
    }

    var path = window.location.pathname;
    path = path.split('/');
    path.shift();

    menu_ul.hide();

    if (/cottages/.test(path)) {
        activeMenu(/cabañas/, menu_a);
        path[2] ? null : $('#main_content').removeClass('col-md-4').addClass('col-md-6');
        /create/.test(path) || /edit/.test(path) ? $('.panel').addClass('form-panel') : null;
    } else if (/users/.test(path)) {
        activeMenu(/usuarios/, menu_a);
        $('#main_content').removeClass('col-md-4').addClass('col-md-6');
    } else if (/frontend/.test(path)) {
        activeMenu(/página principal/, menu_a);
        $('#main_content').removeClass('col-md-4').addClass('col-md-6');
    } else if (/food/.test(path)) {
        $('#main_content').removeClass('col-md-4').addClass('col-md-6');
    } else if (/reports/.test(path)) {
        $('#main_content').removeClass('col-md-offset-1 col-md-4').addClass('col-md-12');
    } else {
        activeMenu(/panel/, menu_a);
        $('#main_content').removeClass('col-md-4').addClass('col-md-8');
    }

    menu_a.click(function (e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true, true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true, true).slideUp('normal');
        }
    });
});

/***/ }),

/***/ "./resources/assets/less/backend/backend.less":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/less/frontend/cottages.less":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/less/frontend/frontend.less":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/less/frontend/profile.less":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/app.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/backend/main-menu-backend.js");
__webpack_require__("./resources/assets/js/backend/backend.js");
__webpack_require__("./resources/assets/less/frontend/frontend.less");
__webpack_require__("./resources/assets/less/frontend/cottages.less");
__webpack_require__("./resources/assets/less/frontend/profile.less");
__webpack_require__("./resources/assets/less/backend/backend.less");
module.exports = __webpack_require__("./resources/assets/sass/app.scss");


/***/ })

/******/ });