$(document).ready(function() {
  (function($) {
// jQuery on an empty object, we are going to use this as our Queue
var ajaxQueue = $({});

$.ajaxQueue = function( ajaxOpts ) {
    var jqXHR,
        dfd = $.Deferred(),
        promise = dfd.promise();

    // queue our ajax request
    ajaxQueue.queue( doRequest );

    // add the abort method
    promise.abort = function( statusText ) {

        // proxy abort to the jqXHR if it is active
        if ( jqXHR ) {
            return jqXHR.abort( statusText );
        }

        // if there wasn't already a jqXHR we need to remove from queue
        var queue = ajaxQueue.queue(),
            index = $.inArray( doRequest, queue );

        if ( index > -1 ) {
            queue.splice( index, 1 );
        }

        // and then reject the deferred
        dfd.rejectWith( ajaxOpts.context || ajaxOpts,
            [ promise, statusText, "" ] );

        return promise;
    };

    // run the actual query
    function doRequest( next ) {
        jqXHR = $.ajax( ajaxOpts )
            .then( next, next )
            .done( dfd.resolve )
            .fail( dfd.reject );
    }

    return promise;
};
})(jQuery);

   $(".vote").on('click', ".btn-default", function() {
     button_id =  this.id;
  var thenum = button_id.replace( /^\D+/g, '');
  var which = button_id.replace(/[^a-zA-Z]+/g, '');
   $('#up-'+thenum).attr('disabled','disabled');
   $('#down-'+thenum).attr('disabled','disabled');
   if(which == "up"){
                      check = ($('#down-'+thenum).hasClass("btn btn-success"));
                $('#'+button_id).removeClass('btn btn-default').addClass('btn btn-success');
              $('#down-'+thenum).removeClass('btn btn-success').addClass('btn btn-default');
               
               if(check == true){
               vote_num("addbytwo",thenum);
                }
                if(check == false){
                   vote_num("add",thenum);
                }}
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
        $.ajaxQueue({
            type: 'post',
            url: '/voteword',
            
            data: {
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