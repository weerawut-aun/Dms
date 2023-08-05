$(document).ready(function () {
    
    load_data_repon();

    function load_data_repon() {
        var action = 'fetch';

        $.ajax({
            url: 'info/action_repon.php',
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#data_repon').html(data);
            }
        });
    }

    $('#frm_new_repon').on('submit', function (event) {
        event.preventDefault();
        var irn_repon = $('#irn_repon').val();
        var action = 'insert_data';
        // console.log(irn_repon);
        if (irn_repon == '') {
            alert('กรุณากรอกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "info/action_repon.php",
                method: "POST",
                data: {
                    irn_repon: irn_repon,
                    action:action
                },
                success: function (data) {
                    $('#frm_new_repon')[0].reset();
                    $('#modal-newirn').modal('hide');
                    $('#message_repon').html(data);
                    load_data_repon();
                }
            });
        }
    });

    $(document).on('click', '.list_irn', function () {
        var action = 'fetch_modal';

        $.ajax({
            url: 'info/action_repon.php',
            method: "POST",
            data: {
                action: action
            },
            success: function (data) {
                $('#repon-reloaded').html(data);
            }
        });
    });
});