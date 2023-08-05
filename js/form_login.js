$(document).ready(function () {

    $('#frm_login').on('submit', function (event) {
        event.preventDefault();
        var msg = "";
        if ($('#log_username').val() == "" || $('#log_password').val() == "") {
            msg = "กรอกชื่อผู้ใช้งานหรือรหัสผ่านให้ครบ";
            // $('#display_login').html(msg).css('color', 'red');
            alert(msg);

        } else {
            $.ajax({
                url: 'checkUser.php',
                method: 'POST',
                data: {
                    usr_username: $('#log_username').val(),
                    usr_password: $('#log_password').val()
                },
                success: function (data) {
                   
                    // console.log(data);
                    if (data == 'success') {
                        window.location.replace("./../backend/home.php");
                    }
                   
                    if (data == 'unsuccess') {
                        alert("ผู้ใช้งานนี้ ถูกปิดการใช้งานชั่วคราว!");
                        // msg = 'ผู้ใช้งาน ปิดการใช้งานชั่วคราว!';
                        // $('#error').html('<div class="alert alert-danger" role="alert">'+msg+'</div>');
                    }
                    if (data == 'Invalid username and password') {
                        // alert('ชื่อผู้ใช้งานและรหัสผ่านไม่ถูกต้อง กรุณากลับเข้าระบบใหม่อีกครั้ง!');
                        msg = 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณากลับเข้าระบบใหม่อีกครั้ง!';

                        $('#error').html('<div class="alert alert-danger" role="alert">' + msg + '</div>');
                    }
                    if (data == 'Password is incorrect') {

                        // alert('รหัสผ่านไม่ถูกต้อง กรุณากลับเข้าระบบใหม่อีกครั้ง!');
                        msg = 'รหัสผ่านไม่ถูกต้อง กรุณากลับเข้าระบบใหม่อีกครั้ง!';
                        $('#error').html('<div class="alert alert-danger" role="alert">' + msg + '</div>');

                    }

                    $('#frm_login')[0].reset();
                    // $('#display_login').show();
                    // $('#display_login').html(msg);
                }
            });
        }


    });


});