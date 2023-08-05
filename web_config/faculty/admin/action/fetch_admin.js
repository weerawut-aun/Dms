$(document).ready(function () {

    load_user();

    function load_user() {
        var action = 'fetch';
        $.ajax({
            url: "action/action_admin.php",
            method: "POST",
            data: {
                action:action
            },
            success: function (data) {
                $('#list_member').html(data);
                $("#table_usr").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            }
        });
    }

    $(document).on('click', '.on', function () {

        var usr_id = $(this).data('usr_id');
        var usr_show = $(this).data('usr_show');
        var action = 'change_status_on';
        $('#message_admin').html('');
        if (confirm("คุณแน่ใจหรือว่าจะสถานะผู้ดูและระบบ?")) {
            $.ajax({
                url: 'action/action_admin.php',
                method: "POST",
                data: {
                    usr_id: usr_id,
                    usr_show: usr_show,
                    action:action
                },
                success: function (data) {
                    load_user();
                    $('#message_admin').html(data);
                }
            });
        } else {    
            return false;
        }
    });

    $(document).on('click', '.off', function () {

        var usr_id = $(this).data('usr_id');
        var usr_show = $(this).data('usr_show');
        var action = 'change_status_off';
        $('#message_admin').html('');
        if (confirm("คุณแน่ใจหรือว่าจะสถานะผู้ดูและระบบ?")) {
            $.ajax({
                url: 'action/action_admin.php',
                method: "POST",
                data: {
                    usr_id: usr_id,
                    usr_show: usr_show,
                    action:action
                },
                success: function (data) {
                    load_user();
                    $('#message_admin').html(data);
                }
            });
        } else {    
            return false;
        }

    });

    // $('#c_password').keyup(function () {
    //     var usr_password = $('#usr_password').val();
    //     var c_password = $('#c_password').val();

    //     if (c_password != usr_password) {
    //         $('#showErrorcPwd').html('**Password are not matching');
    //         $('#showErrorcPwd').css('color', 'red');
    //         return false;
    //     } else {
    //         $('#showErrorcPwd').html('Matcing');
    //         $('#showErrorcPwd').css('color', 'green');
    //         return true;
    //     }
    // });

});