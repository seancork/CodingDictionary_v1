$(document).ready(function() {
     $(".wordsave").on('click', ".btn-default", function() {
     button_id =  this.id;

        $.ajax({
            type: 'post',
            url: '/saveword',
            data: {
                '_token': $('input[name=_token]').val(),
                'word_id': button_id

            },
            success: function(data) {

                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                }
                else {
                $('#'+button_id).html("Saved");
                $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');

                }
            },

        });
        $('#name').val('');
});
   $(".wordsave").on('click', ".btn-success", function() {
     button_id =  this.id;
        $.ajax({
            type: 'post',
            url: '/removesave',
            data: {
                '_token': $('input[name=_token]').val(),
                'word_id': button_id
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                }
                else {
                $('#'+button_id).html("Save");
                $('#'+button_id).removeClass('btn btn-success').addClass('btn btn-default');

                }
            },

        });
        $('#name').val('');
});

      $(".dashboard-unsave").on('click', ".btn-success", function() {
                 var x =  jQuery(this).attr("id");
     button_id =  this.id;
        $.ajax({
            type: 'post',
            url: '/removesave',
            data: {
                '_token': $('input[name=_token]').val(),
                'word_id': button_id
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                }
                else {
          
            document.getElementById("saved-"+x).style.display="none";

                }
            },

        });
        $('#name').val('');
});
});