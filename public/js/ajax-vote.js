$(document).ready(function() {
   $(".vote").on('click', ".btn-default", function() {
     button_id =  this.id;
 var thenum = button_id.replace( /^\D+/g, '');
  var which = button_id.replace(/[^a-zA-Z]+/g, '');
   if(which == "up"){
                      check = ($('#down-'+thenum).hasClass("btn btn-success"));
                $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
              $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
               
               if(check == true){
               vote_num("addbytwo",thenum);
                }
                if(check == false){
                   vote_num("add",thenum);
                }
                }
               if(which == "down"){
                 check = ($('#up-'+thenum).hasClass("btn btn-success"));
               $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
               $('#up-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
                 if(check == true){
               vote_num("subbytwo", thenum);
                }
                if(check == false){
                   vote_num("sub",thenum);
                }
               }
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
               
            }
            },
        });
});
    $(".vote").on('click', ".btn-success", function() {
     button_id =  this.id;
     var thenum = button_id.replace( /^\D+/g, '');
     var which = button_id.replace(/[^a-zA-Z]+/g, '');

       if(which == "up"){
                $('#'+button_id).removeClass('btn btn-success').addClass('btn btn-default');
                 vote_num("sub", thenum);
                }
               if(which == "down" ){
               $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
                vote_num("add", thenum); 
               }
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
               
            }
          },
        });
    });
    function vote_num(type, id) {
      var computerScore,number = 0;
    var computerScore = document.getElementById("vote-"+id);
    var number = computerScore.innerHTML;
      if(type == "add"){
    number = parseInt(number) + 1;
    computerScore.innerHTML = number;
  }
    if(type == "sub"){
        number = parseInt(number) -1;
    computerScore.innerHTML = number;
}
 if(type == "addbytwo"){
   number = parseInt(number) + 2;
    computerScore.innerHTML = number;
  }

  if(type == "subbytwo"){
       number = parseInt(number) - 2;
    computerScore.innerHTML = number;
  }
}});