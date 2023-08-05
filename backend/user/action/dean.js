$(document).ready(function () {


    $('#frm_insert_dean').on('submit', function (event) {
        event.preventDefault();
        var usr_username = $('#usr_username').val();
        var usr_password = $('#usr_password').val();
        var confirm_password = $('#confirm_password').val();
        var action = 'insert_dean';
        $('#usernameError').html('');
        $('#passError').html('');
        $('#ErrorPwdDea').html('');


        if (usr_username == false) {
            $('#usernameError').html('* กรุณากรอกชื่อผู้ใช้งาน');
        } else if (usr_password == false) {
            $('#passError').html('* กรุณากรอกรหัสผ่าน');
        } else if (confirm_password == false) {
            $('#ErrorPwdDea').html('* กรุณากรอกยืนยันรหัสผ่าน');
        } else if (usr_password != confirm_password) {
            $('#ErrorPwdDea').html('* กรุณากรอกรหัสผ่านและยืนยันรหัสผ่านให้ตรงกัน');
        } else {
            $.ajax({
                url: '../backend/user/action/action.php',
                method: "POST",
                data: {
                    usr_username: usr_username,
                    usr_password: usr_password,
                    action: action

                },
                success: function (data) {


                    if (data == 'DuplicateUserName') {
                        $('#usernameError').html('* ชื่อผู้ใช้งานนี้ซ้ำ');
                    } else {
                        alert(data);
                        window.location.replace('../user/all_user');
                       
                    }

                }
            });
        }
    });
});