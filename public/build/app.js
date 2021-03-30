(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j|t)sx?$":
/*!*****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.(j|t)sx?$ ***!
  \*****************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./hello_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j|t)sx?$";

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js":
/*!******************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js ***!
  \******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var stimulus__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! stimulus */ "./node_modules/stimulus/index.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }














function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    _classCallCheck(this, _default);

    return _super.apply(this, arguments);
  }

  _createClass(_default, [{
    key: "connect",
    value: function connect() {
      this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }
  }]);

  return _default;
}(stimulus__WEBPACK_IMPORTED_MODULE_12__.Controller);



/***/ }),

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./bootstrap */ "./assets/bootstrap.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _jquery_modal_min__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./jquery.modal.min */ "./assets/jquery.modal.min.js");
/* harmony import */ var _jquery_modal_min__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_jquery_modal_min__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var easymde__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! easymde */ "./node_modules/easymde/src/js/easymde.js");
/* harmony import */ var easymde__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(easymde__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var marked__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! marked */ "./node_modules/marked/lib/marked.js");
/* harmony import */ var marked__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(marked__WEBPACK_IMPORTED_MODULE_6__);
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");


/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
 // start the Stimulus application






var markdown_editor = document.getElementById("markdown-editor");

if (markdown_editor) {
  var mk = new (easymde__WEBPACK_IMPORTED_MODULE_5___default())({
    element: markdown_editor,
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    maxHeight: '200px',
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "|", "ordered-list", "unordered-list", "|", "link", "image", "|", "horizontal-rule", "clean-block", "|", "side-by-side"]
  });
  mk.toggleSideBySide();
}

var modal_data = document.getElementById("modal-data");
var modal_view = document.getElementById("modal-view");

if (modal_view) {
  modal_view.addEventListener('click', function () {
    var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(marked__WEBPACK_IMPORTED_MODULE_6___default()(modal_data.innerHTML));
    var modal = $('.modal');
    modal.addClass('modal-sm');
    $('#simple-adc-modal-header').html('Media Info');
    $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);
    $("#simple-adc-modal").modal('show');
  });
}

if (window.location.pathname === "/upload") {
  var formdata = new FormData();
  formdata.append("preview", true);
  $('#upload_form_torrent_file').change(function () {
    if (formdata.has("upload_form[torrent_file]")) {
      formdata["delete"]("upload_form[torrent_file]");
    }

    if ($(this).prop('files').length > 0) {
      var file = $(this).prop('files')[0];
      formdata.append("upload_form[torrent_file]", file);
    }
  });
  var contentInfo = new (easymde__WEBPACK_IMPORTED_MODULE_5___default())({
    element: document.getElementById("upload_form_content_info"),
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    maxHeight: '200px',
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "|", "ordered-list", "unordered-list", "|", "link", "image", "|", "horizontal-rule", "clean-block", "|", "side-by-side"]
  });
  contentInfo.toggleSideBySide();
  var rs_textarea = document.getElementById("upload_form_release_details");
  var releaseDetails = new (easymde__WEBPACK_IMPORTED_MODULE_5___default())({
    element: rs_textarea,
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    inputStyle: "textarea",
    maxHeight: '300px',
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "|", "ordered-list", "unordered-list", "|", "link", "image", "|", "horizontal-rule", "clean-block", "|", "side-by-side"]
  });
  releaseDetails.toggleSideBySide();
  var mi_textarea = document.getElementById("upload_form_mediainfo");
  var mediainfo = new (easymde__WEBPACK_IMPORTED_MODULE_5___default())({
    element: mi_textarea,
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    inputStyle: "textarea",
    maxHeight: '300px',
    toolbar: ["bold", "italic", "strikethrough", "|", "code", "quote", "|", "ordered-list", "unordered-list", "|", "link", "image", "|", "horizontal-rule", "clean-block", "|", "side-by-side"]
  });
  mediainfo.toggleSideBySide();
  var template = null;
  $.ajax({
    url: "/api/template",
    type: 'get',
    dataType: 'html',
    async: false,
    cache: false,
    success: function success(data) {
      template = JSON.parse(data);
    }
  });
  var radiobtn = document.upload_form.template_radio;
  releaseDetails.value(template['dvd_template']);
  radiobtn[0].addEventListener('change', function () {
    releaseDetails.value(template['dvd_template']);
  });
  radiobtn[1].addEventListener('change', function () {
    releaseDetails.value(template['bdmv_template']);
  });
  radiobtn[2].addEventListener('change', function () {
    releaseDetails.value(template['uhd_template']);
  });
  var get_content = document.getElementById("content-url-button");
  get_content.addEventListener('click', function () {
    var scrapper = document.getElementById("upload-scrapper");
    var scrapper_url = "/api/scrapper/" + scrapper.options[scrapper.selectedIndex].value + "?url=";
    $.ajax({
      url: encodeURI(scrapper_url + document.getElementById("upload_form_content_url").value),
      type: 'get',
      dataType: 'html',
      async: false,
      cache: false,
      success: function success(data) {
        var content = JSON.parse(data)['content_info'];
        contentInfo.value(content.substring(1));
        document.getElementById("image-from-scrapper").src = JSON.parse(data)['image'];
        document.getElementById("upload_form_content_poster").value = JSON.parse(data)['image'];
        document.getElementById("image-from-scrapper-content").classList.remove("d-none");
      }
    });
  });
  var uploadContent = document.getElementById("upload-content");
  var previewContent = document.getElementById("preview-content");
  var preview = document.getElementById("preview_btn");
  preview.addEventListener('click', function () {
    uploadContent.classList.add("d-none");
    previewContent.classList.remove("d-none");
    var uploadTorrentName = document.querySelector("input[name='upload_form[torrent_name]']");
    var previewTorrentSize = document.getElementById("preview-torrent-size");
    var previewTorrentName = document.getElementById("preview-torrent-name");
    var previewTorrentInfohash = document.getElementById("preview-info-hash");
    var previewTorrentFiles = document.getElementById("preview-torrent-files");
    var previewContentInfo = document.getElementById("content-parsed-message");
    var previewReleaseInfo = document.getElementById("release-details");
    var previewMediainfo = document.getElementById("adc-torrent-mediainfo");
    var previewImage = document.getElementById("preview-image");
    var previewShowMediaInfoBlock = document.getElementById("show-media-info-block");
    var previewNoMediaInfoBlock = document.getElementById("no-media-info-block");
    previewTorrentName.innerHTML = uploadTorrentName.value;
    previewReleaseInfo.innerHTML = marked__WEBPACK_IMPORTED_MODULE_6___default()(releaseDetails.value());
    previewContentInfo.innerHTML = marked__WEBPACK_IMPORTED_MODULE_6___default()(contentInfo.value());
    previewImage.src = document.getElementById("image-from-scrapper").src;
    previewMediainfo.addEventListener('click', function () {
      var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(marked__WEBPACK_IMPORTED_MODULE_6___default()(mediainfo.value()));
      var modal = $('.modal');
      modal.addClass('modal-sm');
      $('#simple-adc-modal-header').html('Media Info');
      $('#simple-adc-modal .modal-body').html(innerDiv[0].outerHTML);
      $("#simple-adc-modal").modal('show');
    });
    formdata.set("preview", true);
    $.ajax({
      url: "/upload",
      type: "POST",
      data: formdata,
      processData: false,
      contentType: false,
      success: function success(result) {
        try {
          result = JSON.parse(result);
        } catch (_unused) {}

        previewTorrentName.innerHTML = result['name'];
        previewTorrentSize.innerHTML = result['size'];
        previewTorrentInfohash.innerHTML = result['files']['info_hash'];
        previewTorrentFiles.innerHTML = result['files']['total'];
      }
    });
  });
  var upload_return = document.getElementById("upload_return");
  upload_return.addEventListener('click', function () {
    uploadContent.classList.remove("d-none");
    previewContent.classList.add("d-none");
  });
}

/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
 // Registers Stimulus controllers from controllers.json and in the controllers/ directory

var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j|t)sx?$"));

/***/ }),

/***/ "./assets/jquery.modal.min.js":
/*!************************************!*\
  !*** ./assets/jquery.modal.min.js ***!
  \************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/* module decorator */ module = __webpack_require__.nmd(module);
/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
__webpack_require__(/*! core-js/modules/es.parse-int.js */ "./node_modules/core-js/modules/es.parse-int.js");

__webpack_require__(/*! core-js/modules/es.string.anchor.js */ "./node_modules/core-js/modules/es.string.anchor.js");

__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");

__webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");

__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");

__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");

__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");

__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");

