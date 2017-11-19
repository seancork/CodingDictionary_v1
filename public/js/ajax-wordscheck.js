$(document).ready(function() {
   $(".checkword").on('click', ".btn", function() {
     button_id =  this.id;
  var which = button_id.replace(/[^a-zA-Z]+/g, '');
        $.ajax({
            type: 'post',
            url: '/checkword',
            data: {
                '_token': $('input[name=_token]').val(),
                'word_id': button_id,
                'type': which
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                }
                else {
            //notting
            }
            },
        });
});
   
});