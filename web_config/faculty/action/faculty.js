$(document).ready(function () {
    load_faculty();

    function load_faculty() {
        var action = 'fetch';
        $.ajax({
            url: "action/fetch_faculty.php",
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#list_faculty').html(data);
                $("#table_faculty").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            }
        });
    }
});