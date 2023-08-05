$(document).ready(function () {

    $('#c_password').on('keyup', function () {
        if ($('#usr_password').val() == $('#c_password').val()) {
            $('#showErrorcPwd').html('รหัสผ่านตรง').css('color', 'green');
        } else {
            $('#showErrorcPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
        }
    });
    $('#frm_insert_admin').on('submit', function (event) {
        event.preventDefault();
        var usr_username = $('#usr_username').val();
        var usr_password = $('#usr_password').val();
        var c_password = $('#c_password').val();
        var fct_id = $('#fct_id').val();

        if (usr_username == '' || usr_password == '' || c_password == '') {
            alert("กรุณากรอกข้อมูลให้เรียบร้อย");
        } else {
            $.ajax({
                url: "action/insert_admin.php",
                method: "POST",
                data: {
                    usr_username: usr_username,
                    usr_password: usr_password,
                    c_password: c_password,
                    fct_id: fct_id

                },
                success: function (data) {
                    $('#frm_insert_admin')[0].reset();
                    $('#showErrorcPwd').hide();
                    $('#success').html(data);
                }
            });
        }
    });
   // $('#captch_form').on('submit', function(event) {
    //     event.preventDefault();
    //     if ($('#captcha_code').val() == '') {
    //         alert('กรุณากรอกข้อมูลให้ครบ');
    //         $('#edit').attr('disabled', 'disabled');
    //         return false;
    //     } else {
    //         // alert('Form has been validate with Captcha Code');
    //         $('#captch_form')[0].reset();
    //         $('#captcha_image').attr('src', 'image.php');
    //     }
    // });

    
    $('#frm_edit_admin').on('submit', function (event) {
        event.preventDefault();

        var usr_username = $('#usr_username').val();
        var usr_password = $('#usr_password').val();
        var c_password = $('#c_password').val();
        var code = $('#captcha_code').val();
        if (usr_username == '' || usr_password == '' || c_password == '' || code == '') {
            alert('กรุณากรอกข้อมูลให้ครบ');
            $('#edit').attr('disabled', 'disabled');
            return false;
        } else {
            $.ajax({
                url: "action/edit_admin.php",
                method: "POST",
                data: {
                    usr_username: usr_username,
                    usr_password: usr_password,
                    c_password: c_password,
                    code: code
                   
                },
                success: function (data) {
                    $('#edit_admin').html(data);
                   
                    $('#showErrorcPwd').hide();
                    $('#frm_edit_admin')[0].reset();
                    // $('#edit_admin').val(data);
                    $('#captcha_image').attr('src', 'image.php');
                }
            });

        }
    });
 
  

    $('#captcha_code').on('blur', function () {
      
        var code = $('#captcha_code').val();
        // console.log(code);
        if (code == '') {

            alert('กรุณากรอกข้อมูลให้ครบ');
            $('#edit').attr('disabled', 'disabled');

        } else {
            //  console.log(code);
            $.ajax({
                url: "action/check_code.php",
                method: "POST",
                data: {
                    code: code
                },
                success: function (data) {
                    //   console.log(data);
                    if (data == 'success') {
                        $('#edit').attr('disabled', false);
                    } else {
                        $('#edit').attr('disabled', 'disabled');
                        alert('ใส่code ให้ถูกต้อง');
                        
                    }
                }
            });
            // console.log(code);
        }
    });


    // $('#edit').click(function() {

    //     var usr_username = $('#usr_username').val();
    //     // console.log(usr_username);
    //     var usr_password = $('#usr_password').val();
    //     // console.log(usr_password);
    //     var fct_id = $('#fct_id').val();
    //     // console.log(fct_id);
    //     $.ajax({
    //         url: "edit_admin.php",
    //         method: "POST",
    //         data: {
    //             usr_username: usr_username,
    //             usr_password: usr_password,
    //             fct_id: fct_id
    //         },
    //         success: function(data) {
    //             // console.log(data);
    //             if (data == 'Successfullty') {
    //                 alert('ทำการแก้ไขข้อมูลผู้ดูระบบ เรียบร้อย');
    //                 location.reload(true);
    //                 $('#usr_username').val(data.usr_username);
    //                 // $('#usr_password').val(data.usr_password);
    //                 $('#fct_id').val(data.fct_id);

    //             } else {
    //                 alert('ล้มเหลว โปรดลองใหม่อีกครั้ง');
    //             }
    //         }
    //     });
    // });

});