"use strict"

$(document).ready( function(){

    $('#search-books').on('submit', function (event){

        event.preventDefault();

        var formData = $('#search-books').serializeArray();

        $.ajax({
            type: 'GET',
            url: '/pages/tasks/handler2.php',
            data: { searchType: formData [0]["value"]},
            success: function(html)
            {
                $("#popa").html(html);
            }
        });
    });

});
