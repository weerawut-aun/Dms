$(document).ready(function () {
    load_admin_data();

    function load_admin_data() {
        var action = 'fetch';
        $.ajax({
            url: '../backend/admin/action/action.php',
            method: "POST",
            data: {
                action: action
            },
            success: function (data) {
                $('#all_admin').html(data);
                $('#tabel_admin').DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            }
        });
    }
    $('#c_password').on('keyup', function () {
        if ($('#usr_password').val() == $('#c_password').val()) {
            $('#showErrorPwd').html('รหัสผ่านตรง').css('color', 'green');
        } else {
            $('#showErrorPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
        }
    });

    $(document).on('click', '.edit_pasword', function () {
        var usr_id = $(this).attr('data-usr_id');
        $('.modal-body #usr_id').val(usr_id);
    });

    $('#frm_reset_password').on('submit', function (event) {
        event.preventDefault();
        var usr_id = $('#usr_id').val();
        var usr_password = $('#usr_password').val();
        var c_password = $('#c_password').val();
        var action = 'reset_password';
        if (usr_password == false || c_password == false) {
            alert('กรุณากรอกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "../backend/admin/action/action.php",
                method: "POST",
                data: {
                    usr_id:usr_id,
                    usr_password: usr_password,
                    c_password: c_password,
                    action:action
                },
                success: function (data) {
                    $('#frm_reset_password')[0].reset();
                    $('#modal-edit_password').modal('hide');
                    $('#message').html(data);
                }
            });
        }
    });

    $(document).on('click', '.on', function () {
        var usr_id = $(this).data('usr_id');
        var usr_show = $(this).data('usr_show');
        var action = 'status_on';
        $('#message').html("");
        if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนสถานะผู้ใช้งานนี้")) {
            $.ajax({
                url: '../backend/admin/action/action.php',
                method: "POST",
                data: {
                    usr_id: usr_id,
                    usr_show: usr_show,
                    action:action
                },
                success: function (data) {
                    load_admin_data();
                    $('#message').html(data);
                }
            });
        }
    });

    $(document).on('click', '.off', function () {
        var usr_id = $(this).data('usr_id');
        var usr_show = $(this).data('usr_show');
        var action = 'status_off';
        $('#message').html("");
        if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนสถานะผู้ใช้งานนี้")) {
            $.ajax({
                url: '../backend/admin/action/action.php',
                method: "POST",
                data: {
                    usr_id: usr_id,
                    usr_show: usr_show,
                    action:action
                },
                success: function (data) {
                    load_admin_data();
                    $('#message').html(data);
                }
            });
        }
    });

  

});