__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*
    A simple jQuery modal (http://github.com/kylefox/jquery-modal)
    Version 0.9.2
*/
!function (o) {
  "object" == ( false ? 0 : _typeof(module)) && "object" == _typeof(module.exports) ? o(__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"), window, document) : o(jQuery, window, document);
}(function (o, t, i, e) {
  var s = [],
      l = function l() {
    return s.length ? s[s.length - 1] : null;
  },
      n = function n() {
    var o,
        t = !1;

    for (o = s.length - 1; o >= 0; o--) {
      s[o].$blocker && (s[o].$blocker.toggleClass("current", !t).toggleClass("behind", t), t = !0);
    }
  };

  o.modal = function (t, i) {
    var e, n;
    if (this.$body = o("body"), this.options = o.extend({}, o.modal.defaults, i), this.options.doFade = !isNaN(parseInt(this.options.fadeDuration, 10)), this.$blocker = null, this.options.closeExisting) for (; o.modal.isActive();) {
      o.modal.close();
    }
    if (s.push(this), t.is("a")) {
      if (n = t.attr("href"), this.anchor = t, /^#/.test(n)) {
        if (this.$elm = o(n), 1 !== this.$elm.length) return null;
        this.$body.append(this.$elm), this.open();
      } else this.$elm = o("<div>"), this.$body.append(this.$elm), e = function e(o, t) {
        t.elm.remove();
      }, this.showSpinner(), t.trigger(o.modal.AJAX_SEND), o.get(n).done(function (i) {
        if (o.modal.isActive()) {
          t.trigger(o.modal.AJAX_SUCCESS);
          var s = l();
          s.$elm.empty().append(i).on(o.modal.CLOSE, e), s.hideSpinner(), s.open(), t.trigger(o.modal.AJAX_COMPLETE);
        }
      }).fail(function () {
        t.trigger(o.modal.AJAX_FAIL);
        var i = l();
        i.hideSpinner(), s.pop(), t.trigger(o.modal.AJAX_COMPLETE);
      });
    } else this.$elm = t, this.anchor = t, this.$body.append(this.$elm), this.open();
  }, o.modal.prototype = {
    constructor: o.modal,
    open: function open() {
      var t = this;
      this.block(), this.anchor.blur(), this.options.doFade ? setTimeout(function () {
        t.show();
      }, this.options.fadeDuration * this.options.fadeDelay) : this.show(), o(i).off("keydown.modal").on("keydown.modal", function (o) {
        var t = l();
        27 === o.which && t.options.escapeClose && t.close();
      }), this.options.clickClose && this.$blocker.click(function (t) {
        t.target === this && o.modal.close();
      });
    },
    close: function close() {
      s.pop(), this.unblock(), this.hide(), o.modal.isActive() || o(i).off("keydown.modal");
    },
    block: function block() {
      this.$elm.trigger(o.modal.BEFORE_BLOCK, [this._ctx()]), this.$body.css("overflow", "hidden"), this.$blocker = o('<div class="' + this.options.blockerClass + ' blocker current"></div>').appendTo(this.$body), n(), this.options.doFade && this.$blocker.css("opacity", 0).animate({
        opacity: 1
      }, this.options.fadeDuration), this.$elm.trigger(o.modal.BLOCK, [this._ctx()]);
    },
    unblock: function unblock(t) {
      !t && this.options.doFade ? this.$blocker.fadeOut(this.options.fadeDuration, this.unblock.bind(this, !0)) : (this.$blocker.children().appendTo(this.$body), this.$blocker.remove(), this.$blocker = null, n(), o.modal.isActive() || this.$body.css("overflow", ""));
    },
    show: function show() {
      this.$elm.trigger(o.modal.BEFORE_OPEN, [this._ctx()]), this.options.showClose && (this.closeButton = o('<a href="#close-modal" rel="modal:close" class="close-modal ' + this.options.closeClass + '">' + this.options.closeText + "</a>"), this.$elm.append(this.closeButton)), this.$elm.addClass(this.options.modalClass).appendTo(this.$blocker), this.options.doFade ? this.$elm.css({
        opacity: 0,
        display: "inline-block"
      }).animate({
        opacity: 1
      }, this.options.fadeDuration) : this.$elm.css("display", "inline-block"), this.$elm.trigger(o.modal.OPEN, [this._ctx()]);
    },
    hide: function hide() {
      this.$elm.trigger(o.modal.BEFORE_CLOSE, [this._ctx()]), this.closeButton && this.closeButton.remove();
      var t = this;
      this.options.doFade ? this.$elm.fadeOut(this.options.fadeDuration, function () {
        t.$elm.trigger(o.modal.AFTER_CLOSE, [t._ctx()]);
      }) : this.$elm.hide(0, function () {
        t.$elm.trigger(o.modal.AFTER_CLOSE, [t._ctx()]);
      }), this.$elm.trigger(o.modal.CLOSE, [this._ctx()]);
    },
    showSpinner: function showSpinner() {
      this.options.showSpinner && (this.spinner = this.spinner || o('<div class="' + this.options.modalClass + '-spinner"></div>').append(this.options.spinnerHtml), this.$body.append(this.spinner), this.spinner.show());
    },
    hideSpinner: function hideSpinner() {
      this.spinner && this.spinner.remove();
    },
    _ctx: function _ctx() {
      return {
        elm: this.$elm,
        $elm: this.$elm,
        $blocker: this.$blocker,
        options: this.options,
        $anchor: this.anchor
      };
    }
  }, o.modal.close = function (t) {
    if (o.modal.isActive()) {
      t && t.preventDefault();
      var i = l();
      return i.close(), i.$elm;
    }
  }, o.modal.isActive = function () {
    return s.length > 0;
  }, o.modal.getCurrent = l, o.modal.defaults = {
    closeExisting: !0,
    escapeClose: !0,
    clickClose: !0,
    closeText: "Close",
    closeClass: "",
    modalClass: "modal",
    blockerClass: "jquery-modal",
    spinnerHtml: '<div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div>',
    showSpinner: !0,
    showClose: !0,
    fadeDuration: null,
    fadeDelay: 1
  }, o.modal.BEFORE_BLOCK = "modal:before-block", o.modal.BLOCK = "modal:block", o.modal.BEFORE_OPEN = "modal:before-open", o.modal.OPEN = "modal:open", o.modal.BEFORE_CLOSE = "modal:before-close", o.modal.CLOSE = "modal:close", o.modal.AFTER_CLOSE = "modal:after-close", o.modal.AJAX_SEND = "modal:ajax:send", o.modal.AJAX_SUCCESS = "modal:ajax:success", o.modal.AJAX_FAIL = "modal:ajax:fail", o.modal.AJAX_COMPLETE = "modal:ajax:complete", o.fn.modal = function (t) {
    return 1 === this.length && new o.modal(this, t), this;
  }, o(i).on("click.modal", 'a[rel~="modal:close"]', o.modal.close), o(i).on("click.modal", 'a[rel~="modal:open"]', function (t) {
    t.preventDefault(), o(this).modal();
  });
});

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "?b2fd":
/*!********************!*\
  !*** fs (ignored) ***!
  \********************/
/***/ (() => {

/* (ignored) */

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_fu-e0717c"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vfC9cXC4oanx0KXN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy5qc29uIiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9oZWxsb19jb250cm9sbGVyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Jvb3RzdHJhcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanF1ZXJ5Lm1vZGFsLm1pbi5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3MiLCJ3ZWJwYWNrOi8vL2lnbm9yZWR8L2hvbWUvdWJ1bnR1L2FkY3YyL25vZGVfbW9kdWxlcy90eXBvLWpzfGZzIl0sIm5hbWVzIjpbIm1hcmtkb3duX2VkaXRvciIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJtayIsIkVhc3lNREUiLCJlbGVtZW50IiwicHJvbXB0VVJMcyIsInRhYlNpemUiLCJzcGVsbENoZWNrZXIiLCJuYXRpdmVTcGVsbGNoZWNrIiwic2lkZUJ5U2lkZUZ1bGxzY3JlZW4iLCJtYXhIZWlnaHQiLCJ0b29sYmFyIiwidG9nZ2xlU2lkZUJ5U2lkZSIsIm1vZGFsX2RhdGEiLCJtb2RhbF92aWV3IiwiYWRkRXZlbnRMaXN0ZW5lciIsImlubmVyRGl2IiwiJCIsImh0bWwiLCJtYXJrZWQiLCJpbm5lckhUTUwiLCJtb2RhbCIsImFkZENsYXNzIiwib3V0ZXJIVE1MIiwid2luZG93IiwibG9jYXRpb24iLCJwYXRobmFtZSIsImZvcm1kYXRhIiwiRm9ybURhdGEiLCJhcHBlbmQiLCJjaGFuZ2UiLCJoYXMiLCJwcm9wIiwibGVuZ3RoIiwiZmlsZSIsImNvbnRlbnRJbmZvIiwicnNfdGV4dGFyZWEiLCJyZWxlYXNlRGV0YWlscyIsImlucHV0U3R5bGUiLCJtaV90ZXh0YXJlYSIsIm1lZGlhaW5mbyIsInRlbXBsYXRlIiwiYWpheCIsInVybCIsInR5cGUiLCJkYXRhVHlwZSIsImFzeW5jIiwiY2FjaGUiLCJzdWNjZXNzIiwiZGF0YSIsIkpTT04iLCJwYXJzZSIsInJhZGlvYnRuIiwidXBsb2FkX2Zvcm0iLCJ0ZW1wbGF0ZV9yYWRpbyIsInZhbHVlIiwiZ2V0X2NvbnRlbnQiLCJzY3JhcHBlciIsInNjcmFwcGVyX3VybCIsIm9wdGlvbnMiLCJzZWxlY3RlZEluZGV4IiwiZW5jb2RlVVJJIiwiY29udGVudCIsInN1YnN0cmluZyIsInNyYyIsImNsYXNzTGlzdCIsInJlbW92ZSIsInVwbG9hZENvbnRlbnQiLCJwcmV2aWV3Q29udGVudCIsInByZXZpZXciLCJhZGQiLCJ1cGxvYWRUb3JyZW50TmFtZSIsInF1ZXJ5U2VsZWN0b3IiLCJwcmV2aWV3VG9ycmVudFNpemUiLCJwcmV2aWV3VG9ycmVudE5hbWUiLCJwcmV2aWV3VG9ycmVudEluZm9oYXNoIiwicHJldmlld1RvcnJlbnRGaWxlcyIsInByZXZpZXdDb250ZW50SW5mbyIsInByZXZpZXdSZWxlYXNlSW5mbyIsInByZXZpZXdNZWRpYWluZm8iLCJwcmV2aWV3SW1hZ2UiLCJwcmV2aWV3U2hvd01lZGlhSW5mb0Jsb2NrIiwicHJldmlld05vTWVkaWFJbmZvQmxvY2siLCJzZXQiLCJwcm9jZXNzRGF0YSIsImNvbnRlbnRUeXBlIiwicmVzdWx0IiwidXBsb2FkX3JldHVybiIsImFwcCIsInN0YXJ0U3RpbXVsdXNBcHAiLCJyZXF1aXJlIiwibyIsIm1vZHVsZSIsImV4cG9ydHMiLCJqUXVlcnkiLCJ0IiwiaSIsImUiLCJzIiwibCIsIm4iLCIkYmxvY2tlciIsInRvZ2dsZUNsYXNzIiwiJGJvZHkiLCJleHRlbmQiLCJkZWZhdWx0cyIsImRvRmFkZSIsImlzTmFOIiwicGFyc2VJbnQiLCJmYWRlRHVyYXRpb24iLCJjbG9zZUV4aXN0aW5nIiwiaXNBY3RpdmUiLCJjbG9zZSIsInB1c2giLCJpcyIsImF0dHIiLCJhbmNob3IiLCJ0ZXN0IiwiJGVsbSIsIm9wZW4iLCJlbG0iLCJzaG93U3Bpbm5lciIsInRyaWdnZXIiLCJBSkFYX1NFTkQiLCJnZXQiLCJkb25lIiwiQUpBWF9TVUNDRVNTIiwiZW1wdHkiLCJvbiIsIkNMT1NFIiwiaGlkZVNwaW5uZXIiLCJBSkFYX0NPTVBMRVRFIiwiZmFpbCIsIkFKQVhfRkFJTCIsInBvcCIsInByb3RvdHlwZSIsImNvbnN0cnVjdG9yIiwiYmxvY2siLCJibHVyIiwic2V0VGltZW91dCIsInNob3ciLCJmYWRlRGVsYXkiLCJvZmYiLCJ3aGljaCIsImVzY2FwZUNsb3NlIiwiY2xpY2tDbG9zZSIsImNsaWNrIiwidGFyZ2V0IiwidW5ibG9jayIsImhpZGUiLCJCRUZPUkVfQkxPQ0siLCJfY3R4IiwiY3NzIiwiYmxvY2tlckNsYXNzIiwiYXBwZW5kVG8iLCJhbmltYXRlIiwib3BhY2l0eSIsIkJMT0NLIiwiZmFkZU91dCIsImJpbmQiLCJjaGlsZHJlbiIsIkJFRk9SRV9PUEVOIiwic2hvd0Nsb3NlIiwiY2xvc2VCdXR0b24iLCJjbG9zZUNsYXNzIiwiY2xvc2VUZXh0IiwibW9kYWxDbGFzcyIsImRpc3BsYXkiLCJPUEVOIiwiQkVGT1JFX0NMT1NFIiwiQUZURVJfQ0xPU0UiLCJzcGlubmVyIiwic3Bpbm5lckh0bWwiLCIkYW5jaG9yIiwicHJldmVudERlZmF1bHQiLCJnZXRDdXJyZW50IiwiZm4iXSwibWFwcGluZ3MiOiI7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsMEk7Ozs7Ozs7Ozs7Ozs7OztBQ3RCQSxpRUFBZTtBQUNmLENBQUMsRTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ0RELHVCQUF1QiwyQkFBMkIsMkVBQTJFLGtDQUFrQyxtQkFBbUIsR0FBRyxFQUFFLE9BQU8sa0NBQWtDLDhIQUE4SCxHQUFHLEVBQUUscUJBQXFCOztBQUVqVTtBQUNBO0FBQ047QUFDSjtBQUNTO0FBQ2hCO0FBQ1k7QUFDRjtBQUNEO0FBQ0E7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Q0FuSEMsQ0FBRixDOzs7Ozs7Ozs7Ozs7QUNKQTs7Ozs7Ozs7Ozs7QUNBQSxlIiwiZmlsZSI6ImFwcC5qcyIsInNvdXJjZXNDb250ZW50IjpbInZhciBtYXAgPSB7XG5cdFwiLi9oZWxsb19jb250cm9sbGVyLmpzXCI6IFwiLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhLi9hc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qc1wiXG59O1xuXG5cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0KHJlcSkge1xuXHR2YXIgaWQgPSB3ZWJwYWNrQ29udGV4dFJlc29sdmUocmVxKTtcblx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oaWQpO1xufVxuZnVuY3Rpb24gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSkge1xuXHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKG1hcCwgcmVxKSkge1xuXHRcdHZhciBlID0gbmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIiArIHJlcSArIFwiJ1wiKTtcblx0XHRlLmNvZGUgPSAnTU9EVUxFX05PVF9GT1VORCc7XG5cdFx0dGhyb3cgZTtcblx0fVxuXHRyZXR1cm4gbWFwW3JlcV07XG59XG53ZWJwYWNrQ29udGV4dC5rZXlzID0gZnVuY3Rpb24gd2VicGFja0NvbnRleHRLZXlzKCkge1xuXHRyZXR1cm4gT2JqZWN0LmtleXMobWFwKTtcbn07XG53ZWJwYWNrQ29udGV4dC5yZXNvbHZlID0gd2VicGFja0NvbnRleHRSZXNvbHZlO1xubW9kdWxlLmV4cG9ydHMgPSB3ZWJwYWNrQ29udGV4dDtcbndlYnBhY2tDb250ZXh0LmlkID0gXCIuL2Fzc2V0cy9jb250cm9sbGVycyBzeW5jIHJlY3Vyc2l2ZSAuL25vZGVfbW9kdWxlcy9Ac3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlci5qcyEgXFxcXC4oanx0KXN4PyRcIjsiLCJleHBvcnQgZGVmYXVsdCB7XG59OyIsImZ1bmN0aW9uIF90eXBlb2Yob2JqKSB7IFwiQGJhYmVsL2hlbHBlcnMgLSB0eXBlb2ZcIjsgaWYgKHR5cGVvZiBTeW1ib2wgPT09IFwiZnVuY3Rpb25cIiAmJiB0eXBlb2YgU3ltYm9sLml0ZXJhdG9yID09PSBcInN5bWJvbFwiKSB7IF90eXBlb2YgPSBmdW5jdGlvbiBfdHlwZW9mKG9iaikgeyByZXR1cm4gdHlwZW9mIG9iajsgfTsgfSBlbHNlIHsgX3R5cGVvZiA9IGZ1bmN0aW9uIF90eXBlb2Yob2JqKSB7IHJldHVybiBvYmogJiYgdHlwZW9mIFN5bWJvbCA9PT0gXCJmdW5jdGlvblwiICYmIG9iai5jb25zdHJ1Y3RvciA9PT0gU3ltYm9sICYmIG9iaiAhPT0gU3ltYm9sLnByb3RvdHlwZSA/IFwic3ltYm9sXCIgOiB0eXBlb2Ygb2JqOyB9OyB9IHJldHVybiBfdHlwZW9mKG9iaik7IH1cblxuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLm9iamVjdC5zZXQtcHJvdG90eXBlLW9mLmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LmdldC1wcm90b3R5cGUtb2YuanNcIjtcbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5yZWZsZWN0LmNvbnN0cnVjdC5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLm9iamVjdC5jcmVhdGUuanNcIjtcbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5vYmplY3QuZGVmaW5lLXByb3BlcnR5LmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvZXMuc3ltYm9sLmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvZXMuc3ltYm9sLmRlc2NyaXB0aW9uLmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LnRvLXN0cmluZy5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLnN5bWJvbC5pdGVyYXRvci5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLnN0cmluZy5pdGVyYXRvci5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLmFycmF5Lml0ZXJhdG9yLmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvd2ViLmRvbS1jb2xsZWN0aW9ucy5pdGVyYXRvci5qc1wiO1xuXG5mdW5jdGlvbiBfY2xhc3NDYWxsQ2hlY2soaW5zdGFuY2UsIENvbnN0cnVjdG9yKSB7IGlmICghKGluc3RhbmNlIGluc3RhbmNlb2YgQ29uc3RydWN0b3IpKSB7IHRocm93IG5ldyBUeXBlRXJyb3IoXCJDYW5ub3QgY2FsbCBhIGNsYXNzIGFzIGEgZnVuY3Rpb25cIik7IH0gfVxuXG5mdW5jdGlvbiBfZGVmaW5lUHJvcGVydGllcyh0YXJnZXQsIHByb3BzKSB7IGZvciAodmFyIGkgPSAwOyBpIDwgcHJvcHMubGVuZ3RoOyBpKyspIHsgdmFyIGRlc2NyaXB0b3IgPSBwcm9wc1tpXTsgZGVzY3JpcHRvci5lbnVtZXJhYmxlID0gZGVzY3JpcHRvci5lbnVtZXJhYmxlIHx8IGZhbHNlOyBkZXNjcmlwdG9yLmNvbmZpZ3VyYWJsZSA9IHRydWU7IGlmIChcInZhbHVlXCIgaW4gZGVzY3JpcHRvcikgZGVzY3JpcHRvci53cml0YWJsZSA9IHRydWU7IE9iamVjdC5kZWZpbmVQcm9wZXJ0eSh0YXJnZXQsIGRlc2NyaXB0b3Iua2V5LCBkZXNjcmlwdG9yKTsgfSB9XG5cbmZ1bmN0aW9uIF9jcmVhdGVDbGFzcyhDb25zdHJ1Y3RvciwgcHJvdG9Qcm9wcywgc3RhdGljUHJvcHMpIHsgaWYgKHByb3RvUHJvcHMpIF9kZWZpbmVQcm9wZXJ0aWVzKENvbnN0cnVjdG9yLnByb3RvdHlwZSwgcHJvdG9Qcm9wcyk7IGlmIChzdGF0aWNQcm9wcykgX2RlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IsIHN0YXRpY1Byb3BzKTsgcmV0dXJuIENvbnN0cnVjdG9yOyB9XG5cbmZ1bmN0aW9uIF9pbmhlcml0cyhzdWJDbGFzcywgc3VwZXJDbGFzcykgeyBpZiAodHlwZW9mIHN1cGVyQ2xhc3MgIT09IFwiZnVuY3Rpb25cIiAmJiBzdXBlckNsYXNzICE9PSBudWxsKSB7IHRocm93IG5ldyBUeXBlRXJyb3IoXCJTdXBlciBleHByZXNzaW9uIG11c3QgZWl0aGVyIGJlIG51bGwgb3IgYSBmdW5jdGlvblwiKTsgfSBzdWJDbGFzcy5wcm90b3R5cGUgPSBPYmplY3QuY3JlYXRlKHN1cGVyQ2xhc3MgJiYgc3VwZXJDbGFzcy5wcm90b3R5cGUsIHsgY29uc3RydWN0b3I6IHsgdmFsdWU6IHN1YkNsYXNzLCB3cml0YWJsZTogdHJ1ZSwgY29uZmlndXJhYmxlOiB0cnVlIH0gfSk7IGlmIChzdXBlckNsYXNzKSBfc2V0UHJvdG90eXBlT2Yoc3ViQ2xhc3MsIHN1cGVyQ2xhc3MpOyB9XG5cbmZ1bmN0aW9uIF9zZXRQcm90b3R5cGVPZihvLCBwKSB7IF9zZXRQcm90b3R5cGVPZiA9IE9iamVjdC5zZXRQcm90b3R5cGVPZiB8fCBmdW5jdGlvbiBfc2V0UHJvdG90eXBlT2YobywgcCkgeyBvLl9fcHJvdG9fXyA9IHA7IHJldHVybiBvOyB9OyByZXR1cm4gX3NldFByb3RvdHlwZU9mKG8sIHApOyB9XG5cbmZ1bmN0aW9uIF9jcmVhdGVTdXBlcihEZXJpdmVkKSB7IHZhciBoYXNOYXRpdmVSZWZsZWN0Q29uc3RydWN0ID0gX2lzTmF0aXZlUmVmbGVjdENvbnN0cnVjdCgpOyByZXR1cm4gZnVuY3Rpb24gX2NyZWF0ZVN1cGVySW50ZXJuYWwoKSB7IHZhciBTdXBlciA9IF9nZXRQcm90b3R5cGVPZihEZXJpdmVkKSwgcmVzdWx0OyBpZiAoaGFzTmF0aXZlUmVmbGVjdENvbnN0cnVjdCkgeyB2YXIgTmV3VGFyZ2V0ID0gX2dldFByb3RvdHlwZU9mKHRoaXMpLmNvbnN0cnVjdG9yOyByZXN1bHQgPSBSZWZsZWN0LmNvbnN0cnVjdChTdXBlciwgYXJndW1lbnRzLCBOZXdUYXJnZXQpOyB9IGVsc2UgeyByZXN1bHQgPSBTdXBlci5hcHBseSh0aGlzLCBhcmd1bWVudHMpOyB9IHJldHVybiBfcG9zc2libGVDb25zdHJ1Y3RvclJldHVybih0aGlzLCByZXN1bHQpOyB9OyB9XG5cbmZ1bmN0aW9uIF9wb3NzaWJsZUNvbnN0cnVjdG9yUmV0dXJuKHNlbGYsIGNhbGwpIHsgaWYgKGNhbGwgJiYgKF90eXBlb2YoY2FsbCkgPT09IFwib2JqZWN0XCIgfHwgdHlwZW9mIGNhbGwgPT09IFwiZnVuY3Rpb25cIikpIHsgcmV0dXJuIGNhbGw7IH0gcmV0dXJuIF9hc3NlcnRUaGlzSW5pdGlhbGl6ZWQoc2VsZik7IH1cblxuZnVuY3Rpb24gX2Fzc2VydFRoaXNJbml0aWFsaXplZChzZWxmKSB7IGlmIChzZWxmID09PSB2b2lkIDApIHsgdGhyb3cgbmV3IFJlZmVyZW5jZUVycm9yKFwidGhpcyBoYXNuJ3QgYmVlbiBpbml0aWFsaXNlZCAtIHN1cGVyKCkgaGFzbid0IGJlZW4gY2FsbGVkXCIpOyB9IHJldHVybiBzZWxmOyB9XG5cbmZ1bmN0aW9uIF9pc05hdGl2ZVJlZmxlY3RDb25zdHJ1Y3QoKSB7IGlmICh0eXBlb2YgUmVmbGVjdCA9PT0gXCJ1bmRlZmluZWRcIiB8fCAhUmVmbGVjdC5jb25zdHJ1Y3QpIHJldHVybiBmYWxzZTsgaWYgKFJlZmxlY3QuY29uc3RydWN0LnNoYW0pIHJldHVybiBmYWxzZTsgaWYgKHR5cGVvZiBQcm94eSA9PT0gXCJmdW5jdGlvblwiKSByZXR1cm4gdHJ1ZTsgdHJ5IHsgQm9vbGVhbi5wcm90b3R5cGUudmFsdWVPZi5jYWxsKFJlZmxlY3QuY29uc3RydWN0KEJvb2xlYW4sIFtdLCBmdW5jdGlvbiAoKSB7fSkpOyByZXR1cm4gdHJ1ZTsgfSBjYXRjaCAoZSkgeyByZXR1cm4gZmFsc2U7IH0gfVxuXG5mdW5jdGlvbiBfZ2V0UHJvdG90eXBlT2YobykgeyBfZ2V0UHJvdG90eXBlT2YgPSBPYmplY3Quc2V0UHJvdG90eXBlT2YgPyBPYmplY3QuZ2V0UHJvdG90eXBlT2YgOiBmdW5jdGlvbiBfZ2V0UHJvdG90eXBlT2YobykgeyByZXR1cm4gby5fX3Byb3RvX18gfHwgT2JqZWN0LmdldFByb3RvdHlwZU9mKG8pOyB9OyByZXR1cm4gX2dldFByb3RvdHlwZU9mKG8pOyB9XG5cbmltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tICdzdGltdWx1cyc7XG4vKlxuICogVGhpcyBpcyBhbiBleGFtcGxlIFN0aW11bHVzIGNvbnRyb2xsZXIhXG4gKlxuICogQW55IGVsZW1lbnQgd2l0aCBhIGRhdGEtY29udHJvbGxlcj1cImhlbGxvXCIgYXR0cmlidXRlIHdpbGwgY2F1c2VcbiAqIHRoaXMgY29udHJvbGxlciB0byBiZSBleGVjdXRlZC4gVGhlIG5hbWUgXCJoZWxsb1wiIGNvbWVzIGZyb20gdGhlIGZpbGVuYW1lOlxuICogaGVsbG9fY29udHJvbGxlci5qcyAtPiBcImhlbGxvXCJcbiAqXG4gKiBEZWxldGUgdGhpcyBmaWxlIG9yIGFkYXB0IGl0IGZvciB5b3VyIHVzZSFcbiAqL1xuXG52YXIgX2RlZmF1bHQgPSAvKiNfX1BVUkVfXyovZnVuY3Rpb24gKF9Db250cm9sbGVyKSB7XG4gIF9pbmhlcml0cyhfZGVmYXVsdCwgX0NvbnRyb2xsZXIpO1xuXG4gIHZhciBfc3VwZXIgPSBfY3JlYXRlU3VwZXIoX2RlZmF1bHQpO1xuXG4gIGZ1bmN0aW9uIF9kZWZhdWx0KCkge1xuICAgIF9jbGFzc0NhbGxDaGVjayh0aGlzLCBfZGVmYXVsdCk7XG5cbiAgICByZXR1cm4gX3N1cGVyLmFwcGx5KHRoaXMsIGFyZ3VtZW50cyk7XG4gIH1cblxuICBfY3JlYXRlQ2xhc3MoX2RlZmF1bHQsIFt7XG4gICAga2V5OiBcImNvbm5lY3RcIixcbiAgICB2YWx1ZTogZnVuY3Rpb24gY29ubmVjdCgpIHtcbiAgICAgIHRoaXMuZWxlbWVudC50ZXh0Q29udGVudCA9ICdIZWxsbyBTdGltdWx1cyEgRWRpdCBtZSBpbiBhc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qcyc7XG4gICAgfVxuICB9XSk7XG5cbiAgcmV0dXJuIF9kZWZhdWx0O1xufShDb250cm9sbGVyKTtcblxuZXhwb3J0IHsgX2RlZmF1bHQgYXMgZGVmYXVsdCB9OyIsIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuXG4vLyBzdGFydCB0aGUgU3RpbXVsdXMgYXBwbGljYXRpb25cbmltcG9ydCAnLi9ib290c3RyYXAnO1xuXG5pbXBvcnQganF1ZXJ5IGZyb20gJ2pxdWVyeSc7XG5cbmltcG9ydCAnLi9qcXVlcnkubW9kYWwubWluJztcblxuXG5pbXBvcnQgRWFzeU1ERSBmcm9tICdlYXN5bWRlJztcblxuaW1wb3J0IG1hcmtlZCBmcm9tICdtYXJrZWQnO1xuXG52YXIgbWFya2Rvd25fZWRpdG9yID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJtYXJrZG93bi1lZGl0b3JcIik7XG5pZihtYXJrZG93bl9lZGl0b3Ipe1xuICAgIHZhciBtayA9IG5ldyBFYXN5TURFKHtcbiAgICAgICAgZWxlbWVudDogbWFya2Rvd25fZWRpdG9yLFxuICAgICAgICBwcm9tcHRVUkxzOiB0cnVlLFxuICAgICAgICB0YWJTaXplOiA0LFxuICAgICAgICBzcGVsbENoZWNrZXI6IHRydWUsXG4gICAgICAgIG5hdGl2ZVNwZWxsY2hlY2s6IHRydWUsXG4gICAgICAgIHNpZGVCeVNpZGVGdWxsc2NyZWVuOiBmYWxzZSxcbiAgICAgICAgbWF4SGVpZ2h0OiAnMjAwcHgnLFxuICAgICAgICB0b29sYmFyOiBbXG4gICAgICAgICAgICBcImJvbGRcIiwgXCJpdGFsaWNcIiwgXCJzdHJpa2V0aHJvdWdoXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJjb2RlXCIsIFwicXVvdGVcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcIm9yZGVyZWQtbGlzdFwiLCBcInVub3JkZXJlZC1saXN0XCIsIFwifFwiLFxuICAgICAgICAgICAgXCJsaW5rXCIsIFwiaW1hZ2VcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImhvcml6b250YWwtcnVsZVwiLCBcImNsZWFuLWJsb2NrXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJzaWRlLWJ5LXNpZGVcIlxuICAgICAgICBdXG4gICAgfSk7XG4gICAgbWsudG9nZ2xlU2lkZUJ5U2lkZSgpO1xufVxuY29uc3QgbW9kYWxfZGF0YSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibW9kYWwtZGF0YVwiKTtcbmNvbnN0IG1vZGFsX3ZpZXcgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm1vZGFsLXZpZXdcIik7XG5pZihtb2RhbF92aWV3KSB7XG4gICAgbW9kYWxfdmlldy5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgdmFyIGlubmVyRGl2ID0gJCgnPHByZSBjbGFzcz1cIm0tMCBwcmUtd3JhcFwiPjwvcHJlPicpLmh0bWwobWFya2VkKG1vZGFsX2RhdGEuaW5uZXJIVE1MKSk7XG4gICAgICAgIHZhciBtb2RhbCA9ICQoJy5tb2RhbCcpO1xuICAgICAgICBtb2RhbC5hZGRDbGFzcygnbW9kYWwtc20nKTtcbiAgICAgICAgJCgnI3NpbXBsZS1hZGMtbW9kYWwtaGVhZGVyJykuaHRtbCgnTWVkaWEgSW5mbycpO1xuICAgICAgICAkKCcjc2ltcGxlLWFkYy1tb2RhbCAubW9kYWwtYm9keScpLmh0bWwoaW5uZXJEaXZbMF0ub3V0ZXJIVE1MKTtcbiAgICAgICAgJChcIiNzaW1wbGUtYWRjLW1vZGFsXCIpLm1vZGFsKCdzaG93Jyk7XG4gICAgfSk7XG59XG5cbmlmKHdpbmRvdy5sb2NhdGlvbi5wYXRobmFtZSA9PT0gXCIvdXBsb2FkXCIgKSB7XG4gICAgbGV0IGZvcm1kYXRhID0gbmV3IEZvcm1EYXRhKCk7XG4gICAgZm9ybWRhdGEuYXBwZW5kKFwicHJldmlld1wiLCB0cnVlKTtcbiAgICAkKCcjdXBsb2FkX2Zvcm1fdG9ycmVudF9maWxlJykuY2hhbmdlKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKGZvcm1kYXRhLmhhcyhcInVwbG9hZF9mb3JtW3RvcnJlbnRfZmlsZV1cIikpIHtcbiAgICAgICAgICAgIGZvcm1kYXRhLmRlbGV0ZShcInVwbG9hZF9mb3JtW3RvcnJlbnRfZmlsZV1cIik7XG4gICAgICAgIH1cbiAgICAgICAgaWYgKCQodGhpcykucHJvcCgnZmlsZXMnKS5sZW5ndGggPiAwKSB7XG4gICAgICAgICAgICB2YXIgZmlsZSA9ICQodGhpcykucHJvcCgnZmlsZXMnKVswXTtcbiAgICAgICAgICAgIGZvcm1kYXRhLmFwcGVuZChcInVwbG9hZF9mb3JtW3RvcnJlbnRfZmlsZV1cIiwgZmlsZSk7XG4gICAgICAgIH1cbiAgICB9KTtcbiAgICB2YXIgY29udGVudEluZm8gPSBuZXcgRWFzeU1ERSh7XG4gICAgICAgIGVsZW1lbnQ6IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkX2Zvcm1fY29udGVudF9pbmZvXCIpLFxuICAgICAgICBwcm9tcHRVUkxzOiB0cnVlLFxuICAgICAgICB0YWJTaXplOiA0LFxuICAgICAgICBzcGVsbENoZWNrZXI6IHRydWUsXG4gICAgICAgIG5hdGl2ZVNwZWxsY2hlY2s6IHRydWUsXG4gICAgICAgIHNpZGVCeVNpZGVGdWxsc2NyZWVuOiBmYWxzZSxcbiAgICAgICAgbWF4SGVpZ2h0OiAnMjAwcHgnLFxuICAgICAgICB0b29sYmFyOiBbXG4gICAgICAgICAgICBcImJvbGRcIiwgXCJpdGFsaWNcIiwgXCJzdHJpa2V0aHJvdWdoXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJjb2RlXCIsIFwicXVvdGVcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcIm9yZGVyZWQtbGlzdFwiLCBcInVub3JkZXJlZC1saXN0XCIsIFwifFwiLFxuICAgICAgICAgICAgXCJsaW5rXCIsIFwiaW1hZ2VcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImhvcml6b250YWwtcnVsZVwiLCBcImNsZWFuLWJsb2NrXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJzaWRlLWJ5LXNpZGVcIlxuICAgICAgICBdXG4gICAgfSk7XG4gICAgY29udGVudEluZm8udG9nZ2xlU2lkZUJ5U2lkZSgpO1xuICAgIHZhciByc190ZXh0YXJlYSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkX2Zvcm1fcmVsZWFzZV9kZXRhaWxzXCIpO1xuICAgIHZhciByZWxlYXNlRGV0YWlscyA9IG5ldyBFYXN5TURFKHtcbiAgICAgICAgZWxlbWVudDogcnNfdGV4dGFyZWEsXG4gICAgICAgIHByb21wdFVSTHM6IHRydWUsXG4gICAgICAgIHRhYlNpemU6IDQsXG4gICAgICAgIHNwZWxsQ2hlY2tlcjogdHJ1ZSxcbiAgICAgICAgbmF0aXZlU3BlbGxjaGVjazogdHJ1ZSxcbiAgICAgICAgc2lkZUJ5U2lkZUZ1bGxzY3JlZW46IGZhbHNlLFxuICAgICAgICBpbnB1dFN0eWxlOiBcInRleHRhcmVhXCIsXG4gICAgICAgIG1heEhlaWdodDogJzMwMHB4JyxcbiAgICAgICAgdG9vbGJhcjogW1xuICAgICAgICAgICAgXCJib2xkXCIsIFwiaXRhbGljXCIsIFwic3RyaWtldGhyb3VnaFwiLCBcInxcIixcbiAgICAgICAgICAgIFwiY29kZVwiLCBcInF1b3RlXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJvcmRlcmVkLWxpc3RcIiwgXCJ1bm9yZGVyZWQtbGlzdFwiLCBcInxcIixcbiAgICAgICAgICAgIFwibGlua1wiLCBcImltYWdlXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJob3Jpem9udGFsLXJ1bGVcIiwgXCJjbGVhbi1ibG9ja1wiLCBcInxcIixcbiAgICAgICAgICAgIFwic2lkZS1ieS1zaWRlXCJcbiAgICAgICAgXVxuICAgIH0pO1xuICAgIHJlbGVhc2VEZXRhaWxzLnRvZ2dsZVNpZGVCeVNpZGUoKTtcblxuICAgIHZhciBtaV90ZXh0YXJlYSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkX2Zvcm1fbWVkaWFpbmZvXCIpO1xuICAgIHZhciBtZWRpYWluZm8gPSBuZXcgRWFzeU1ERSh7XG4gICAgICAgIGVsZW1lbnQ6IG1pX3RleHRhcmVhLFxuICAgICAgICBwcm9tcHRVUkxzOiB0cnVlLFxuICAgICAgICB0YWJTaXplOiA0LFxuICAgICAgICBzcGVsbENoZWNrZXI6IHRydWUsXG4gICAgICAgIG5hdGl2ZVNwZWxsY2hlY2s6IHRydWUsXG4gICAgICAgIHNpZGVCeVNpZGVGdWxsc2NyZWVuOiBmYWxzZSxcbiAgICAgICAgaW5wdXRTdHlsZTogXCJ0ZXh0YXJlYVwiLFxuICAgICAgICBtYXhIZWlnaHQ6ICczMDBweCcsXG4gICAgICAgIHRvb2xiYXI6IFtcbiAgICAgICAgICAgIFwiYm9sZFwiLCBcIml0YWxpY1wiLCBcInN0cmlrZXRocm91Z2hcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImNvZGVcIiwgXCJxdW90ZVwiLCBcInxcIixcbiAgICAgICAgICAgIFwib3JkZXJlZC1saXN0XCIsIFwidW5vcmRlcmVkLWxpc3RcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImxpbmtcIiwgXCJpbWFnZVwiLCBcInxcIixcbiAgICAgICAgICAgIFwiaG9yaXpvbnRhbC1ydWxlXCIsIFwiY2xlYW4tYmxvY2tcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcInNpZGUtYnktc2lkZVwiXG4gICAgICAgIF1cbiAgICB9KTtcbiAgICBtZWRpYWluZm8udG9nZ2xlU2lkZUJ5U2lkZSgpO1xuXG4gICAgdmFyIHRlbXBsYXRlID0gbnVsbDtcbiAgICAkLmFqYXgoXG4gICAgICAgIHtcbiAgICAgICAgICAgIHVybDogXCIvYXBpL3RlbXBsYXRlXCIsXG4gICAgICAgICAgICB0eXBlOiAnZ2V0JyxcbiAgICAgICAgICAgIGRhdGFUeXBlOiAnaHRtbCcsXG4gICAgICAgICAgICBhc3luYzogZmFsc2UsXG4gICAgICAgICAgICBjYWNoZTogZmFsc2UsXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgIHRlbXBsYXRlID0gSlNPTi5wYXJzZShkYXRhKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgdmFyIHJhZGlvYnRuID0gZG9jdW1lbnQudXBsb2FkX2Zvcm0udGVtcGxhdGVfcmFkaW87XG5cbiAgICByZWxlYXNlRGV0YWlscy52YWx1ZSh0ZW1wbGF0ZVsnZHZkX3RlbXBsYXRlJ10pXG4gICAgcmFkaW9idG5bMF0uYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgZnVuY3Rpb24gKCl7XG4gICAgICAgIHJlbGVhc2VEZXRhaWxzLnZhbHVlKHRlbXBsYXRlWydkdmRfdGVtcGxhdGUnXSk7XG4gICAgfSlcbiAgICByYWRpb2J0blsxXS5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCBmdW5jdGlvbiAoKXtcbiAgICAgICAgcmVsZWFzZURldGFpbHMudmFsdWUodGVtcGxhdGVbJ2JkbXZfdGVtcGxhdGUnXSk7XG4gICAgfSlcbiAgICByYWRpb2J0blsyXS5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCBmdW5jdGlvbiAoKXtcbiAgICAgICAgcmVsZWFzZURldGFpbHMudmFsdWUodGVtcGxhdGVbJ3VoZF90ZW1wbGF0ZSddKTtcbiAgICB9KVxuXG4gICAgdmFyIGdldF9jb250ZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJjb250ZW50LXVybC1idXR0b25cIik7XG5cbiAgICBnZXRfY29udGVudC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpe1xuICAgICAgICB2YXIgc2NyYXBwZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZC1zY3JhcHBlclwiKTtcbiAgICAgICAgdmFyIHNjcmFwcGVyX3VybCA9IFwiL2FwaS9zY3JhcHBlci9cIiArIHNjcmFwcGVyLm9wdGlvbnNbc2NyYXBwZXIuc2VsZWN0ZWRJbmRleF0udmFsdWUgKyBcIj91cmw9XCI7XG5cbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHVybDogZW5jb2RlVVJJKHNjcmFwcGVyX3VybCArIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkX2Zvcm1fY29udGVudF91cmxcIikudmFsdWUpLFxuICAgICAgICAgICAgdHlwZTogJ2dldCcsXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2h0bWwnLFxuICAgICAgICAgICAgYXN5bmM6IGZhbHNlLFxuICAgICAgICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGRhdGEpe1xuICAgICAgICAgICAgICAgIHZhciBjb250ZW50ID0gSlNPTi5wYXJzZShkYXRhKVsnY29udGVudF9pbmZvJ107XG4gICAgICAgICAgICAgICAgY29udGVudEluZm8udmFsdWUoY29udGVudC5zdWJzdHJpbmcoMSkpO1xuICAgICAgICAgICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiaW1hZ2UtZnJvbS1zY3JhcHBlclwiKS5zcmMgPSBKU09OLnBhcnNlKGRhdGEpWydpbWFnZSddO1xuICAgICAgICAgICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkX2Zvcm1fY29udGVudF9wb3N0ZXJcIikudmFsdWUgPSBKU09OLnBhcnNlKGRhdGEpWydpbWFnZSddO1xuICAgICAgICAgICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiaW1hZ2UtZnJvbS1zY3JhcHBlci1jb250ZW50XCIpLmNsYXNzTGlzdC5yZW1vdmUoXCJkLW5vbmVcIik7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgfSk7XG4gICAgY29uc3QgdXBsb2FkQ29udGVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkLWNvbnRlbnRcIik7XG4gICAgY29uc3QgcHJldmlld0NvbnRlbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInByZXZpZXctY29udGVudFwiKTtcbiAgICBjb25zdCBwcmV2aWV3ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmV2aWV3X2J0blwiKTtcblxuICAgIHByZXZpZXcuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKXtcbiAgICAgICAgdXBsb2FkQ29udGVudC5jbGFzc0xpc3QuYWRkKFwiZC1ub25lXCIpO1xuICAgICAgICBwcmV2aWV3Q29udGVudC5jbGFzc0xpc3QucmVtb3ZlKFwiZC1ub25lXCIpO1xuXG4gICAgICAgIHZhciB1cGxvYWRUb3JyZW50TmFtZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCJpbnB1dFtuYW1lPSd1cGxvYWRfZm9ybVt0b3JyZW50X25hbWVdJ11cIik7XG4gICAgICAgIHZhciBwcmV2aWV3VG9ycmVudFNpemUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInByZXZpZXctdG9ycmVudC1zaXplXCIpO1xuICAgICAgICB2YXIgcHJldmlld1RvcnJlbnROYW1lID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmV2aWV3LXRvcnJlbnQtbmFtZVwiKTtcbiAgICAgICAgdmFyIHByZXZpZXdUb3JyZW50SW5mb2hhc2ggPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInByZXZpZXctaW5mby1oYXNoXCIpO1xuICAgICAgICB2YXIgcHJldmlld1RvcnJlbnRGaWxlcyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicHJldmlldy10b3JyZW50LWZpbGVzXCIpO1xuICAgICAgICB2YXIgcHJldmlld0NvbnRlbnRJbmZvID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJjb250ZW50LXBhcnNlZC1tZXNzYWdlXCIpO1xuICAgICAgICB2YXIgcHJldmlld1JlbGVhc2VJbmZvID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJyZWxlYXNlLWRldGFpbHNcIik7XG4gICAgICAgIHZhciBwcmV2aWV3TWVkaWFpbmZvID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJhZGMtdG9ycmVudC1tZWRpYWluZm9cIik7XG4gICAgICAgIHZhciBwcmV2aWV3SW1hZ2UgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInByZXZpZXctaW1hZ2VcIik7XG5cbiAgICAgICAgdmFyIHByZXZpZXdTaG93TWVkaWFJbmZvQmxvY2sgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInNob3ctbWVkaWEtaW5mby1ibG9ja1wiKTtcbiAgICAgICAgdmFyIHByZXZpZXdOb01lZGlhSW5mb0Jsb2NrID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuby1tZWRpYS1pbmZvLWJsb2NrXCIpO1xuXG4gICAgICAgIHByZXZpZXdUb3JyZW50TmFtZS5pbm5lckhUTUwgPSB1cGxvYWRUb3JyZW50TmFtZS52YWx1ZTtcbiAgICAgICAgcHJldmlld1JlbGVhc2VJbmZvLmlubmVySFRNTCA9IG1hcmtlZChyZWxlYXNlRGV0YWlscy52YWx1ZSgpKTtcbiAgICAgICAgcHJldmlld0NvbnRlbnRJbmZvLmlubmVySFRNTCA9IG1hcmtlZChjb250ZW50SW5mby52YWx1ZSgpKTtcbiAgICAgICAgcHJldmlld0ltYWdlLnNyYyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiaW1hZ2UtZnJvbS1zY3JhcHBlclwiKS5zcmM7XG5cbiAgICAgICAgcHJldmlld01lZGlhaW5mby5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpe1xuICAgICAgICAgICAgdmFyIGlubmVyRGl2ID0gJCgnPHByZSBjbGFzcz1cIm0tMCBwcmUtd3JhcFwiPjwvcHJlPicpLmh0bWwobWFya2VkKG1lZGlhaW5mby52YWx1ZSgpKSk7XG4gICAgICAgICAgICB2YXIgbW9kYWwgPSAkKCcubW9kYWwnKTtcbiAgICAgICAgICAgIG1vZGFsLmFkZENsYXNzKCdtb2RhbC1zbScpO1xuXG4gICAgICAgICAgICAkKCcjc2ltcGxlLWFkYy1tb2RhbC1oZWFkZXInKS5odG1sKCdNZWRpYSBJbmZvJyk7XG4gICAgICAgICAgICAkKCcjc2ltcGxlLWFkYy1tb2RhbCAubW9kYWwtYm9keScpLmh0bWwoaW5uZXJEaXZbMF0ub3V0ZXJIVE1MKTtcbiAgICAgICAgICAgICQoXCIjc2ltcGxlLWFkYy1tb2RhbFwiKS5tb2RhbCgnc2hvdycpO1xuICAgICAgICB9KVxuXG4gICAgICAgIGZvcm1kYXRhLnNldChcInByZXZpZXdcIiwgdHJ1ZSk7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IFwiL3VwbG9hZFwiLFxuICAgICAgICAgICAgdHlwZTogXCJQT1NUXCIsXG4gICAgICAgICAgICBkYXRhOiBmb3JtZGF0YSxcbiAgICAgICAgICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICAgICAgICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChyZXN1bHQpIHtcbiAgICAgICAgICAgICAgICB0cnkge1xuICAgICAgICAgICAgICAgICAgICByZXN1bHQgPSBKU09OLnBhcnNlKHJlc3VsdCk7XG4gICAgICAgICAgICAgICAgfSBjYXRjaCB7fVxuICAgICAgICAgICAgICAgIHByZXZpZXdUb3JyZW50TmFtZS5pbm5lckhUTUwgPSByZXN1bHRbJ25hbWUnXTtcbiAgICAgICAgICAgICAgICBwcmV2aWV3VG9ycmVudFNpemUuaW5uZXJIVE1MID0gcmVzdWx0WydzaXplJ107XG4gICAgICAgICAgICAgICAgcHJldmlld1RvcnJlbnRJbmZvaGFzaC5pbm5lckhUTUwgPSByZXN1bHRbJ2ZpbGVzJ11bJ2luZm9faGFzaCddO1xuICAgICAgICAgICAgICAgIHByZXZpZXdUb3JyZW50RmlsZXMuaW5uZXJIVE1MID0gcmVzdWx0WydmaWxlcyddWyd0b3RhbCddO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9KTtcblxuICAgIHZhciB1cGxvYWRfcmV0dXJuID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJ1cGxvYWRfcmV0dXJuXCIpO1xuICAgIHVwbG9hZF9yZXR1cm4uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLGZ1bmN0aW9uICgpe1xuICAgICAgICB1cGxvYWRDb250ZW50LmNsYXNzTGlzdC5yZW1vdmUoXCJkLW5vbmVcIik7XG4gICAgICAgIHByZXZpZXdDb250ZW50LmNsYXNzTGlzdC5hZGQoXCJkLW5vbmVcIik7XG4gICAgfSk7XG59XG5cbiIsImltcG9ydCB7IHN0YXJ0U3RpbXVsdXNBcHAgfSBmcm9tICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UnO1xuXG4vLyBSZWdpc3RlcnMgU3RpbXVsdXMgY29udHJvbGxlcnMgZnJvbSBjb250cm9sbGVycy5qc29uIGFuZCBpbiB0aGUgY29udHJvbGxlcnMvIGRpcmVjdG9yeVxuZXhwb3J0IGNvbnN0IGFwcCA9IHN0YXJ0U3RpbXVsdXNBcHAocmVxdWlyZS5jb250ZXh0KFxuICAgICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlciEuL2NvbnRyb2xsZXJzJyxcbiAgICB0cnVlLFxuICAgIC9cXC4oanx0KXN4PyQvXG4pKTtcblxuXG4iLCIvKlxuICAgIEEgc2ltcGxlIGpRdWVyeSBtb2RhbCAoaHR0cDovL2dpdGh1Yi5jb20va3lsZWZveC9qcXVlcnktbW9kYWwpXG4gICAgVmVyc2lvbiAwLjkuMlxuKi9cbiEgZnVuY3Rpb24gKG8pIHtcbiAgICBcIm9iamVjdFwiID09IHR5cGVvZiBtb2R1bGUgJiYgXCJvYmplY3RcIiA9PSB0eXBlb2YgbW9kdWxlLmV4cG9ydHMgPyBvKHJlcXVpcmUoXCJqcXVlcnlcIiksIHdpbmRvdywgZG9jdW1lbnQpIDogbyhqUXVlcnksIHdpbmRvdywgZG9jdW1lbnQpXG59KGZ1bmN0aW9uIChvLCB0LCBpLCBlKSB7XG4gICAgdmFyIHMgPSBbXSxcbiAgICAgICAgbCA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHJldHVybiBzLmxlbmd0aCA/IHNbcy5sZW5ndGggLSAxXSA6IG51bGxcbiAgICAgICAgfSxcbiAgICAgICAgbiA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHZhciBvLCB0ID0gITE7XG4gICAgICAgICAgICBmb3IgKG8gPSBzLmxlbmd0aCAtIDE7IG8gPj0gMDsgby0tKSBzW29dLiRibG9ja2VyICYmIChzW29dLiRibG9ja2VyLnRvZ2dsZUNsYXNzKFwiY3VycmVudFwiLCAhdCkudG9nZ2xlQ2xhc3MoXCJiZWhpbmRcIiwgdCksIHQgPSAhMClcbiAgICAgICAgfTtcbiAgICBvLm1vZGFsID0gZnVuY3Rpb24gKHQsIGkpIHtcbiAgICAgICAgdmFyIGUsIG47XG4gICAgICAgIGlmICh0aGlzLiRib2R5ID0gbyhcImJvZHlcIiksIHRoaXMub3B0aW9ucyA9IG8uZXh0ZW5kKHt9LCBvLm1vZGFsLmRlZmF1bHRzLCBpKSwgdGhpcy5vcHRpb25zLmRvRmFkZSA9ICFpc05hTihwYXJzZUludCh0aGlzLm9wdGlvbnMuZmFkZUR1cmF0aW9uLCAxMCkpLCB0aGlzLiRibG9ja2VyID0gbnVsbCwgdGhpcy5vcHRpb25zLmNsb3NlRXhpc3RpbmcpXG4gICAgICAgICAgICBmb3IgKDsgby5tb2RhbC5pc0FjdGl2ZSgpOykgby5tb2RhbC5jbG9zZSgpO1xuICAgICAgICBpZiAocy5wdXNoKHRoaXMpLCB0LmlzKFwiYVwiKSlcbiAgICAgICAgICAgIGlmIChuID0gdC5hdHRyKFwiaHJlZlwiKSwgdGhpcy5hbmNob3IgPSB0LCAvXiMvLnRlc3QobikpIHtcbiAgICAgICAgICAgICAgICBpZiAodGhpcy4kZWxtID0gbyhuKSwgMSAhPT0gdGhpcy4kZWxtLmxlbmd0aCkgcmV0dXJuIG51bGw7XG4gICAgICAgICAgICAgICAgdGhpcy4kYm9keS5hcHBlbmQodGhpcy4kZWxtKSwgdGhpcy5vcGVuKClcbiAgICAgICAgICAgIH0gZWxzZSB0aGlzLiRlbG0gPSBvKFwiPGRpdj5cIiksIHRoaXMuJGJvZHkuYXBwZW5kKHRoaXMuJGVsbSksIGUgPSBmdW5jdGlvbiAobywgdCkge1xuICAgICAgICAgICAgICAgIHQuZWxtLnJlbW92ZSgpXG4gICAgICAgICAgICB9LCB0aGlzLnNob3dTcGlubmVyKCksIHQudHJpZ2dlcihvLm1vZGFsLkFKQVhfU0VORCksIG8uZ2V0KG4pLmRvbmUoZnVuY3Rpb24gKGkpIHtcbiAgICAgICAgICAgICAgICBpZiAoby5tb2RhbC5pc0FjdGl2ZSgpKSB7XG4gICAgICAgICAgICAgICAgICAgIHQudHJpZ2dlcihvLm1vZGFsLkFKQVhfU1VDQ0VTUyk7XG4gICAgICAgICAgICAgICAgICAgIHZhciBzID0gbCgpO1xuICAgICAgICAgICAgICAgICAgICBzLiRlbG0uZW1wdHkoKS5hcHBlbmQoaSkub24oby5tb2RhbC5DTE9TRSwgZSksIHMuaGlkZVNwaW5uZXIoKSwgcy5vcGVuKCksIHQudHJpZ2dlcihvLm1vZGFsLkFKQVhfQ09NUExFVEUpXG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSkuZmFpbChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgdC50cmlnZ2VyKG8ubW9kYWwuQUpBWF9GQUlMKTtcbiAgICAgICAgICAgICAgICB2YXIgaSA9IGwoKTtcbiAgICAgICAgICAgICAgICBpLmhpZGVTcGlubmVyKCksIHMucG9wKCksIHQudHJpZ2dlcihvLm1vZGFsLkFKQVhfQ09NUExFVEUpXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgZWxzZSB0aGlzLiRlbG0gPSB0LCB0aGlzLmFuY2hvciA9IHQsIHRoaXMuJGJvZHkuYXBwZW5kKHRoaXMuJGVsbSksIHRoaXMub3BlbigpXG4gICAgfSwgby5tb2RhbC5wcm90b3R5cGUgPSB7XG4gICAgICAgIGNvbnN0cnVjdG9yOiBvLm1vZGFsLFxuICAgICAgICBvcGVuOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgdCA9IHRoaXM7XG4gICAgICAgICAgICB0aGlzLmJsb2NrKCksIHRoaXMuYW5jaG9yLmJsdXIoKSwgdGhpcy5vcHRpb25zLmRvRmFkZSA/IHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIHQuc2hvdygpXG4gICAgICAgICAgICB9LCB0aGlzLm9wdGlvbnMuZmFkZUR1cmF0aW9uICogdGhpcy5vcHRpb25zLmZhZGVEZWxheSkgOiB0aGlzLnNob3coKSwgbyhpKS5vZmYoXCJrZXlkb3duLm1vZGFsXCIpLm9uKFwia2V5ZG93bi5tb2RhbFwiLCBmdW5jdGlvbiAobykge1xuICAgICAgICAgICAgICAgIHZhciB0ID0gbCgpO1xuICAgICAgICAgICAgICAgIDI3ID09PSBvLndoaWNoICYmIHQub3B0aW9ucy5lc2NhcGVDbG9zZSAmJiB0LmNsb3NlKClcbiAgICAgICAgICAgIH0pLCB0aGlzLm9wdGlvbnMuY2xpY2tDbG9zZSAmJiB0aGlzLiRibG9ja2VyLmNsaWNrKGZ1bmN0aW9uICh0KSB7XG4gICAgICAgICAgICAgICAgdC50YXJnZXQgPT09IHRoaXMgJiYgby5tb2RhbC5jbG9zZSgpXG4gICAgICAgICAgICB9KVxuICAgICAgICB9LFxuICAgICAgICBjbG9zZTogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgcy5wb3AoKSwgdGhpcy51bmJsb2NrKCksIHRoaXMuaGlkZSgpLCBvLm1vZGFsLmlzQWN0aXZlKCkgfHwgbyhpKS5vZmYoXCJrZXlkb3duLm1vZGFsXCIpXG4gICAgICAgIH0sXG4gICAgICAgIGJsb2NrOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB0aGlzLiRlbG0udHJpZ2dlcihvLm1vZGFsLkJFRk9SRV9CTE9DSywgW3RoaXMuX2N0eCgpXSksIHRoaXMuJGJvZHkuY3NzKFwib3ZlcmZsb3dcIiwgXCJoaWRkZW5cIiksIHRoaXMuJGJsb2NrZXIgPSBvKCc8ZGl2IGNsYXNzPVwiJyArIHRoaXMub3B0aW9ucy5ibG9ja2VyQ2xhc3MgKyAnIGJsb2NrZXIgY3VycmVudFwiPjwvZGl2PicpLmFwcGVuZFRvKHRoaXMuJGJvZHkpLCBuKCksIHRoaXMub3B0aW9ucy5kb0ZhZGUgJiYgdGhpcy4kYmxvY2tlci5jc3MoXCJvcGFjaXR5XCIsIDApLmFuaW1hdGUoe1xuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDFcbiAgICAgICAgICAgIH0sIHRoaXMub3B0aW9ucy5mYWRlRHVyYXRpb24pLCB0aGlzLiRlbG0udHJpZ2dlcihvLm1vZGFsLkJMT0NLLCBbdGhpcy5fY3R4KCldKVxuICAgICAgICB9LFxuICAgICAgICB1bmJsb2NrOiBmdW5jdGlvbiAodCkge1xuICAgICAgICAgICAgIXQgJiYgdGhpcy5vcHRpb25zLmRvRmFkZSA/IHRoaXMuJGJsb2NrZXIuZmFkZU91dCh0aGlzLm9wdGlvbnMuZmFkZUR1cmF0aW9uLCB0aGlzLnVuYmxvY2suYmluZCh0aGlzLCAhMCkpIDogKHRoaXMuJGJsb2NrZXIuY2hpbGRyZW4oKS5hcHBlbmRUbyh0aGlzLiRib2R5KSwgdGhpcy4kYmxvY2tlci5yZW1vdmUoKSwgdGhpcy4kYmxvY2tlciA9IG51bGwsIG4oKSwgby5tb2RhbC5pc0FjdGl2ZSgpIHx8IHRoaXMuJGJvZHkuY3NzKFwib3ZlcmZsb3dcIiwgXCJcIikpXG4gICAgICAgIH0sXG4gICAgICAgIHNob3c6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHRoaXMuJGVsbS50cmlnZ2VyKG8ubW9kYWwuQkVGT1JFX09QRU4sIFt0aGlzLl9jdHgoKV0pLCB0aGlzLm9wdGlvbnMuc2hvd0Nsb3NlICYmICh0aGlzLmNsb3NlQnV0dG9uID0gbygnPGEgaHJlZj1cIiNjbG9zZS1tb2RhbFwiIHJlbD1cIm1vZGFsOmNsb3NlXCIgY2xhc3M9XCJjbG9zZS1tb2RhbCAnICsgdGhpcy5vcHRpb25zLmNsb3NlQ2xhc3MgKyAnXCI+JyArIHRoaXMub3B0aW9ucy5jbG9zZVRleHQgKyBcIjwvYT5cIiksIHRoaXMuJGVsbS5hcHBlbmQodGhpcy5jbG9zZUJ1dHRvbikpLCB0aGlzLiRlbG0uYWRkQ2xhc3ModGhpcy5vcHRpb25zLm1vZGFsQ2xhc3MpLmFwcGVuZFRvKHRoaXMuJGJsb2NrZXIpLCB0aGlzLm9wdGlvbnMuZG9GYWRlID8gdGhpcy4kZWxtLmNzcyh7XG4gICAgICAgICAgICAgICAgb3BhY2l0eTogMCxcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBcImlubGluZS1ibG9ja1wiXG4gICAgICAgICAgICB9KS5hbmltYXRlKHtcbiAgICAgICAgICAgICAgICBvcGFjaXR5OiAxXG4gICAgICAgICAgICB9LCB0aGlzLm9wdGlvbnMuZmFkZUR1cmF0aW9uKSA6IHRoaXMuJGVsbS5jc3MoXCJkaXNwbGF5XCIsIFwiaW5saW5lLWJsb2NrXCIpLCB0aGlzLiRlbG0udHJpZ2dlcihvLm1vZGFsLk9QRU4sIFt0aGlzLl9jdHgoKV0pXG4gICAgICAgIH0sXG4gICAgICAgIGhpZGU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHRoaXMuJGVsbS50cmlnZ2VyKG8ubW9kYWwuQkVGT1JFX0NMT1NFLCBbdGhpcy5fY3R4KCldKSwgdGhpcy5jbG9zZUJ1dHRvbiAmJiB0aGlzLmNsb3NlQnV0dG9uLnJlbW92ZSgpO1xuICAgICAgICAgICAgdmFyIHQgPSB0aGlzO1xuICAgICAgICAgICAgdGhpcy5vcHRpb25zLmRvRmFkZSA/IHRoaXMuJGVsbS5mYWRlT3V0KHRoaXMub3B0aW9ucy5mYWRlRHVyYXRpb24sIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICB0LiRlbG0udHJpZ2dlcihvLm1vZGFsLkFGVEVSX0NMT1NFLCBbdC5fY3R4KCldKVxuICAgICAgICAgICAgfSkgOiB0aGlzLiRlbG0uaGlkZSgwLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgdC4kZWxtLnRyaWdnZXIoby5tb2RhbC5BRlRFUl9DTE9TRSwgW3QuX2N0eCgpXSlcbiAgICAgICAgICAgIH0pLCB0aGlzLiRlbG0udHJpZ2dlcihvLm1vZGFsLkNMT1NFLCBbdGhpcy5fY3R4KCldKVxuICAgICAgICB9LFxuICAgICAgICBzaG93U3Bpbm5lcjogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgdGhpcy5vcHRpb25zLnNob3dTcGlubmVyICYmICh0aGlzLnNwaW5uZXIgPSB0aGlzLnNwaW5uZXIgfHwgbygnPGRpdiBjbGFzcz1cIicgKyB0aGlzLm9wdGlvbnMubW9kYWxDbGFzcyArICctc3Bpbm5lclwiPjwvZGl2PicpLmFwcGVuZCh0aGlzLm9wdGlvbnMuc3Bpbm5lckh0bWwpLCB0aGlzLiRib2R5LmFwcGVuZCh0aGlzLnNwaW5uZXIpLCB0aGlzLnNwaW5uZXIuc2hvdygpKVxuICAgICAgICB9LFxuICAgICAgICBoaWRlU3Bpbm5lcjogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgdGhpcy5zcGlubmVyICYmIHRoaXMuc3Bpbm5lci5yZW1vdmUoKVxuICAgICAgICB9LFxuICAgICAgICBfY3R4OiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICByZXR1cm4ge1xuICAgICAgICAgICAgICAgIGVsbTogdGhpcy4kZWxtLFxuICAgICAgICAgICAgICAgICRlbG06IHRoaXMuJGVsbSxcbiAgICAgICAgICAgICAgICAkYmxvY2tlcjogdGhpcy4kYmxvY2tlcixcbiAgICAgICAgICAgICAgICBvcHRpb25zOiB0aGlzLm9wdGlvbnMsXG4gICAgICAgICAgICAgICAgJGFuY2hvcjogdGhpcy5hbmNob3JcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH0sIG8ubW9kYWwuY2xvc2UgPSBmdW5jdGlvbiAodCkge1xuICAgICAgICBpZiAoby5tb2RhbC5pc0FjdGl2ZSgpKSB7XG4gICAgICAgICAgICB0ICYmIHQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIHZhciBpID0gbCgpO1xuICAgICAgICAgICAgcmV0dXJuIGkuY2xvc2UoKSwgaS4kZWxtXG4gICAgICAgIH1cbiAgICB9LCBvLm1vZGFsLmlzQWN0aXZlID0gZnVuY3Rpb24gKCkge1xuICAgICAgICByZXR1cm4gcy5sZW5ndGggPiAwXG4gICAgfSwgby5tb2RhbC5nZXRDdXJyZW50ID0gbCwgby5tb2RhbC5kZWZhdWx0cyA9IHtcbiAgICAgICAgY2xvc2VFeGlzdGluZzogITAsXG4gICAgICAgIGVzY2FwZUNsb3NlOiAhMCxcbiAgICAgICAgY2xpY2tDbG9zZTogITAsXG4gICAgICAgIGNsb3NlVGV4dDogXCJDbG9zZVwiLFxuICAgICAgICBjbG9zZUNsYXNzOiBcIlwiLFxuICAgICAgICBtb2RhbENsYXNzOiBcIm1vZGFsXCIsXG4gICAgICAgIGJsb2NrZXJDbGFzczogXCJqcXVlcnktbW9kYWxcIixcbiAgICAgICAgc3Bpbm5lckh0bWw6ICc8ZGl2IGNsYXNzPVwicmVjdDFcIj48L2Rpdj48ZGl2IGNsYXNzPVwicmVjdDJcIj48L2Rpdj48ZGl2IGNsYXNzPVwicmVjdDNcIj48L2Rpdj48ZGl2IGNsYXNzPVwicmVjdDRcIj48L2Rpdj4nLFxuICAgICAgICBzaG93U3Bpbm5lcjogITAsXG4gICAgICAgIHNob3dDbG9zZTogITAsXG4gICAgICAgIGZhZGVEdXJhdGlvbjogbnVsbCxcbiAgICAgICAgZmFkZURlbGF5OiAxXG4gICAgfSwgby5tb2RhbC5CRUZPUkVfQkxPQ0sgPSBcIm1vZGFsOmJlZm9yZS1ibG9ja1wiLCBvLm1vZGFsLkJMT0NLID0gXCJtb2RhbDpibG9ja1wiLCBvLm1vZGFsLkJFRk9SRV9PUEVOID0gXCJtb2RhbDpiZWZvcmUtb3BlblwiLCBvLm1vZGFsLk9QRU4gPSBcIm1vZGFsOm9wZW5cIiwgby5tb2RhbC5CRUZPUkVfQ0xPU0UgPSBcIm1vZGFsOmJlZm9yZS1jbG9zZVwiLCBvLm1vZGFsLkNMT1NFID0gXCJtb2RhbDpjbG9zZVwiLCBvLm1vZGFsLkFGVEVSX0NMT1NFID0gXCJtb2RhbDphZnRlci1jbG9zZVwiLCBvLm1vZGFsLkFKQVhfU0VORCA9IFwibW9kYWw6YWpheDpzZW5kXCIsIG8ubW9kYWwuQUpBWF9TVUNDRVNTID0gXCJtb2RhbDphamF4OnN1Y2Nlc3NcIiwgby5tb2RhbC5BSkFYX0ZBSUwgPSBcIm1vZGFsOmFqYXg6ZmFpbFwiLCBvLm1vZGFsLkFKQVhfQ09NUExFVEUgPSBcIm1vZGFsOmFqYXg6Y29tcGxldGVcIiwgby5mbi5tb2RhbCA9IGZ1bmN0aW9uICh0KSB7XG4gICAgICAgIHJldHVybiAxID09PSB0aGlzLmxlbmd0aCAmJiBuZXcgby5tb2RhbCh0aGlzLCB0KSwgdGhpc1xuICAgIH0sIG8oaSkub24oXCJjbGljay5tb2RhbFwiLCAnYVtyZWx+PVwibW9kYWw6Y2xvc2VcIl0nLCBvLm1vZGFsLmNsb3NlKSwgbyhpKS5vbihcImNsaWNrLm1vZGFsXCIsICdhW3JlbH49XCJtb2RhbDpvcGVuXCJdJywgZnVuY3Rpb24gKHQpIHtcbiAgICAgICAgdC5wcmV2ZW50RGVmYXVsdCgpLCBvKHRoaXMpLm1vZGFsKClcbiAgICB9KVxufSk7IiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307IiwiLyogKGlnbm9yZWQpICovIl0sInNvdXJjZVJvb3QiOiIifQ==