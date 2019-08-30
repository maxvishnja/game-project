webpackJsonp([2],{

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {

$(document).ready(function () {
    var clipboard = new Clipboard('.copy-btn');
});

$('.calc-btn').on('click', function (e) {
    e.preventDefault();
    $('.history').html('');
    $.ajax({
        type: 'POST',
        url: '/calculated',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(response) {
            $('.result-title').html(response.message);
            $('.result-value').html(response.result);
        }
    });
});

$('.history-btn').on('click', function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/history',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(response) {
            console.log(response);
            if (response.length > 0) {
                response.reverse();
                response.forEach(function (item, i, response) {
                    $('.history').prepend('<h3>' + item + '</h3>');
                });
            } else {
                $('.history').html('<h3>No result</h3>');
            }
        }
    });
});

/***/ })

},[44]);