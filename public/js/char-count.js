$(document).ready(function() {
    var text_max = 255;
    $('#textarea_feedback').html(text_max + ' characters remaining');

    $('#desc').keyup(function() {
        var text_length = $('#desc').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_remaining + ' characters remaining');
    });
});