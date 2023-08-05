$(document).ready(function () {
    
    $('#cPassword').on('keyup', function() {
        if ($('#new_Password').val() == $('#cPassword').val()) {

            $('#ErrorPwd').html('รหัสผ่านตรงกัน').css('color', 'green');

        } else {
            $('#ErrorPwd').html('**รหัสผ่านไม่ตรงกัน').css('color', 'red');
        }
    });

    $('#frm_change_password').on('submit', function(event) {
        event.preventDefault();

        var old_password = $('#old_password').val();
        var new_Password = $('#new_Password').val()
        var cPassword = $('#cPassword').val()
        var action = 'change_usrpassword';

        if (old_password == false) {
            $('#f_password').html("กรุณากรอกรหัสผ่านเก่า").css('color', 'red');
        }
        if (new_Password == false) {
            $('#fn_password').html("กรุณากรอกรหัสผ่านใหม่").css('color', 'red');
        }
        if (cPassword == false) {
            $('#ErrorPwd').html("กรุณากรอกรหัสผ่านยืนยัน").css('color', 'red');
        } else {
            $.ajax({
                url: '../backend//user/action/action.php',
                method: 'POST',
                data: {
                    old_password: old_password,
                    new_Password: new_Password,
                    cPassword: cPassword,
                    action:action
                },
                success: function(data) {
                    // console.log(data);
                    $('#ErrorPwd').hide();
                    $('#show_data').html(data);
                    $('#frm_change_password')[0].reset();
                }

            });
        }
    });

    $('#confirm_password').on('keyup', function() {
        if ($('#new_password').val() == $('#confirm_password').val()) {

            $('#ErrorPwd').html('รหัสผ่านตรงกัน').css('color', 'green');

        } else {
            $('#ErrorPwd').html('**รหัสผ่านไม่ตรงกัน').css('color', 'red');
        }
    });

    $('#frm_insert_data').on('submit', function(event) {
        event.preventDefault();
      
        var usr_prefix = $('#usr_prefix').val();
        var usr_firstname = $('#usr_firstname').val();
        var usr_lastname = $('#usr_lastname').val();
        var usr_password = $('#usr_password').val();
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        var action = 'insert_data';

        if (usr_prefix == false || usr_firstname == false || usr_lastname == false ||
            usr_password == false || new_password == false || new_password == false ||
            confirm_password == false) {
            alert('กรุณากรอกข้อมูลให้ครบ');
        } else {
          if(new_password !== confirm_password){
            alert('รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน');
          } else {
            $.ajax({
                url: "action/action.php",
                method: "POST",
                data:{
                    usr_prefix:usr_prefix,
                    usr_firstname:usr_firstname,
                    usr_lastname:usr_lastname,
                    usr_password:usr_password,
                    new_password:new_password,
                    confirm_password:confirm_password,
                    action:action
                },
                success:function(data){
                    $('#ErrorPwd').hide();
                    $('#show_data').html(data);
                    $('#frm_insert_data')[0].reset();
                }
            });
          }
        }
     

    });

});