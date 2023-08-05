$(document).ready(function () {
    
    load_data_projecttype();

    function load_data_projecttype() {
        var action = 'fetch';

        $.ajax({
            url: 'info/action_projecttpye.php',
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#data_projecttpye').html(data);
            }
        });
    }

    $('#frm_new_ipt').on('submit', function (event) {
        event.preventDefault();
        var ipt_pty = [];
        var action = 'insert_data';
        $('.get_value').each(function () {
            if ($(this).is(":checked")) {
                ipt_pty.push($(this).val());
            }
        });
        ipt_pty = ipt_pty.toString();
        if (ipt_pty == false) {
            alert('กรุณาเลือกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "info/action_projecttpye.php",
                method: "POST",
                data: {
                    ipt_pty: ipt_pty,
                    action:action
                },
                success: function (data) {
                    $('#frm_new_ipt')[0].reset();
                    $('#modal-newipt').modal('hide');
                    $('#message_projecttpye').html(data);
                    load_data_projecttype();
                }
            });
        }
    });

    $(document).on('click', '.list_ipt', function () {
        var action = 'fetch_modal';

        $.ajax({
            url: 'info/action_projecttpye.php',
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#projecttype-reloaded').html(data);
            }
        });
    });

});