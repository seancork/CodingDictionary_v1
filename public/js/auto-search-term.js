$(document).ready(function() {
   $('#word').on('focusout', function() {
  $.ajax({
            type: 'GET',
            url: '/wordexist',
            data: {
                '_token': $('input[name=_token]').val(),
                'search':document.getElementById('word').value
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                }else {
                	console.log(data);
                	if(data == "exists"){
              $("#word_check").show();
            }else{
                $("#word_check").hide();
              

            }}
            },
        });
});
});