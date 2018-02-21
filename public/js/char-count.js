$(document).ready(function() {
    var text_max = 1000;
    $('#textarea_feedback').html(text_max + ' characters remaining');

    $('#desc').keyup(function() {
    	var myString = $('#desc').val().length;
        var text_length = myString;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_remaining + ' characters remaining');
    });

    function htmlEncode(html){
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
 return txt.value;
}


    $('#desc').keyup(function(event) {
  newText = event.target.value;
var urlEncode  = htmlEncode(newText);
  var text1 = urlEncode.replace(/</g, "&lt;").replace(/>/g, "&gt;");
   var text2 =  text1.replace(/&lt;code&gt;/g, "<code>").replace(/&lt;\/code&gt;/g, "</code>")
                     .replace(/&lt;pre&gt;/g, "<pre>").replace(/&lt;\/pre&gt;/g, "</pre>").replace("&lt;br /&gt;", "<br />");
  $('.live_desc').html(text2).text();
});  


        $('#word').keyup(function(event) {
  newText = event.target.value;
  $('.live_word_title').html(newText).text();
});

});