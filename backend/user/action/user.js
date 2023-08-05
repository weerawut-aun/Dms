$(document).ready(function () {
    load_user_data();

    function load_user_data() {
        var action = 'fetch';
        $.ajax({
            url: "../backend/user/action/action.php",
            method: "POST",
            data: {
                action: action
            },
            success: function (data) {

                $('#user_data').html(data);
                $("#table_user").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                });
            }

        });
    }
    // past dean action edit on off activ
    $('#con_password').on('keyup', function () {

        if ($('#new_password').val() == $('#con_password').val()) {
            $('#showErrorPwd').html('รหัสผ่านตรง').css('color', 'green');
        } else {
            $('#showErrorPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
        }
    });

    

    $(document).on('click', '.edit_pwd', function () {
        var usr_id = $(this).attr('data-usr_id_dea');
        $('.modal-body #usr_id_dea').val(usr_id);
    });

    $('#frm_reset_pwd').on('submit', function (event) {
        event.preventDefault();
       
        var usr_id = $('#usr_id_dea').val();
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var con_password = $('#con_password').val();
        var action = 'reset_pwd';

        if (old_password == false || new_password == false || con_password == false) {
            alert('กรุณากรอกข้อมูล ก่อนทำรายการ');
        } else {
            if (confirm('คุณแน่ใจเหรอจะเปลี่ยนรหัสผ่านคณบดี')) {
                $.ajax({
                    url: "../backend/user/action/action.php",
                    method: "POST",
                    data: {
                        usr_id: usr_id,
                        old_password:old_password,
                        new_password: new_password,
                        con_password: con_password,
                        action: action
                    },
                    success: function (data) {
                        $('#frm_reset_pwd')[0].reset();
                        $('#modal_edit_pwd_dea').modal('hide');
                        $('#message').html(data);
                      
                    }
                });
            }
        }
    });


    // past dean

    // past user action edit on off active
    $('#c_pwd').on('keyup', function () {

        if ($('#old_pwd').val() == $('#c_pwd').val()) {
            $('#showPwd').html('รหัสผ่านตรง').css('color', 'green');
        } else {
            $('#showPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
        }
    });



    $(document).on('click', '.edit_pasword', function () {
        var usr_id = $(this).attr('data-usr_id');
        $('.modal-body #usr_id').val(usr_id);
    });

    $('#frm_reset_password').on('submit', function (event) {
        event.preventDefault();
        var usr_id = $('#usr_id').val();
        var old_pwd = $('#old_pwd').val();
        var c_pwd = $('#c_pwd').val();
        var action = 'reset_password';
        if (old_pwd == false || c_pwd == false) {
            alert('กรุณากรอกข้อมูล ก่อนทำรายการ');
        } else {
            $.ajax({
                url: "../backend/user/action/action.php",
                method: "POST",
                data: {
                    usr_id: usr_id,
                    old_pwd: old_pwd,
                    c_pwd: c_pwd,
                    action: action
                },
                success: function (data) {
                    $('#frm_reset_password')[0].reset();
                    $('#modal-edit_password').modal('hide');
                    $('#message').html(data);
                }
            });
        }
    });

    $(document).on('click', '.view_user', function () {
        var usr_id = $(this).data('usr_id');
        var action = 'fetch_data';

        $.ajax({
            url: '../backend/user/action/action.php',
            method: "POST",
            data: {
                usr_id: usr_id,
                action: action
            },
            success: function (data) {
                $('#data_user').html(data);
            }
        });
    });

    $(document).on('click', '.on', function () {
        var usr_id = $(this).data('usr_id');
        var usr_show = $(this).data('usr_show');
        var action = 'status_on';
        $('#message').html("");
        if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนสถานะผู้ใช้งานนี้")) {
            $.ajax({
                url: '../backend/user/action/action.php',
                method: "POST",
                data: {
                    usr_id: usr_id,
                    usr_show: usr_show,
                    action: action
                },
                success: function (data) {
                    load_user_data();
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
                url: '../backend/user/action/action.php',
                method: "POST",
                data: {
                    usr_id: usr_id,
                    usr_show: usr_show,
                    action: action
                },
                success: function (data) {
                    load_user_data();
                    $('#message').html(data);
                }
            });
        }
    });

    // past user action 

    $('#frm_registered').on('submit', function (event) {
        event.preventDefault();

        var usr_username = $('#usr_username').val();
        var usr_password = $('#usr_password').val();
        var cpassword = $('#cpassword').val();
        var prefix = $('#tpf_prefix').val();
        var usr_firstname = $('#usr_firstname').val();
        var usr_lastname = $('#usr_lastname').val();
        var usr_tel = $('#usr_tel').val();
        var usr_email = $('#usr_email').val();
        var usr_permit = $('#usr_permit').val();
        var action = 'insert_user';

        $('#usernameError').html('');
        $('#passError').html('');
        $('#cpassError').html('');
        $('#prefixError').html('');
        $('#firstnameError').html('');
        $('#lastnameError').html('');
        $('#telError').html('');
        $('#emailError').html('');
        $('#permitError').html('');

        if (usr_username == '') {
            $('#usernameError').html('* กรุณากรอกชื่อผู้ใช้งาน');
            return false;
        } else if (usr_password == '') {
            $('#passError').html('* กรุณากรอกรหัสผ่าน');
            return false;
        } else if (cpassword == '') {
            $('#cpassError').html('* กรุณากรอกยืนยันรหัสผ่าน');
            return false;
        } else if (usr_password != cpassword) {
            $('#cpassError').html('* กรุณากรอกรหัสผ่านและยืนยันรหัสผ่านให้ตรงกัน');
            return false;
        } else if (prefix == '') {
            $('#prefixError').html('* กรุณาเลือกคำนำหน้าชื่อ');
            return false;
        } else if (usr_firstname == '') {
            $('#firstnameError').html('* กรุณากรอกชื่อ');
            return false;
        } else if (usr_lastname == '') {
            $('#lastnameError').html('* กรุณากรอกนามสกุล');
            return false;
        } else if (usr_tel == '') {
            $('#telError').html('* กรุณากรอกเบอร์โทรศัพท์');
            return false;
        } else if (isNaN(usr_tel)) {
            $('#telError').html('* กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลข');
            return false;
        } else if (usr_tel.length != 10) {
            $('#telError').html('* กรุณากรอกเบอร์โทรศัพท์ 10 ตัว');
            return false;
        } else if (usr_email == '') {
            $('#emailError').html('* กรุณากรอกอีเมล');
            return false;
        } else if (!validateEmail(usr_email)) {
            $('#emailError').html('* กรุณาตรวจสอบอีเมลใหม่');
            return false;
        } else if (usr_permit == '') {
            $('#permitError').html('* กรุณาเลือกสิทธิ์การใช้งาน');
            return false;
        }
        else {
            $.ajax({
                url: '../backend/user/action/action.php',
                method: 'POST',
                data: {
                    usr_username: usr_username,
                    usr_password: usr_password,
                    cpassword: cpassword,
                    prefix: prefix,
                    usr_firstname: usr_firstname,
                    usr_lastname: usr_lastname,
                    usr_tel: usr_tel,
                    usr_email:usr_email,
                    usr_permit: usr_permit,
                    action: action
                },
                success: function (reponse) {
                    if (reponse == 'username') {
                        $('#usernameError').html('* ชื่อผู้ใช้งานซ้ำ');
                    } else {
                        $('#error_user').html(reponse);
                    }

                   
                }
            });
        }

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
    });
});