$('.show__login').click(function () {
    $('#register-form').hide();
    $('#login-form').show();
    $('#modal__login2').show();
});

$('.show__register').click(function () {
    $('#login-form').hide();
    $('#register-form').show();
    $('#modal__login2').show();
});

$("body").on("click", ".close_modal, .btn__close", function () {
    $(this).parents(".modal").hide()
});