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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/frontend/cottage-show.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function (event) {
    moment.locale('es');
    $('h2.title-sections').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $children = $this.children('i');
        var $slideElement = $this.siblings('.element-slide');
        $slideElement.slideToggle('slow');
        if ($children.hasClass('fa-caret-down')) {
            $children.removeClass('fa-caret-down').addClass('fa-caret-right');
        } else {
            $children.removeClass('fa-caret-right').addClass('fa-caret-down');
        }
    });

    (function cottageCalendar() {
        if ($('#calendar').length) {
            var $calendar = $('#calendar');
            $calendar.clndr({
                daysOfTheWeek: moment.weekdays()
            });
            var $table = $('.clndr-table');
        }
    })();
});

/***/ }),

/***/ "./resources/assets/js/frontend/cottages-index.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


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

/***/ }),

/***/ "./resources/assets/js/frontend/frontend.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function (event) {
    /******************************************************************
     *  Menú pegajoso
     * *****************************************************************/
    /*var altura = $('.general-menu').offset().top;
     $(window).on('scroll', function(){
        if ( $(window).scrollTop() > altura ){
            // $('.general-menu').addClass('menu-fixed');
            // $('#arrow_left, #arrow_right').css('top', '8px');
            // $('#overlay').css('margin-top', '50px');
            // $('.container-logo').css('top', '8%');
        } else {
            // $('.general-menu').removeClass('menu-fixed');
            // $('#arrow_left, #arrow_right').removeAttr('style');
            // $('#overlay').removeAttr('style');
            // $('.container-logo').removeAttr('style');
        }
    });*/

    /****
     * Cambia el fondo del header cada 10 segundos.
     * */
    //H@Ubuntu16
    setInterval(backgroundChange, 10000);
    var contador = 1;
    function continuousNumber(min, max) {
        var result = min + contador;
        contador++;
        if (result > max) {
            contador = 1, result = 1;
        };
        return result;
    }
    function backgroundChange() {
        $('#overlay').animate({
            'opacity': 1
        }, 1500, function () {
            $('#header').css('background-image', 'url("http://' + window.location.host + '/images/frontend/cabanas' + continuousNumber(1, 11) + '.jpg")');
            $('#overlay').animate({
                'opacity': 0
            }, 1500);
        });
    }

    /*******
     *
     * Fondo de dibujos en login y register.
     *
     * */
    var path = window.location.pathname;
    function backgroundDrawing(dibujo, size, position) {
        var repeat = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'no-repeat';

        $('#content').css('background-image', 'url("http://' + window.location.host + '/images/frontend/' + dibujo + '.jpg")').css('background-repeat', repeat).css('background-size', size).css('background-position', position);
    }

    if (/register/.test(path) || /new_email_confirmation/.test(path)) {
        backgroundDrawing('dibujo-carpincho', 'contain', '100% 50%');
        $('.card').css('box-shadow', '3px 3px 17px 6px #333333');
    } else if (/login/.test(path)) {
        backgroundDrawing('dibujo-yaguarete', 'contain', '0% 50%');
        $('#content').css('background-color', '#f9f9f9');
        $('#arrow_left, #arrow_right').css('border-bottom-color', '#f9f9f9');
        $('.card').css('box-shadow', '3px 3px 17px 6px #333333');
    } else if (/reset/.test(path)) {
        backgroundDrawing('dibujo-jabali', 'contain', '85% 50%');
        $('.card').css('box-shadow', '3px 3px 17px 6px #333333');
    } else if (/profile/.test(path)) {
        backgroundDrawing('dibujo-coati-2', 'contain', '100% 50%');
    } else if (/order/.test(path)) {
        backgroundDrawing('dibujo-aguara-guazu', '45%', '100% 0%');
    } else if (/liquidation/.test(path)) {
        backgroundDrawing('dibujo-tapir', '50%', '100% 50%');
    } else if (/rentals\/edit/.test(path)) {
        backgroundDrawing('dibujo-yaguarete-2', '50%', '100% 50%');
    } else if (/rentals/.test(path)) {
        backgroundDrawing('dibujo-mono', 'contain', '100% 50%');
    } else if (/new_email_confirmation/.test(path)) {
        backgroundDrawing('dibujo-yacare', 'contain', '100% 50%');
    }

    function setFrontendModal(modalId, ttModal, bodyModal) {
        // (type === 'sm' || type === 'lg') ? $('.modal-dialog').addClass('modal-' + type) : null;
        $('#' + modalId + ' > .modal-dialog > .modal-content > .modal-header > .modal-title').text(ttModal);
        $('#' + modalId + ' > .modal-dialog > .modal-content > .modal-body').html(bodyModal);
    }

    $('#phone, #cel').click(function (e) {
        var lnk = e.target;
        var body = '';
        var $btn = $(lnk);

        if (/fijo/.test($btn.data('tt-modal'))) {
            body = '<h2 class="text-center">\n                        <i class="fa fa-phone" aria-hidden="true"></i> ' + $btn.data('tt-modal') + '\n                    </h2>\n                    <h3 class="text-center">\n                        <a href="#" class="btn btn-primary btn-lg">\n                            <i class="fa fa-phone-square" aria-hidden="true"></i> ' + $btn.data('body-modal') + '\n                        </a>\n                    </h3>';
        } else {
            body = '<h2 class="text-center">\n                        <i class="fa fa-mobile" aria-hidden="true"></i> ' + $btn.data('tt-modal') + '\n                    </h2>\n                    <h3 class="text-center">\n                        <a href="#" class="btn btn-success btn-lg">\n                            <i class="fa fa-whatsapp" aria-hidden="true"></i> ' + $btn.data('body-modal') + '\n                        </a>\n                    </h3>';
        }
        setFrontendModal('msg_modals_frontend', $btn.data('tt-modal'), body);
    });
});

/***/ }),

/***/ "./resources/assets/js/frontend/profile-edit.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
    /********
    * Configuración del bootstrap-datepicker
    * */
    // Este trozo de código configura el día domingo como primer día de la semana en moment con locale = 'es'
    // lo cual hace que el datetimepicker muestre el día domingo en primer lugar.
    moment.updateLocale('es', {
        week: { dow: 0 }
    });
    $('#birth #dateOfBirth').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    /*******
    * Configuracion de la sección de avatars y el input de subir imágenes
    * */
    $('#upload_image').prop('checked', false);
    $('.imageProfile').slideToggle('fast');
    $('#upload_image').on('click', function (e) {
        $('.imageProfile').slideToggle('slow');
        $('#avatar_profile').slideToggle('slow');
        $('.avatar-selected').removeClass('avatar-selected');
        $('input[name=image_avatar]').val('');
        $('input[name=image_profile]').val('');
        if (!$('#upload_image').prop('checked')) window.profileFunc();
    });

    $('.img-avatar').on('click', function (e) {
        if (!$(this).hasClass('avatar-selected')) {
            $('.avatar-selected').removeClass('avatar-selected');
            $(this).addClass('avatar-selected');
            $('input[name=image_avatar]').val($(this).data('avatar'));
        } else {
            $(this).removeClass('avatar-selected');
        }
    });
});

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/frontend/frontend.js");
__webpack_require__("./resources/assets/js/frontend/cottages-index.js");
__webpack_require__("./resources/assets/js/frontend/cottage-show.js");
module.exports = __webpack_require__("./resources/assets/js/frontend/profile-edit.js");


/***/ })

/******/ });