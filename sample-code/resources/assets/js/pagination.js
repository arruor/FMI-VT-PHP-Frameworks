$(function() {
    $('.current-page').keyup(function(event){
        if ( event.which == 13 ) {
            event.preventDefault();
            window.location = $(location).attr('pathname') + "?page=" + event.target.value;

        }

    });
});
