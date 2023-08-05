$(document).ready(function() {
    load_comment();

    function load_comment() {

        var action = 'fetch';

        $.ajax({
            url: 'action/fetch_comment.php',
            method: "POST",
            data: {
                action: action
            },
            success: function(response) {
                $('#display_comment').html(response);
            }
        })
    }

   
});