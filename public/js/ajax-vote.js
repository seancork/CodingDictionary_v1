$(document).ready(function() {
   $(".vote").on('click', ".btn-default", function() {
     button_id =  this.id;
 var thenum = button_id.replace( /^\D+/g, '');
  var which = button_id.replace(/[^a-zA-Z]+/g, '');
        $.ajax({
            type: 'post',
            url: '/voteword',
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
                if(which == "up"){
                    console.log(button_id);
                $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
              $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
               vote_num("add");

                }
               if(which == "down" ){
               $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
               $('#up-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
                vote_num("sub");
               }
            }
            },
        });
        $('#name').val('');
});
    $(".vote").on('click', ".btn-success", function() {
     button_id =  this.id;
     var thenum = button_id.replace( /^\D+/g, '');
     var which = button_id.replace(/[^a-zA-Z]+/g, '');
        $.ajax({
            type: 'post',
            url: '/removeword',
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
                 if(which == "up"){
                $('#'+button_id).removeClass('btn btn-success').addClass('btn btn-default');
                 vote_num("sub");
                }
               if(which == "down" ){
               $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
                vote_num("add");
            
               }
                }
            },

        });
        $('#name').val('');
});
    function vote_num(type) {
    var computerScore = document.getElementById('votenum');
    var number = computerScore.innerHTML;
      if(type == "add"){
    number++;
    computerScore.innerHTML = number;
  }
    if(type == "sub"){
       number--;
    computerScore.innerHTML = number;
}}
});