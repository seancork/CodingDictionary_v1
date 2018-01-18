 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>   
$(document).ready(function() {
$(function() {
  $('#search_text').typeahead({
    source: function(request, response) {
      $.ajax({
        url: 'autocomplete-ajax',
        type: 'GET',
        dataType: 'JSON',
        data: 'query=' + request,
        success: function(data) {
          response($.map(data, function(item) {
            return {
                url: item.url,
                value: item.name
            }
          }))
        }
      })
    },
    displayText: function(item) {
        return item.value
    },
    select: function( event, ui ) {
      window.location.href = ui.item.url;
    }
  });
});
});