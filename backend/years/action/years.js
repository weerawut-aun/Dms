$(document).ready(function() {
    load_years_data();
    function load_years_data() {
        var action = 'fetch';

        $.ajax({
            url: 'action/action.php',
            method: "POST",
            data: {
                action: action
            },
            success: function(data) {
                $('#list_years').html(data);
                $("#tb_years").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            }
        });
    }
});