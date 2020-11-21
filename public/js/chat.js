
$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.js-chat__form').submit(function(e) {
        e.preventDefault();

        var chat = $('.js-chat__container');
        var input = chat.find('.js-chat__messageInput');

        $.ajax('/chat', {
            method: 'post',
            data: {
                roomId: chat.data('roomId'),
                message: input.val()
            },
            success: function(data) {
                input.val('');
            }
        });
    });

    $('.js-chat__messages').animate({
        scrollTop: $(".js-chat__scrollToDown").offset().top
    }, 1000);
});
