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

                    console.log("up - default to default")
                      check = ($('#down-'+thenum).hasClass("btn btn-success"));
                      console.log(check);
                $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
              $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
               
               if(check == true){
               vote_num("addbytwo",thenum);
                }
                if(check == false){
                   vote_num("add",thenum);
                }
                }
               if(which == "down" ){
                 check = ($('#up-'+thenum).hasClass("btn btn-success"));
                   console.log("down - default to default")
               $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
               $('#up-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
                 if(check == true){
               vote_num("subbytwo", thenum);
                }
                if(check == false){
                   vote_num("sub",thenum);
                }
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
                  console.log("up - sucess to default")
                $('#'+button_id).removeClass('btn btn-success').addClass('btn btn-default');
                 vote_num("sub", thenum);
                }
               if(which == "down" ){
                console.log("down - sucess to default")
               $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
                vote_num("add", thenum);
            
               }
                }
            },

        });
        $('#name').val('');
});
    function vote_num(type, id) {
    var computerScore = document.getElementById(id);
    var number = computerScore.innerHTML;
      if(type == "add"){
    number = parseInt(number) + 1;
    console.log("add"+number);
    computerScore.innerHTML = number;
  }
    if(type == "sub"){
        number = parseInt(number) -1;
       console.log("sub"+number);
    computerScore.innerHTML = number;
}
 if(type == "addbytwo"){
  console.log("before: addbytwo: "+number);
   number = parseInt(number) + 2;
    console.log("addbytwo: "+number);
    computerScore.innerHTML = number;
  }

  if(type == "subbytwo"){
       number = parseInt(number) - 2;
      console.log("subbytwo: "+number);
    computerScore.innerHTML = number;
  }

}
});