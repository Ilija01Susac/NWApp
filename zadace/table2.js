$(document).ready(function(){
    $('td').click( function() {
        alert($(this).parent().text());
    });


});