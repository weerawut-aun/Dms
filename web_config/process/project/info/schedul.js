$(document).ready(function () {
    
    load_data_schedul();

    function load_data_schedul() {
        var action = 'fetch';

        $.ajax({
            url: 'info/action_schedul.php',
            method: "POST",
            data: {
                action:action  
            },
            success: function (data) {
                $('#data_schedule').html(data);
            }
        });
    }

    $('#frm_new_schedule').on('submit', function (event) {
        event.preventDefault();
        var ise_schedule = $('#ise_schedule').val();
        var action = 'insert_data';
        // console.log(ipe_place);
        if (ise_schedule == false) {
            alert('กรุณากรอกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "info/action_schedul.php",
                method: "POST",
                data: {
                    ise_schedule: ise_schedule,
                    action:action
                },
                success: function (data) {
                    $('#frm_new_schedule')[0].reset();
                    $('#modal-newise').modal('hide');
                    $('#message_schedul').html(data);
                    load_data_schedul();
                }
            });
        }
    });

    $(document).on('click', '.list_ise', function () {
        var action = 'fetch_modal';

        $.ajax({
            url: 'info/action_schedul.php',
            method: "POST",
            data: {
                action: action
            },
            success: function (data) {
                $('#schedul-reloaded').html(data);
            }
        });
    });
});