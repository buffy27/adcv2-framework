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

console.log(mk);
console.log("hello");
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

var modal_data_peers = document.getElementById("peers-list");
var modal_view_peers = document.getElementById("adc-peers-list-view");

if (modal_view_peers) {
  modal_view_peers.addEventListener('click', function () {
    var innerDiv = $('<pre class="m-0 pre-wrap"></pre>').html(modal_data_peers.innerHTML);
    var modal = $('.modal');
    modal.addClass('modal-sm');
    $('#simple-adc-modal-header').html('Peers');
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vfC9cXC4oanx0KXN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy5qc29uIiwid2VicGFjazovLy8uL2Fzc2V0cy9jb250cm9sbGVycy9oZWxsb19jb250cm9sbGVyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Jvb3RzdHJhcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanF1ZXJ5Lm1vZGFsLm1pbi5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3MiLCJ3ZWJwYWNrOi8vL2lnbm9yZWR8L3Zhci93d3cvaHRtbC9ub2RlX21vZHVsZXMvdHlwby1qc3xmcyJdLCJuYW1lcyI6WyJtYXJrZG93bl9lZGl0b3IiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwibWsiLCJFYXN5TURFIiwiZWxlbWVudCIsInByb21wdFVSTHMiLCJ0YWJTaXplIiwic3BlbGxDaGVja2VyIiwibmF0aXZlU3BlbGxjaGVjayIsInNpZGVCeVNpZGVGdWxsc2NyZWVuIiwibWF4SGVpZ2h0IiwidG9vbGJhciIsInRvZ2dsZVNpZGVCeVNpZGUiLCJjb25zb2xlIiwibG9nIiwibW9kYWxfZGF0YSIsIm1vZGFsX3ZpZXciLCJhZGRFdmVudExpc3RlbmVyIiwiaW5uZXJEaXYiLCIkIiwiaHRtbCIsIm1hcmtlZCIsImlubmVySFRNTCIsIm1vZGFsIiwiYWRkQ2xhc3MiLCJvdXRlckhUTUwiLCJtb2RhbF9kYXRhX3BlZXJzIiwibW9kYWxfdmlld19wZWVycyIsIndpbmRvdyIsImxvY2F0aW9uIiwicGF0aG5hbWUiLCJmb3JtZGF0YSIsIkZvcm1EYXRhIiwiYXBwZW5kIiwiY2hhbmdlIiwiaGFzIiwicHJvcCIsImxlbmd0aCIsImZpbGUiLCJjb250ZW50SW5mbyIsInJzX3RleHRhcmVhIiwicmVsZWFzZURldGFpbHMiLCJpbnB1dFN0eWxlIiwibWlfdGV4dGFyZWEiLCJtZWRpYWluZm8iLCJ0ZW1wbGF0ZSIsImFqYXgiLCJ1cmwiLCJ0eXBlIiwiZGF0YVR5cGUiLCJhc3luYyIsImNhY2hlIiwic3VjY2VzcyIsImRhdGEiLCJKU09OIiwicGFyc2UiLCJyYWRpb2J0biIsInVwbG9hZF9mb3JtIiwidGVtcGxhdGVfcmFkaW8iLCJ2YWx1ZSIsImdldF9jb250ZW50Iiwic2NyYXBwZXIiLCJzY3JhcHBlcl91cmwiLCJvcHRpb25zIiwic2VsZWN0ZWRJbmRleCIsImVuY29kZVVSSSIsImNvbnRlbnQiLCJzdWJzdHJpbmciLCJzcmMiLCJjbGFzc0xpc3QiLCJyZW1vdmUiLCJ1cGxvYWRDb250ZW50IiwicHJldmlld0NvbnRlbnQiLCJwcmV2aWV3IiwiYWRkIiwidXBsb2FkVG9ycmVudE5hbWUiLCJxdWVyeVNlbGVjdG9yIiwicHJldmlld1RvcnJlbnRTaXplIiwicHJldmlld1RvcnJlbnROYW1lIiwicHJldmlld1RvcnJlbnRJbmZvaGFzaCIsInByZXZpZXdUb3JyZW50RmlsZXMiLCJwcmV2aWV3Q29udGVudEluZm8iLCJwcmV2aWV3UmVsZWFzZUluZm8iLCJwcmV2aWV3TWVkaWFpbmZvIiwicHJldmlld0ltYWdlIiwicHJldmlld1Nob3dNZWRpYUluZm9CbG9jayIsInByZXZpZXdOb01lZGlhSW5mb0Jsb2NrIiwic2V0IiwicHJvY2Vzc0RhdGEiLCJjb250ZW50VHlwZSIsInJlc3VsdCIsInVwbG9hZF9yZXR1cm4iLCJhcHAiLCJzdGFydFN0aW11bHVzQXBwIiwicmVxdWlyZSIsIm8iLCJtb2R1bGUiLCJleHBvcnRzIiwialF1ZXJ5IiwidCIsImkiLCJlIiwicyIsImwiLCJuIiwiJGJsb2NrZXIiLCJ0b2dnbGVDbGFzcyIsIiRib2R5IiwiZXh0ZW5kIiwiZGVmYXVsdHMiLCJkb0ZhZGUiLCJpc05hTiIsInBhcnNlSW50IiwiZmFkZUR1cmF0aW9uIiwiY2xvc2VFeGlzdGluZyIsImlzQWN0aXZlIiwiY2xvc2UiLCJwdXNoIiwiaXMiLCJhdHRyIiwiYW5jaG9yIiwidGVzdCIsIiRlbG0iLCJvcGVuIiwiZWxtIiwic2hvd1NwaW5uZXIiLCJ0cmlnZ2VyIiwiQUpBWF9TRU5EIiwiZ2V0IiwiZG9uZSIsIkFKQVhfU1VDQ0VTUyIsImVtcHR5Iiwib24iLCJDTE9TRSIsImhpZGVTcGlubmVyIiwiQUpBWF9DT01QTEVURSIsImZhaWwiLCJBSkFYX0ZBSUwiLCJwb3AiLCJwcm90b3R5cGUiLCJjb25zdHJ1Y3RvciIsImJsb2NrIiwiYmx1ciIsInNldFRpbWVvdXQiLCJzaG93IiwiZmFkZURlbGF5Iiwib2ZmIiwid2hpY2giLCJlc2NhcGVDbG9zZSIsImNsaWNrQ2xvc2UiLCJjbGljayIsInRhcmdldCIsInVuYmxvY2siLCJoaWRlIiwiQkVGT1JFX0JMT0NLIiwiX2N0eCIsImNzcyIsImJsb2NrZXJDbGFzcyIsImFwcGVuZFRvIiwiYW5pbWF0ZSIsIm9wYWNpdHkiLCJCTE9DSyIsImZhZGVPdXQiLCJiaW5kIiwiY2hpbGRyZW4iLCJCRUZPUkVfT1BFTiIsInNob3dDbG9zZSIsImNsb3NlQnV0dG9uIiwiY2xvc2VDbGFzcyIsImNsb3NlVGV4dCIsIm1vZGFsQ2xhc3MiLCJkaXNwbGF5IiwiT1BFTiIsIkJFRk9SRV9DTE9TRSIsIkFGVEVSX0NMT1NFIiwic3Bpbm5lciIsInNwaW5uZXJIdG1sIiwiJGFuY2hvciIsInByZXZlbnREZWZhdWx0IiwiZ2V0Q3VycmVudCIsImZuIl0sIm1hcHBpbmdzIjoiOzs7Ozs7OztBQUFBO0FBQ0E7QUFDQTs7O0FBR0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLDBJOzs7Ozs7Ozs7Ozs7Ozs7QUN0QkEsaUVBQWU7QUFDZixDQUFDLEU7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUNERCx1QkFBdUIsMkJBQTJCLDJFQUEyRSxrQ0FBa0MsbUJBQW1CLEdBQUcsRUFBRSxPQUFPLGtDQUFrQyw4SEFBOEgsR0FBRyxFQUFFLHFCQUFxQjs7QUFF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bkd6UCxFQW1HOFEvRSxDQUFDLENBQUN4RSxLQUFGLENBQVF3RyxTQUFSLEdBQW9CLGlCQW5HbFMsRUFtR3FUaEMsQ0FBQyxDQUFDeEUsS0FBRixDQUFRMkcsWUFBUixHQUF1QixvQkFuRzVVLEVBbUdrV25DLENBQUMsQ0FBQ3hFLEtBQUYsQ0FBUWtILFNBQVIsR0FBb0IsaUJBbkd0WCxFQW1HeVkxQyxDQUFDLENBQUN4RSxLQUFGLENBQVFnSCxhQUFSLEdBQXdCLHFCQW5HamEsRUFtR3dieEMsQ0FBQyxDQUFDcUYsRUFBRixDQUFLN0osS0FBTCxHQUFhLFVBQVU0RSxDQUFWLEVBQWE7QUFDOWMsV0FBTyxNQUFNLEtBQUs5RCxNQUFYLElBQXFCLElBQUkwRCxDQUFDLENBQUN4RSxLQUFOLENBQVksSUFBWixFQUFrQjRFLENBQWxCLENBQXJCLEVBQTJDLElBQWxEO0FBQ0gsR0FyR0QsRUFxR0dKLENBQUMsQ0FBQ0ssQ0FBRCxDQUFELENBQUtnQyxFQUFMLENBQVEsYUFBUixFQUF1Qix1QkFBdkIsRUFBZ0RyQyxDQUFDLENBQUN4RSxLQUFGLENBQVE2RixLQUF4RCxDQXJHSCxFQXFHbUVyQixDQUFDLENBQUNLLENBQUQsQ0FBRCxDQUFLZ0MsRUFBTCxDQUFRLGFBQVIsRUFBdUIsc0JBQXZCLEVBQStDLFVBQVVqQyxDQUFWLEVBQWE7QUFDM0hBLEtBQUMsQ0FBQytFLGNBQUYsSUFBb0JuRixDQUFDLENBQUMsSUFBRCxDQUFELENBQVF4RSxLQUFSLEVBQXBCO0FBQ0gsR0FGa0UsQ0FyR25FO0FBd0dILENBbkhDLENBQUYsQzs7Ozs7Ozs7Ozs7O0FDSkE7Ozs7Ozs7Ozs7O0FDQUEsZSIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgbWFwID0ge1xuXHRcIi4vaGVsbG9fY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXRzL2NvbnRyb2xsZXJzL2hlbGxvX2NvbnRyb2xsZXIuanNcIlxufTtcblxuXG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dChyZXEpIHtcblx0dmFyIGlkID0gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSk7XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKGlkKTtcbn1cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpIHtcblx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhtYXAsIHJlcSkpIHtcblx0XHR2YXIgZSA9IG5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIgKyByZXEgKyBcIidcIik7XG5cdFx0ZS5jb2RlID0gJ01PRFVMRV9OT1RfRk9VTkQnO1xuXHRcdHRocm93IGU7XG5cdH1cblx0cmV0dXJuIG1hcFtyZXFdO1xufVxud2VicGFja0NvbnRleHQua2V5cyA9IGZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0S2V5cygpIHtcblx0cmV0dXJuIE9iamVjdC5rZXlzKG1hcCk7XG59O1xud2VicGFja0NvbnRleHQucmVzb2x2ZSA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZTtcbm1vZHVsZS5leHBvcnRzID0gd2VicGFja0NvbnRleHQ7XG53ZWJwYWNrQ29udGV4dC5pZCA9IFwiLi9hc3NldHMvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuKGp8dClzeD8kXCI7IiwiZXhwb3J0IGRlZmF1bHQge1xufTsiLCJmdW5jdGlvbiBfdHlwZW9mKG9iaikgeyBcIkBiYWJlbC9oZWxwZXJzIC0gdHlwZW9mXCI7IGlmICh0eXBlb2YgU3ltYm9sID09PSBcImZ1bmN0aW9uXCIgJiYgdHlwZW9mIFN5bWJvbC5pdGVyYXRvciA9PT0gXCJzeW1ib2xcIikgeyBfdHlwZW9mID0gZnVuY3Rpb24gX3R5cGVvZihvYmopIHsgcmV0dXJuIHR5cGVvZiBvYmo7IH07IH0gZWxzZSB7IF90eXBlb2YgPSBmdW5jdGlvbiBfdHlwZW9mKG9iaikgeyByZXR1cm4gb2JqICYmIHR5cGVvZiBTeW1ib2wgPT09IFwiZnVuY3Rpb25cIiAmJiBvYmouY29uc3RydWN0b3IgPT09IFN5bWJvbCAmJiBvYmogIT09IFN5bWJvbC5wcm90b3R5cGUgPyBcInN5bWJvbFwiIDogdHlwZW9mIG9iajsgfTsgfSByZXR1cm4gX3R5cGVvZihvYmopOyB9XG5cbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5vYmplY3Quc2V0LXByb3RvdHlwZS1vZi5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLm9iamVjdC5nZXQtcHJvdG90eXBlLW9mLmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvZXMucmVmbGVjdC5jb25zdHJ1Y3QuanNcIjtcbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5vYmplY3QuY3JlYXRlLmpzXCI7XG5pbXBvcnQgXCJjb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LmRlZmluZS1wcm9wZXJ0eS5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLnN5bWJvbC5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLnN5bWJvbC5kZXNjcmlwdGlvbi5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL2VzLm9iamVjdC50by1zdHJpbmcuanNcIjtcbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5zeW1ib2wuaXRlcmF0b3IuanNcIjtcbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5zdHJpbmcuaXRlcmF0b3IuanNcIjtcbmltcG9ydCBcImNvcmUtanMvbW9kdWxlcy9lcy5hcnJheS5pdGVyYXRvci5qc1wiO1xuaW1wb3J0IFwiY29yZS1qcy9tb2R1bGVzL3dlYi5kb20tY29sbGVjdGlvbnMuaXRlcmF0b3IuanNcIjtcblxuZnVuY3Rpb24gX2NsYXNzQ2FsbENoZWNrKGluc3RhbmNlLCBDb25zdHJ1Y3RvcikgeyBpZiAoIShpbnN0YW5jZSBpbnN0YW5jZW9mIENvbnN0cnVjdG9yKSkgeyB0aHJvdyBuZXcgVHlwZUVycm9yKFwiQ2Fubm90IGNhbGwgYSBjbGFzcyBhcyBhIGZ1bmN0aW9uXCIpOyB9IH1cblxuZnVuY3Rpb24gX2RlZmluZVByb3BlcnRpZXModGFyZ2V0LCBwcm9wcykgeyBmb3IgKHZhciBpID0gMDsgaSA8IHByb3BzLmxlbmd0aDsgaSsrKSB7IHZhciBkZXNjcmlwdG9yID0gcHJvcHNbaV07IGRlc2NyaXB0b3IuZW51bWVyYWJsZSA9IGRlc2NyaXB0b3IuZW51bWVyYWJsZSB8fCBmYWxzZTsgZGVzY3JpcHRvci5jb25maWd1cmFibGUgPSB0cnVlOyBpZiAoXCJ2YWx1ZVwiIGluIGRlc2NyaXB0b3IpIGRlc2NyaXB0b3Iud3JpdGFibGUgPSB0cnVlOyBPYmplY3QuZGVmaW5lUHJvcGVydHkodGFyZ2V0LCBkZXNjcmlwdG9yLmtleSwgZGVzY3JpcHRvcik7IH0gfVxuXG5mdW5jdGlvbiBfY3JlYXRlQ2xhc3MoQ29uc3RydWN0b3IsIHByb3RvUHJvcHMsIHN0YXRpY1Byb3BzKSB7IGlmIChwcm90b1Byb3BzKSBfZGVmaW5lUHJvcGVydGllcyhDb25zdHJ1Y3Rvci5wcm90b3R5cGUsIHByb3RvUHJvcHMpOyBpZiAoc3RhdGljUHJvcHMpIF9kZWZpbmVQcm9wZXJ0aWVzKENvbnN0cnVjdG9yLCBzdGF0aWNQcm9wcyk7IHJldHVybiBDb25zdHJ1Y3RvcjsgfVxuXG5mdW5jdGlvbiBfaW5oZXJpdHMoc3ViQ2xhc3MsIHN1cGVyQ2xhc3MpIHsgaWYgKHR5cGVvZiBzdXBlckNsYXNzICE9PSBcImZ1bmN0aW9uXCIgJiYgc3VwZXJDbGFzcyAhPT0gbnVsbCkgeyB0aHJvdyBuZXcgVHlwZUVycm9yKFwiU3VwZXIgZXhwcmVzc2lvbiBtdXN0IGVpdGhlciBiZSBudWxsIG9yIGEgZnVuY3Rpb25cIik7IH0gc3ViQ2xhc3MucHJvdG90eXBlID0gT2JqZWN0LmNyZWF0ZShzdXBlckNsYXNzICYmIHN1cGVyQ2xhc3MucHJvdG90eXBlLCB7IGNvbnN0cnVjdG9yOiB7IHZhbHVlOiBzdWJDbGFzcywgd3JpdGFibGU6IHRydWUsIGNvbmZpZ3VyYWJsZTogdHJ1ZSB9IH0pOyBpZiAoc3VwZXJDbGFzcykgX3NldFByb3RvdHlwZU9mKHN1YkNsYXNzLCBzdXBlckNsYXNzKTsgfVxuXG5mdW5jdGlvbiBfc2V0UHJvdG90eXBlT2YobywgcCkgeyBfc2V0UHJvdG90eXBlT2YgPSBPYmplY3Quc2V0UHJvdG90eXBlT2YgfHwgZnVuY3Rpb24gX3NldFByb3RvdHlwZU9mKG8sIHApIHsgby5fX3Byb3RvX18gPSBwOyByZXR1cm4gbzsgfTsgcmV0dXJuIF9zZXRQcm90b3R5cGVPZihvLCBwKTsgfVxuXG5mdW5jdGlvbiBfY3JlYXRlU3VwZXIoRGVyaXZlZCkgeyB2YXIgaGFzTmF0aXZlUmVmbGVjdENvbnN0cnVjdCA9IF9pc05hdGl2ZVJlZmxlY3RDb25zdHJ1Y3QoKTsgcmV0dXJuIGZ1bmN0aW9uIF9jcmVhdGVTdXBlckludGVybmFsKCkgeyB2YXIgU3VwZXIgPSBfZ2V0UHJvdG90eXBlT2YoRGVyaXZlZCksIHJlc3VsdDsgaWYgKGhhc05hdGl2ZVJlZmxlY3RDb25zdHJ1Y3QpIHsgdmFyIE5ld1RhcmdldCA9IF9nZXRQcm90b3R5cGVPZih0aGlzKS5jb25zdHJ1Y3RvcjsgcmVzdWx0ID0gUmVmbGVjdC5jb25zdHJ1Y3QoU3VwZXIsIGFyZ3VtZW50cywgTmV3VGFyZ2V0KTsgfSBlbHNlIHsgcmVzdWx0ID0gU3VwZXIuYXBwbHkodGhpcywgYXJndW1lbnRzKTsgfSByZXR1cm4gX3Bvc3NpYmxlQ29uc3RydWN0b3JSZXR1cm4odGhpcywgcmVzdWx0KTsgfTsgfVxuXG5mdW5jdGlvbiBfcG9zc2libGVDb25zdHJ1Y3RvclJldHVybihzZWxmLCBjYWxsKSB7IGlmIChjYWxsICYmIChfdHlwZW9mKGNhbGwpID09PSBcIm9iamVjdFwiIHx8IHR5cGVvZiBjYWxsID09PSBcImZ1bmN0aW9uXCIpKSB7IHJldHVybiBjYWxsOyB9IHJldHVybiBfYXNzZXJ0VGhpc0luaXRpYWxpemVkKHNlbGYpOyB9XG5cbmZ1bmN0aW9uIF9hc3NlcnRUaGlzSW5pdGlhbGl6ZWQoc2VsZikgeyBpZiAoc2VsZiA9PT0gdm9pZCAwKSB7IHRocm93IG5ldyBSZWZlcmVuY2VFcnJvcihcInRoaXMgaGFzbid0IGJlZW4gaW5pdGlhbGlzZWQgLSBzdXBlcigpIGhhc24ndCBiZWVuIGNhbGxlZFwiKTsgfSByZXR1cm4gc2VsZjsgfVxuXG5mdW5jdGlvbiBfaXNOYXRpdmVSZWZsZWN0Q29uc3RydWN0KCkgeyBpZiAodHlwZW9mIFJlZmxlY3QgPT09IFwidW5kZWZpbmVkXCIgfHwgIVJlZmxlY3QuY29uc3RydWN0KSByZXR1cm4gZmFsc2U7IGlmIChSZWZsZWN0LmNvbnN0cnVjdC5zaGFtKSByZXR1cm4gZmFsc2U7IGlmICh0eXBlb2YgUHJveHkgPT09IFwiZnVuY3Rpb25cIikgcmV0dXJuIHRydWU7IHRyeSB7IEJvb2xlYW4ucHJvdG90eXBlLnZhbHVlT2YuY2FsbChSZWZsZWN0LmNvbnN0cnVjdChCb29sZWFuLCBbXSwgZnVuY3Rpb24gKCkge30pKTsgcmV0dXJuIHRydWU7IH0gY2F0Y2ggKGUpIHsgcmV0dXJuIGZhbHNlOyB9IH1cblxuZnVuY3Rpb24gX2dldFByb3RvdHlwZU9mKG8pIHsgX2dldFByb3RvdHlwZU9mID0gT2JqZWN0LnNldFByb3RvdHlwZU9mID8gT2JqZWN0LmdldFByb3RvdHlwZU9mIDogZnVuY3Rpb24gX2dldFByb3RvdHlwZU9mKG8pIHsgcmV0dXJuIG8uX19wcm90b19fIHx8IE9iamVjdC5nZXRQcm90b3R5cGVPZihvKTsgfTsgcmV0dXJuIF9nZXRQcm90b3R5cGVPZihvKTsgfVxuXG5pbXBvcnQgeyBDb250cm9sbGVyIH0gZnJvbSAnc3RpbXVsdXMnO1xuLypcbiAqIFRoaXMgaXMgYW4gZXhhbXBsZSBTdGltdWx1cyBjb250cm9sbGVyIVxuICpcbiAqIEFueSBlbGVtZW50IHdpdGggYSBkYXRhLWNvbnRyb2xsZXI9XCJoZWxsb1wiIGF0dHJpYnV0ZSB3aWxsIGNhdXNlXG4gKiB0aGlzIGNvbnRyb2xsZXIgdG8gYmUgZXhlY3V0ZWQuIFRoZSBuYW1lIFwiaGVsbG9cIiBjb21lcyBmcm9tIHRoZSBmaWxlbmFtZTpcbiAqIGhlbGxvX2NvbnRyb2xsZXIuanMgLT4gXCJoZWxsb1wiXG4gKlxuICogRGVsZXRlIHRoaXMgZmlsZSBvciBhZGFwdCBpdCBmb3IgeW91ciB1c2UhXG4gKi9cblxudmFyIF9kZWZhdWx0ID0gLyojX19QVVJFX18qL2Z1bmN0aW9uIChfQ29udHJvbGxlcikge1xuICBfaW5oZXJpdHMoX2RlZmF1bHQsIF9Db250cm9sbGVyKTtcblxuICB2YXIgX3N1cGVyID0gX2NyZWF0ZVN1cGVyKF9kZWZhdWx0KTtcblxuICBmdW5jdGlvbiBfZGVmYXVsdCgpIHtcbiAgICBfY2xhc3NDYWxsQ2hlY2sodGhpcywgX2RlZmF1bHQpO1xuXG4gICAgcmV0dXJuIF9zdXBlci5hcHBseSh0aGlzLCBhcmd1bWVudHMpO1xuICB9XG5cbiAgX2NyZWF0ZUNsYXNzKF9kZWZhdWx0LCBbe1xuICAgIGtleTogXCJjb25uZWN0XCIsXG4gICAgdmFsdWU6IGZ1bmN0aW9uIGNvbm5lY3QoKSB7XG4gICAgICB0aGlzLmVsZW1lbnQudGV4dENvbnRlbnQgPSAnSGVsbG8gU3RpbXVsdXMhIEVkaXQgbWUgaW4gYXNzZXRzL2NvbnRyb2xsZXJzL2hlbGxvX2NvbnRyb2xsZXIuanMnO1xuICAgIH1cbiAgfV0pO1xuXG4gIHJldHVybiBfZGVmYXVsdDtcbn0oQ29udHJvbGxlcik7XG5cbmV4cG9ydCB7IF9kZWZhdWx0IGFzIGRlZmF1bHQgfTsiLCIvKlxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxuICpcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXG4gKi9cblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcblxuLy8gc3RhcnQgdGhlIFN0aW11bHVzIGFwcGxpY2F0aW9uXG5pbXBvcnQgJy4vYm9vdHN0cmFwJztcblxuaW1wb3J0IGpxdWVyeSBmcm9tICdqcXVlcnknO1xuXG5pbXBvcnQgJy4vanF1ZXJ5Lm1vZGFsLm1pbic7XG5cblxuaW1wb3J0IEVhc3lNREUgZnJvbSAnZWFzeW1kZSc7XG5cbmltcG9ydCBtYXJrZWQgZnJvbSAnbWFya2VkJztcblxuXG52YXIgbWFya2Rvd25fZWRpdG9yID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJtYXJrZG93bi1lZGl0b3JcIik7XG5pZihtYXJrZG93bl9lZGl0b3Ipe1xuICAgIHZhciBtayA9IG5ldyBFYXN5TURFKHtcbiAgICAgICAgZWxlbWVudDogbWFya2Rvd25fZWRpdG9yLFxuICAgICAgICBwcm9tcHRVUkxzOiB0cnVlLFxuICAgICAgICB0YWJTaXplOiA0LFxuICAgICAgICBzcGVsbENoZWNrZXI6IHRydWUsXG4gICAgICAgIG5hdGl2ZVNwZWxsY2hlY2s6IHRydWUsXG4gICAgICAgIHNpZGVCeVNpZGVGdWxsc2NyZWVuOiBmYWxzZSxcbiAgICAgICAgbWF4SGVpZ2h0OiAnMjAwcHgnLFxuICAgICAgICB0b29sYmFyOiBbXG4gICAgICAgICAgICBcImJvbGRcIiwgXCJpdGFsaWNcIiwgXCJzdHJpa2V0aHJvdWdoXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJjb2RlXCIsIFwicXVvdGVcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcIm9yZGVyZWQtbGlzdFwiLCBcInVub3JkZXJlZC1saXN0XCIsIFwifFwiLFxuICAgICAgICAgICAgXCJsaW5rXCIsIFwiaW1hZ2VcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImhvcml6b250YWwtcnVsZVwiLCBcImNsZWFuLWJsb2NrXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJzaWRlLWJ5LXNpZGVcIlxuICAgICAgICBdXG4gICAgfSk7XG5cbiAgICBtay50b2dnbGVTaWRlQnlTaWRlKCk7XG59XG5jb25zb2xlLmxvZyhtaylcbmNvbnNvbGUubG9nKFwiaGVsbG9cIik7XG5jb25zdCBtb2RhbF9kYXRhID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJtb2RhbC1kYXRhXCIpO1xuY29uc3QgbW9kYWxfdmlldyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibW9kYWwtdmlld1wiKTtcbmlmKG1vZGFsX3ZpZXcpIHtcbiAgICBtb2RhbF92aWV3LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgaW5uZXJEaXYgPSAkKCc8cHJlIGNsYXNzPVwibS0wIHByZS13cmFwXCI+PC9wcmU+JykuaHRtbChtYXJrZWQobW9kYWxfZGF0YS5pbm5lckhUTUwpKTtcbiAgICAgICAgdmFyIG1vZGFsID0gJCgnLm1vZGFsJyk7XG4gICAgICAgIG1vZGFsLmFkZENsYXNzKCdtb2RhbC1zbScpO1xuICAgICAgICAkKCcjc2ltcGxlLWFkYy1tb2RhbC1oZWFkZXInKS5odG1sKCdNZWRpYSBJbmZvJyk7XG4gICAgICAgICQoJyNzaW1wbGUtYWRjLW1vZGFsIC5tb2RhbC1ib2R5JykuaHRtbChpbm5lckRpdlswXS5vdXRlckhUTUwpO1xuICAgICAgICAkKFwiI3NpbXBsZS1hZGMtbW9kYWxcIikubW9kYWwoJ3Nob3cnKTtcbiAgICB9KTtcbn1cblxuY29uc3QgbW9kYWxfZGF0YV9wZWVycyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicGVlcnMtbGlzdFwiKTtcbmNvbnN0IG1vZGFsX3ZpZXdfcGVlcnMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImFkYy1wZWVycy1saXN0LXZpZXdcIik7XG5pZihtb2RhbF92aWV3X3BlZXJzKSB7XG4gICAgbW9kYWxfdmlld19wZWVycy5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblxuICAgICAgICB2YXIgaW5uZXJEaXYgPSAkKCc8cHJlIGNsYXNzPVwibS0wIHByZS13cmFwXCI+PC9wcmU+JykuaHRtbChtb2RhbF9kYXRhX3BlZXJzLmlubmVySFRNTCk7XG4gICAgICAgIHZhciBtb2RhbCA9ICQoJy5tb2RhbCcpO1xuICAgICAgICBtb2RhbC5hZGRDbGFzcygnbW9kYWwtc20nKTtcbiAgICAgICAgJCgnI3NpbXBsZS1hZGMtbW9kYWwtaGVhZGVyJykuaHRtbCgnUGVlcnMnKTtcbiAgICAgICAgJCgnI3NpbXBsZS1hZGMtbW9kYWwgLm1vZGFsLWJvZHknKS5odG1sKGlubmVyRGl2WzBdLm91dGVySFRNTCk7XG4gICAgICAgICQoXCIjc2ltcGxlLWFkYy1tb2RhbFwiKS5tb2RhbCgnc2hvdycpO1xuICAgIH0pO1xufVxuXG5pZih3aW5kb3cubG9jYXRpb24ucGF0aG5hbWUgPT09IFwiL3VwbG9hZFwiICkge1xuICAgIGxldCBmb3JtZGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICAgIGZvcm1kYXRhLmFwcGVuZChcInByZXZpZXdcIiwgdHJ1ZSk7XG4gICAgJCgnI3VwbG9hZF9mb3JtX3RvcnJlbnRfZmlsZScpLmNoYW5nZShmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmIChmb3JtZGF0YS5oYXMoXCJ1cGxvYWRfZm9ybVt0b3JyZW50X2ZpbGVdXCIpKSB7XG4gICAgICAgICAgICBmb3JtZGF0YS5kZWxldGUoXCJ1cGxvYWRfZm9ybVt0b3JyZW50X2ZpbGVdXCIpO1xuICAgICAgICB9XG4gICAgICAgIGlmICgkKHRoaXMpLnByb3AoJ2ZpbGVzJykubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgdmFyIGZpbGUgPSAkKHRoaXMpLnByb3AoJ2ZpbGVzJylbMF07XG4gICAgICAgICAgICBmb3JtZGF0YS5hcHBlbmQoXCJ1cGxvYWRfZm9ybVt0b3JyZW50X2ZpbGVdXCIsIGZpbGUpO1xuICAgICAgICB9XG4gICAgfSk7XG4gICAgdmFyIGNvbnRlbnRJbmZvID0gbmV3IEVhc3lNREUoe1xuICAgICAgICBlbGVtZW50OiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZF9mb3JtX2NvbnRlbnRfaW5mb1wiKSxcbiAgICAgICAgcHJvbXB0VVJMczogdHJ1ZSxcbiAgICAgICAgdGFiU2l6ZTogNCxcbiAgICAgICAgc3BlbGxDaGVja2VyOiB0cnVlLFxuICAgICAgICBuYXRpdmVTcGVsbGNoZWNrOiB0cnVlLFxuICAgICAgICBzaWRlQnlTaWRlRnVsbHNjcmVlbjogZmFsc2UsXG4gICAgICAgIG1heEhlaWdodDogJzIwMHB4JyxcbiAgICAgICAgdG9vbGJhcjogW1xuICAgICAgICAgICAgXCJib2xkXCIsIFwiaXRhbGljXCIsIFwic3RyaWtldGhyb3VnaFwiLCBcInxcIixcbiAgICAgICAgICAgIFwiY29kZVwiLCBcInF1b3RlXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJvcmRlcmVkLWxpc3RcIiwgXCJ1bm9yZGVyZWQtbGlzdFwiLCBcInxcIixcbiAgICAgICAgICAgIFwibGlua1wiLCBcImltYWdlXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJob3Jpem9udGFsLXJ1bGVcIiwgXCJjbGVhbi1ibG9ja1wiLCBcInxcIixcbiAgICAgICAgICAgIFwic2lkZS1ieS1zaWRlXCJcbiAgICAgICAgXVxuICAgIH0pO1xuICAgIGNvbnRlbnRJbmZvLnRvZ2dsZVNpZGVCeVNpZGUoKTtcbiAgICB2YXIgcnNfdGV4dGFyZWEgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZF9mb3JtX3JlbGVhc2VfZGV0YWlsc1wiKTtcbiAgICB2YXIgcmVsZWFzZURldGFpbHMgPSBuZXcgRWFzeU1ERSh7XG4gICAgICAgIGVsZW1lbnQ6IHJzX3RleHRhcmVhLFxuICAgICAgICBwcm9tcHRVUkxzOiB0cnVlLFxuICAgICAgICB0YWJTaXplOiA0LFxuICAgICAgICBzcGVsbENoZWNrZXI6IHRydWUsXG4gICAgICAgIG5hdGl2ZVNwZWxsY2hlY2s6IHRydWUsXG4gICAgICAgIHNpZGVCeVNpZGVGdWxsc2NyZWVuOiBmYWxzZSxcbiAgICAgICAgaW5wdXRTdHlsZTogXCJ0ZXh0YXJlYVwiLFxuICAgICAgICBtYXhIZWlnaHQ6ICczMDBweCcsXG4gICAgICAgIHRvb2xiYXI6IFtcbiAgICAgICAgICAgIFwiYm9sZFwiLCBcIml0YWxpY1wiLCBcInN0cmlrZXRocm91Z2hcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImNvZGVcIiwgXCJxdW90ZVwiLCBcInxcIixcbiAgICAgICAgICAgIFwib3JkZXJlZC1saXN0XCIsIFwidW5vcmRlcmVkLWxpc3RcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImxpbmtcIiwgXCJpbWFnZVwiLCBcInxcIixcbiAgICAgICAgICAgIFwiaG9yaXpvbnRhbC1ydWxlXCIsIFwiY2xlYW4tYmxvY2tcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcInNpZGUtYnktc2lkZVwiXG4gICAgICAgIF1cbiAgICB9KTtcbiAgICByZWxlYXNlRGV0YWlscy50b2dnbGVTaWRlQnlTaWRlKCk7XG5cbiAgICB2YXIgbWlfdGV4dGFyZWEgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZF9mb3JtX21lZGlhaW5mb1wiKTtcbiAgICB2YXIgbWVkaWFpbmZvID0gbmV3IEVhc3lNREUoe1xuICAgICAgICBlbGVtZW50OiBtaV90ZXh0YXJlYSxcbiAgICAgICAgcHJvbXB0VVJMczogdHJ1ZSxcbiAgICAgICAgdGFiU2l6ZTogNCxcbiAgICAgICAgc3BlbGxDaGVja2VyOiB0cnVlLFxuICAgICAgICBuYXRpdmVTcGVsbGNoZWNrOiB0cnVlLFxuICAgICAgICBzaWRlQnlTaWRlRnVsbHNjcmVlbjogZmFsc2UsXG4gICAgICAgIGlucHV0U3R5bGU6IFwidGV4dGFyZWFcIixcbiAgICAgICAgbWF4SGVpZ2h0OiAnMzAwcHgnLFxuICAgICAgICB0b29sYmFyOiBbXG4gICAgICAgICAgICBcImJvbGRcIiwgXCJpdGFsaWNcIiwgXCJzdHJpa2V0aHJvdWdoXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJjb2RlXCIsIFwicXVvdGVcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcIm9yZGVyZWQtbGlzdFwiLCBcInVub3JkZXJlZC1saXN0XCIsIFwifFwiLFxuICAgICAgICAgICAgXCJsaW5rXCIsIFwiaW1hZ2VcIiwgXCJ8XCIsXG4gICAgICAgICAgICBcImhvcml6b250YWwtcnVsZVwiLCBcImNsZWFuLWJsb2NrXCIsIFwifFwiLFxuICAgICAgICAgICAgXCJzaWRlLWJ5LXNpZGVcIlxuICAgICAgICBdXG4gICAgfSk7XG4gICAgbWVkaWFpbmZvLnRvZ2dsZVNpZGVCeVNpZGUoKTtcblxuICAgIHZhciB0ZW1wbGF0ZSA9IG51bGw7XG4gICAgJC5hamF4KFxuICAgICAgICB7XG4gICAgICAgICAgICB1cmw6IFwiL2FwaS90ZW1wbGF0ZVwiLFxuICAgICAgICAgICAgdHlwZTogJ2dldCcsXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2h0bWwnLFxuICAgICAgICAgICAgYXN5bmM6IGZhbHNlLFxuICAgICAgICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICB0ZW1wbGF0ZSA9IEpTT04ucGFyc2UoZGF0YSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIHZhciByYWRpb2J0biA9IGRvY3VtZW50LnVwbG9hZF9mb3JtLnRlbXBsYXRlX3JhZGlvO1xuXG4gICAgcmVsZWFzZURldGFpbHMudmFsdWUodGVtcGxhdGVbJ2R2ZF90ZW1wbGF0ZSddKVxuICAgIHJhZGlvYnRuWzBdLmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIGZ1bmN0aW9uICgpe1xuICAgICAgICByZWxlYXNlRGV0YWlscy52YWx1ZSh0ZW1wbGF0ZVsnZHZkX3RlbXBsYXRlJ10pO1xuICAgIH0pXG4gICAgcmFkaW9idG5bMV0uYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgZnVuY3Rpb24gKCl7XG4gICAgICAgIHJlbGVhc2VEZXRhaWxzLnZhbHVlKHRlbXBsYXRlWydiZG12X3RlbXBsYXRlJ10pO1xuICAgIH0pXG4gICAgcmFkaW9idG5bMl0uYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgZnVuY3Rpb24gKCl7XG4gICAgICAgIHJlbGVhc2VEZXRhaWxzLnZhbHVlKHRlbXBsYXRlWyd1aGRfdGVtcGxhdGUnXSk7XG4gICAgfSlcblxuICAgIHZhciBnZXRfY29udGVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiY29udGVudC11cmwtYnV0dG9uXCIpO1xuXG4gICAgZ2V0X2NvbnRlbnQuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKXtcbiAgICAgICAgdmFyIHNjcmFwcGVyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJ1cGxvYWQtc2NyYXBwZXJcIik7XG4gICAgICAgIHZhciBzY3JhcHBlcl91cmwgPSBcIi9hcGkvc2NyYXBwZXIvXCIgKyBzY3JhcHBlci5vcHRpb25zW3NjcmFwcGVyLnNlbGVjdGVkSW5kZXhdLnZhbHVlICsgXCI/dXJsPVwiO1xuXG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IGVuY29kZVVSSShzY3JhcHBlcl91cmwgKyBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZF9mb3JtX2NvbnRlbnRfdXJsXCIpLnZhbHVlKSxcbiAgICAgICAgICAgIHR5cGU6ICdnZXQnLFxuICAgICAgICAgICAgZGF0YVR5cGU6ICdodG1sJyxcbiAgICAgICAgICAgIGFzeW5jOiBmYWxzZSxcbiAgICAgICAgICAgIGNhY2hlOiBmYWxzZSxcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChkYXRhKXtcbiAgICAgICAgICAgICAgICB2YXIgY29udGVudCA9IEpTT04ucGFyc2UoZGF0YSlbJ2NvbnRlbnRfaW5mbyddO1xuICAgICAgICAgICAgICAgIGNvbnRlbnRJbmZvLnZhbHVlKGNvbnRlbnQuc3Vic3RyaW5nKDEpKTtcbiAgICAgICAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImltYWdlLWZyb20tc2NyYXBwZXJcIikuc3JjID0gSlNPTi5wYXJzZShkYXRhKVsnaW1hZ2UnXTtcbiAgICAgICAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZF9mb3JtX2NvbnRlbnRfcG9zdGVyXCIpLnZhbHVlID0gSlNPTi5wYXJzZShkYXRhKVsnaW1hZ2UnXTtcbiAgICAgICAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImltYWdlLWZyb20tc2NyYXBwZXItY29udGVudFwiKS5jbGFzc0xpc3QucmVtb3ZlKFwiZC1ub25lXCIpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgIH0pO1xuICAgIGNvbnN0IHVwbG9hZENvbnRlbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInVwbG9hZC1jb250ZW50XCIpO1xuICAgIGNvbnN0IHByZXZpZXdDb250ZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmV2aWV3LWNvbnRlbnRcIik7XG4gICAgY29uc3QgcHJldmlldyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicHJldmlld19idG5cIik7XG5cbiAgICBwcmV2aWV3LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCl7XG4gICAgICAgIHVwbG9hZENvbnRlbnQuY2xhc3NMaXN0LmFkZChcImQtbm9uZVwiKTtcbiAgICAgICAgcHJldmlld0NvbnRlbnQuY2xhc3NMaXN0LnJlbW92ZShcImQtbm9uZVwiKTtcblxuICAgICAgICB2YXIgdXBsb2FkVG9ycmVudE5hbWUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiaW5wdXRbbmFtZT0ndXBsb2FkX2Zvcm1bdG9ycmVudF9uYW1lXSddXCIpO1xuICAgICAgICB2YXIgcHJldmlld1RvcnJlbnRTaXplID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmV2aWV3LXRvcnJlbnQtc2l6ZVwiKTtcbiAgICAgICAgdmFyIHByZXZpZXdUb3JyZW50TmFtZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicHJldmlldy10b3JyZW50LW5hbWVcIik7XG4gICAgICAgIHZhciBwcmV2aWV3VG9ycmVudEluZm9oYXNoID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmV2aWV3LWluZm8taGFzaFwiKTtcbiAgICAgICAgdmFyIHByZXZpZXdUb3JyZW50RmlsZXMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInByZXZpZXctdG9ycmVudC1maWxlc1wiKTtcbiAgICAgICAgdmFyIHByZXZpZXdDb250ZW50SW5mbyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiY29udGVudC1wYXJzZWQtbWVzc2FnZVwiKTtcbiAgICAgICAgdmFyIHByZXZpZXdSZWxlYXNlSW5mbyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicmVsZWFzZS1kZXRhaWxzXCIpO1xuICAgICAgICB2YXIgcHJldmlld01lZGlhaW5mbyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYWRjLXRvcnJlbnQtbWVkaWFpbmZvXCIpO1xuICAgICAgICB2YXIgcHJldmlld0ltYWdlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwcmV2aWV3LWltYWdlXCIpO1xuXG4gICAgICAgIHZhciBwcmV2aWV3U2hvd01lZGlhSW5mb0Jsb2NrID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJzaG93LW1lZGlhLWluZm8tYmxvY2tcIik7XG4gICAgICAgIHZhciBwcmV2aWV3Tm9NZWRpYUluZm9CbG9jayA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibm8tbWVkaWEtaW5mby1ibG9ja1wiKTtcblxuICAgICAgICBwcmV2aWV3VG9ycmVudE5hbWUuaW5uZXJIVE1MID0gdXBsb2FkVG9ycmVudE5hbWUudmFsdWU7XG4gICAgICAgIHByZXZpZXdSZWxlYXNlSW5mby5pbm5lckhUTUwgPSBtYXJrZWQocmVsZWFzZURldGFpbHMudmFsdWUoKSk7XG4gICAgICAgIHByZXZpZXdDb250ZW50SW5mby5pbm5lckhUTUwgPSBtYXJrZWQoY29udGVudEluZm8udmFsdWUoKSk7XG4gICAgICAgIHByZXZpZXdJbWFnZS5zcmMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImltYWdlLWZyb20tc2NyYXBwZXJcIikuc3JjO1xuXG4gICAgICAgIHByZXZpZXdNZWRpYWluZm8uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKXtcbiAgICAgICAgICAgIHZhciBpbm5lckRpdiA9ICQoJzxwcmUgY2xhc3M9XCJtLTAgcHJlLXdyYXBcIj48L3ByZT4nKS5odG1sKG1hcmtlZChtZWRpYWluZm8udmFsdWUoKSkpO1xuICAgICAgICAgICAgdmFyIG1vZGFsID0gJCgnLm1vZGFsJyk7XG4gICAgICAgICAgICBtb2RhbC5hZGRDbGFzcygnbW9kYWwtc20nKTtcblxuICAgICAgICAgICAgJCgnI3NpbXBsZS1hZGMtbW9kYWwtaGVhZGVyJykuaHRtbCgnTWVkaWEgSW5mbycpO1xuICAgICAgICAgICAgJCgnI3NpbXBsZS1hZGMtbW9kYWwgLm1vZGFsLWJvZHknKS5odG1sKGlubmVyRGl2WzBdLm91dGVySFRNTCk7XG4gICAgICAgICAgICAkKFwiI3NpbXBsZS1hZGMtbW9kYWxcIikubW9kYWwoJ3Nob3cnKTtcbiAgICAgICAgfSlcblxuICAgICAgICBmb3JtZGF0YS5zZXQoXCJwcmV2aWV3XCIsIHRydWUpO1xuICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgdXJsOiBcIi91cGxvYWRcIixcbiAgICAgICAgICAgIHR5cGU6IFwiUE9TVFwiLFxuICAgICAgICAgICAgZGF0YTogZm9ybWRhdGEsXG4gICAgICAgICAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgICAgICAgICBjb250ZW50VHlwZTogZmFsc2UsXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAocmVzdWx0KSB7XG4gICAgICAgICAgICAgICAgdHJ5IHtcbiAgICAgICAgICAgICAgICAgICAgcmVzdWx0ID0gSlNPTi5wYXJzZShyZXN1bHQpO1xuICAgICAgICAgICAgICAgIH0gY2F0Y2gge31cbiAgICAgICAgICAgICAgICBwcmV2aWV3VG9ycmVudE5hbWUuaW5uZXJIVE1MID0gcmVzdWx0WyduYW1lJ107XG4gICAgICAgICAgICAgICAgcHJldmlld1RvcnJlbnRTaXplLmlubmVySFRNTCA9IHJlc3VsdFsnc2l6ZSddO1xuICAgICAgICAgICAgICAgIHByZXZpZXdUb3JyZW50SW5mb2hhc2guaW5uZXJIVE1MID0gcmVzdWx0WydmaWxlcyddWydpbmZvX2hhc2gnXTtcbiAgICAgICAgICAgICAgICBwcmV2aWV3VG9ycmVudEZpbGVzLmlubmVySFRNTCA9IHJlc3VsdFsnZmlsZXMnXVsndG90YWwnXTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbiAgICB2YXIgdXBsb2FkX3JldHVybiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidXBsb2FkX3JldHVyblwiKTtcbiAgICB1cGxvYWRfcmV0dXJuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJyxmdW5jdGlvbiAoKXtcbiAgICAgICAgdXBsb2FkQ29udGVudC5jbGFzc0xpc3QucmVtb3ZlKFwiZC1ub25lXCIpO1xuICAgICAgICBwcmV2aWV3Q29udGVudC5jbGFzc0xpc3QuYWRkKFwiZC1ub25lXCIpO1xuICAgIH0pO1xufVxuXG4iLCJpbXBvcnQgeyBzdGFydFN0aW11bHVzQXBwIH0gZnJvbSAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcblxuLy8gUmVnaXN0ZXJzIFN0aW11bHVzIGNvbnRyb2xsZXJzIGZyb20gY29udHJvbGxlcnMuanNvbiBhbmQgaW4gdGhlIGNvbnRyb2xsZXJzLyBkaXJlY3RvcnlcbmV4cG9ydCBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKHJlcXVpcmUuY29udGV4dChcbiAgICAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIhLi9jb250cm9sbGVycycsXG4gICAgdHJ1ZSxcbiAgICAvXFwuKGp8dClzeD8kL1xuKSk7XG5cblxuIiwiLypcbiAgICBBIHNpbXBsZSBqUXVlcnkgbW9kYWwgKGh0dHA6Ly9naXRodWIuY29tL2t5bGVmb3gvanF1ZXJ5LW1vZGFsKVxuICAgIFZlcnNpb24gMC45LjJcbiovXG4hIGZ1bmN0aW9uIChvKSB7XG4gICAgXCJvYmplY3RcIiA9PSB0eXBlb2YgbW9kdWxlICYmIFwib2JqZWN0XCIgPT0gdHlwZW9mIG1vZHVsZS5leHBvcnRzID8gbyhyZXF1aXJlKFwianF1ZXJ5XCIpLCB3aW5kb3csIGRvY3VtZW50KSA6IG8oalF1ZXJ5LCB3aW5kb3csIGRvY3VtZW50KVxufShmdW5jdGlvbiAobywgdCwgaSwgZSkge1xuICAgIHZhciBzID0gW10sXG4gICAgICAgIGwgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICByZXR1cm4gcy5sZW5ndGggPyBzW3MubGVuZ3RoIC0gMV0gOiBudWxsXG4gICAgICAgIH0sXG4gICAgICAgIG4gPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgbywgdCA9ICExO1xuICAgICAgICAgICAgZm9yIChvID0gcy5sZW5ndGggLSAxOyBvID49IDA7IG8tLSkgc1tvXS4kYmxvY2tlciAmJiAoc1tvXS4kYmxvY2tlci50b2dnbGVDbGFzcyhcImN1cnJlbnRcIiwgIXQpLnRvZ2dsZUNsYXNzKFwiYmVoaW5kXCIsIHQpLCB0ID0gITApXG4gICAgICAgIH07XG4gICAgby5tb2RhbCA9IGZ1bmN0aW9uICh0LCBpKSB7XG4gICAgICAgIHZhciBlLCBuO1xuICAgICAgICBpZiAodGhpcy4kYm9keSA9IG8oXCJib2R5XCIpLCB0aGlzLm9wdGlvbnMgPSBvLmV4dGVuZCh7fSwgby5tb2RhbC5kZWZhdWx0cywgaSksIHRoaXMub3B0aW9ucy5kb0ZhZGUgPSAhaXNOYU4ocGFyc2VJbnQodGhpcy5vcHRpb25zLmZhZGVEdXJhdGlvbiwgMTApKSwgdGhpcy4kYmxvY2tlciA9IG51bGwsIHRoaXMub3B0aW9ucy5jbG9zZUV4aXN0aW5nKVxuICAgICAgICAgICAgZm9yICg7IG8ubW9kYWwuaXNBY3RpdmUoKTspIG8ubW9kYWwuY2xvc2UoKTtcbiAgICAgICAgaWYgKHMucHVzaCh0aGlzKSwgdC5pcyhcImFcIikpXG4gICAgICAgICAgICBpZiAobiA9IHQuYXR0cihcImhyZWZcIiksIHRoaXMuYW5jaG9yID0gdCwgL14jLy50ZXN0KG4pKSB7XG4gICAgICAgICAgICAgICAgaWYgKHRoaXMuJGVsbSA9IG8obiksIDEgIT09IHRoaXMuJGVsbS5sZW5ndGgpIHJldHVybiBudWxsO1xuICAgICAgICAgICAgICAgIHRoaXMuJGJvZHkuYXBwZW5kKHRoaXMuJGVsbSksIHRoaXMub3BlbigpXG4gICAgICAgICAgICB9IGVsc2UgdGhpcy4kZWxtID0gbyhcIjxkaXY+XCIpLCB0aGlzLiRib2R5LmFwcGVuZCh0aGlzLiRlbG0pLCBlID0gZnVuY3Rpb24gKG8sIHQpIHtcbiAgICAgICAgICAgICAgICB0LmVsbS5yZW1vdmUoKVxuICAgICAgICAgICAgfSwgdGhpcy5zaG93U3Bpbm5lcigpLCB0LnRyaWdnZXIoby5tb2RhbC5BSkFYX1NFTkQpLCBvLmdldChuKS5kb25lKGZ1bmN0aW9uIChpKSB7XG4gICAgICAgICAgICAgICAgaWYgKG8ubW9kYWwuaXNBY3RpdmUoKSkge1xuICAgICAgICAgICAgICAgICAgICB0LnRyaWdnZXIoby5tb2RhbC5BSkFYX1NVQ0NFU1MpO1xuICAgICAgICAgICAgICAgICAgICB2YXIgcyA9IGwoKTtcbiAgICAgICAgICAgICAgICAgICAgcy4kZWxtLmVtcHR5KCkuYXBwZW5kKGkpLm9uKG8ubW9kYWwuQ0xPU0UsIGUpLCBzLmhpZGVTcGlubmVyKCksIHMub3BlbigpLCB0LnRyaWdnZXIoby5tb2RhbC5BSkFYX0NPTVBMRVRFKVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pLmZhaWwoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIHQudHJpZ2dlcihvLm1vZGFsLkFKQVhfRkFJTCk7XG4gICAgICAgICAgICAgICAgdmFyIGkgPSBsKCk7XG4gICAgICAgICAgICAgICAgaS5oaWRlU3Bpbm5lcigpLCBzLnBvcCgpLCB0LnRyaWdnZXIoby5tb2RhbC5BSkFYX0NPTVBMRVRFKVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIGVsc2UgdGhpcy4kZWxtID0gdCwgdGhpcy5hbmNob3IgPSB0LCB0aGlzLiRib2R5LmFwcGVuZCh0aGlzLiRlbG0pLCB0aGlzLm9wZW4oKVxuICAgIH0sIG8ubW9kYWwucHJvdG90eXBlID0ge1xuICAgICAgICBjb25zdHJ1Y3Rvcjogby5tb2RhbCxcbiAgICAgICAgb3BlbjogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgdmFyIHQgPSB0aGlzO1xuICAgICAgICAgICAgdGhpcy5ibG9jaygpLCB0aGlzLmFuY2hvci5ibHVyKCksIHRoaXMub3B0aW9ucy5kb0ZhZGUgPyBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICB0LnNob3coKVxuICAgICAgICAgICAgfSwgdGhpcy5vcHRpb25zLmZhZGVEdXJhdGlvbiAqIHRoaXMub3B0aW9ucy5mYWRlRGVsYXkpIDogdGhpcy5zaG93KCksIG8oaSkub2ZmKFwia2V5ZG93bi5tb2RhbFwiKS5vbihcImtleWRvd24ubW9kYWxcIiwgZnVuY3Rpb24gKG8pIHtcbiAgICAgICAgICAgICAgICB2YXIgdCA9IGwoKTtcbiAgICAgICAgICAgICAgICAyNyA9PT0gby53aGljaCAmJiB0Lm9wdGlvbnMuZXNjYXBlQ2xvc2UgJiYgdC5jbG9zZSgpXG4gICAgICAgICAgICB9KSwgdGhpcy5vcHRpb25zLmNsaWNrQ2xvc2UgJiYgdGhpcy4kYmxvY2tlci5jbGljayhmdW5jdGlvbiAodCkge1xuICAgICAgICAgICAgICAgIHQudGFyZ2V0ID09PSB0aGlzICYmIG8ubW9kYWwuY2xvc2UoKVxuICAgICAgICAgICAgfSlcbiAgICAgICAgfSxcbiAgICAgICAgY2xvc2U6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHMucG9wKCksIHRoaXMudW5ibG9jaygpLCB0aGlzLmhpZGUoKSwgby5tb2RhbC5pc0FjdGl2ZSgpIHx8IG8oaSkub2ZmKFwia2V5ZG93bi5tb2RhbFwiKVxuICAgICAgICB9LFxuICAgICAgICBibG9jazogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgdGhpcy4kZWxtLnRyaWdnZXIoby5tb2RhbC5CRUZPUkVfQkxPQ0ssIFt0aGlzLl9jdHgoKV0pLCB0aGlzLiRib2R5LmNzcyhcIm92ZXJmbG93XCIsIFwiaGlkZGVuXCIpLCB0aGlzLiRibG9ja2VyID0gbygnPGRpdiBjbGFzcz1cIicgKyB0aGlzLm9wdGlvbnMuYmxvY2tlckNsYXNzICsgJyBibG9ja2VyIGN1cnJlbnRcIj48L2Rpdj4nKS5hcHBlbmRUbyh0aGlzLiRib2R5KSwgbigpLCB0aGlzLm9wdGlvbnMuZG9GYWRlICYmIHRoaXMuJGJsb2NrZXIuY3NzKFwib3BhY2l0eVwiLCAwKS5hbmltYXRlKHtcbiAgICAgICAgICAgICAgICBvcGFjaXR5OiAxXG4gICAgICAgICAgICB9LCB0aGlzLm9wdGlvbnMuZmFkZUR1cmF0aW9uKSwgdGhpcy4kZWxtLnRyaWdnZXIoby5tb2RhbC5CTE9DSywgW3RoaXMuX2N0eCgpXSlcbiAgICAgICAgfSxcbiAgICAgICAgdW5ibG9jazogZnVuY3Rpb24gKHQpIHtcbiAgICAgICAgICAgICF0ICYmIHRoaXMub3B0aW9ucy5kb0ZhZGUgPyB0aGlzLiRibG9ja2VyLmZhZGVPdXQodGhpcy5vcHRpb25zLmZhZGVEdXJhdGlvbiwgdGhpcy51bmJsb2NrLmJpbmQodGhpcywgITApKSA6ICh0aGlzLiRibG9ja2VyLmNoaWxkcmVuKCkuYXBwZW5kVG8odGhpcy4kYm9keSksIHRoaXMuJGJsb2NrZXIucmVtb3ZlKCksIHRoaXMuJGJsb2NrZXIgPSBudWxsLCBuKCksIG8ubW9kYWwuaXNBY3RpdmUoKSB8fCB0aGlzLiRib2R5LmNzcyhcIm92ZXJmbG93XCIsIFwiXCIpKVxuICAgICAgICB9LFxuICAgICAgICBzaG93OiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB0aGlzLiRlbG0udHJpZ2dlcihvLm1vZGFsLkJFRk9SRV9PUEVOLCBbdGhpcy5fY3R4KCldKSwgdGhpcy5vcHRpb25zLnNob3dDbG9zZSAmJiAodGhpcy5jbG9zZUJ1dHRvbiA9IG8oJzxhIGhyZWY9XCIjY2xvc2UtbW9kYWxcIiByZWw9XCJtb2RhbDpjbG9zZVwiIGNsYXNzPVwiY2xvc2UtbW9kYWwgJyArIHRoaXMub3B0aW9ucy5jbG9zZUNsYXNzICsgJ1wiPicgKyB0aGlzLm9wdGlvbnMuY2xvc2VUZXh0ICsgXCI8L2E+XCIpLCB0aGlzLiRlbG0uYXBwZW5kKHRoaXMuY2xvc2VCdXR0b24pKSwgdGhpcy4kZWxtLmFkZENsYXNzKHRoaXMub3B0aW9ucy5tb2RhbENsYXNzKS5hcHBlbmRUbyh0aGlzLiRibG9ja2VyKSwgdGhpcy5vcHRpb25zLmRvRmFkZSA/IHRoaXMuJGVsbS5jc3Moe1xuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDAsXG4gICAgICAgICAgICAgICAgZGlzcGxheTogXCJpbmxpbmUtYmxvY2tcIlxuICAgICAgICAgICAgfSkuYW5pbWF0ZSh7XG4gICAgICAgICAgICAgICAgb3BhY2l0eTogMVxuICAgICAgICAgICAgfSwgdGhpcy5vcHRpb25zLmZhZGVEdXJhdGlvbikgOiB0aGlzLiRlbG0uY3NzKFwiZGlzcGxheVwiLCBcImlubGluZS1ibG9ja1wiKSwgdGhpcy4kZWxtLnRyaWdnZXIoby5tb2RhbC5PUEVOLCBbdGhpcy5fY3R4KCldKVxuICAgICAgICB9LFxuICAgICAgICBoaWRlOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB0aGlzLiRlbG0udHJpZ2dlcihvLm1vZGFsLkJFRk9SRV9DTE9TRSwgW3RoaXMuX2N0eCgpXSksIHRoaXMuY2xvc2VCdXR0b24gJiYgdGhpcy5jbG9zZUJ1dHRvbi5yZW1vdmUoKTtcbiAgICAgICAgICAgIHZhciB0ID0gdGhpcztcbiAgICAgICAgICAgIHRoaXMub3B0aW9ucy5kb0ZhZGUgPyB0aGlzLiRlbG0uZmFkZU91dCh0aGlzLm9wdGlvbnMuZmFkZUR1cmF0aW9uLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgdC4kZWxtLnRyaWdnZXIoby5tb2RhbC5BRlRFUl9DTE9TRSwgW3QuX2N0eCgpXSlcbiAgICAgICAgICAgIH0pIDogdGhpcy4kZWxtLmhpZGUoMCwgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIHQuJGVsbS50cmlnZ2VyKG8ubW9kYWwuQUZURVJfQ0xPU0UsIFt0Ll9jdHgoKV0pXG4gICAgICAgICAgICB9KSwgdGhpcy4kZWxtLnRyaWdnZXIoby5tb2RhbC5DTE9TRSwgW3RoaXMuX2N0eCgpXSlcbiAgICAgICAgfSxcbiAgICAgICAgc2hvd1NwaW5uZXI6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHRoaXMub3B0aW9ucy5zaG93U3Bpbm5lciAmJiAodGhpcy5zcGlubmVyID0gdGhpcy5zcGlubmVyIHx8IG8oJzxkaXYgY2xhc3M9XCInICsgdGhpcy5vcHRpb25zLm1vZGFsQ2xhc3MgKyAnLXNwaW5uZXJcIj48L2Rpdj4nKS5hcHBlbmQodGhpcy5vcHRpb25zLnNwaW5uZXJIdG1sKSwgdGhpcy4kYm9keS5hcHBlbmQodGhpcy5zcGlubmVyKSwgdGhpcy5zcGlubmVyLnNob3coKSlcbiAgICAgICAgfSxcbiAgICAgICAgaGlkZVNwaW5uZXI6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHRoaXMuc3Bpbm5lciAmJiB0aGlzLnNwaW5uZXIucmVtb3ZlKClcbiAgICAgICAgfSxcbiAgICAgICAgX2N0eDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgICAgICBlbG06IHRoaXMuJGVsbSxcbiAgICAgICAgICAgICAgICAkZWxtOiB0aGlzLiRlbG0sXG4gICAgICAgICAgICAgICAgJGJsb2NrZXI6IHRoaXMuJGJsb2NrZXIsXG4gICAgICAgICAgICAgICAgb3B0aW9uczogdGhpcy5vcHRpb25zLFxuICAgICAgICAgICAgICAgICRhbmNob3I6IHRoaXMuYW5jaG9yXG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9LCBvLm1vZGFsLmNsb3NlID0gZnVuY3Rpb24gKHQpIHtcbiAgICAgICAgaWYgKG8ubW9kYWwuaXNBY3RpdmUoKSkge1xuICAgICAgICAgICAgdCAmJiB0LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICB2YXIgaSA9IGwoKTtcbiAgICAgICAgICAgIHJldHVybiBpLmNsb3NlKCksIGkuJGVsbVxuICAgICAgICB9XG4gICAgfSwgby5tb2RhbC5pc0FjdGl2ZSA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgcmV0dXJuIHMubGVuZ3RoID4gMFxuICAgIH0sIG8ubW9kYWwuZ2V0Q3VycmVudCA9IGwsIG8ubW9kYWwuZGVmYXVsdHMgPSB7XG4gICAgICAgIGNsb3NlRXhpc3Rpbmc6ICEwLFxuICAgICAgICBlc2NhcGVDbG9zZTogITAsXG4gICAgICAgIGNsaWNrQ2xvc2U6ICEwLFxuICAgICAgICBjbG9zZVRleHQ6IFwiQ2xvc2VcIixcbiAgICAgICAgY2xvc2VDbGFzczogXCJcIixcbiAgICAgICAgbW9kYWxDbGFzczogXCJtb2RhbFwiLFxuICAgICAgICBibG9ja2VyQ2xhc3M6IFwianF1ZXJ5LW1vZGFsXCIsXG4gICAgICAgIHNwaW5uZXJIdG1sOiAnPGRpdiBjbGFzcz1cInJlY3QxXCI+PC9kaXY+PGRpdiBjbGFzcz1cInJlY3QyXCI+PC9kaXY+PGRpdiBjbGFzcz1cInJlY3QzXCI+PC9kaXY+PGRpdiBjbGFzcz1cInJlY3Q0XCI+PC9kaXY+JyxcbiAgICAgICAgc2hvd1NwaW5uZXI6ICEwLFxuICAgICAgICBzaG93Q2xvc2U6ICEwLFxuICAgICAgICBmYWRlRHVyYXRpb246IG51bGwsXG4gICAgICAgIGZhZGVEZWxheTogMVxuICAgIH0sIG8ubW9kYWwuQkVGT1JFX0JMT0NLID0gXCJtb2RhbDpiZWZvcmUtYmxvY2tcIiwgby5tb2RhbC5CTE9DSyA9IFwibW9kYWw6YmxvY2tcIiwgby5tb2RhbC5CRUZPUkVfT1BFTiA9IFwibW9kYWw6YmVmb3JlLW9wZW5cIiwgby5tb2RhbC5PUEVOID0gXCJtb2RhbDpvcGVuXCIsIG8ubW9kYWwuQkVGT1JFX0NMT1NFID0gXCJtb2RhbDpiZWZvcmUtY2xvc2VcIiwgby5tb2RhbC5DTE9TRSA9IFwibW9kYWw6Y2xvc2VcIiwgby5tb2RhbC5BRlRFUl9DTE9TRSA9IFwibW9kYWw6YWZ0ZXItY2xvc2VcIiwgby5tb2RhbC5BSkFYX1NFTkQgPSBcIm1vZGFsOmFqYXg6c2VuZFwiLCBvLm1vZGFsLkFKQVhfU1VDQ0VTUyA9IFwibW9kYWw6YWpheDpzdWNjZXNzXCIsIG8ubW9kYWwuQUpBWF9GQUlMID0gXCJtb2RhbDphamF4OmZhaWxcIiwgby5tb2RhbC5BSkFYX0NPTVBMRVRFID0gXCJtb2RhbDphamF4OmNvbXBsZXRlXCIsIG8uZm4ubW9kYWwgPSBmdW5jdGlvbiAodCkge1xuICAgICAgICByZXR1cm4gMSA9PT0gdGhpcy5sZW5ndGggJiYgbmV3IG8ubW9kYWwodGhpcywgdCksIHRoaXNcbiAgICB9LCBvKGkpLm9uKFwiY2xpY2subW9kYWxcIiwgJ2FbcmVsfj1cIm1vZGFsOmNsb3NlXCJdJywgby5tb2RhbC5jbG9zZSksIG8oaSkub24oXCJjbGljay5tb2RhbFwiLCAnYVtyZWx+PVwibW9kYWw6b3BlblwiXScsIGZ1bmN0aW9uICh0KSB7XG4gICAgICAgIHQucHJldmVudERlZmF1bHQoKSwgbyh0aGlzKS5tb2RhbCgpXG4gICAgfSlcbn0pOyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyIsIi8qIChpZ25vcmVkKSAqLyJdLCJzb3VyY2VSb290IjoiIn0=