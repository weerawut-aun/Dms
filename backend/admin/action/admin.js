$(document).ready(function () {
    $('#c_password').on('keyup', function () {
        if ($('#usr_password').val() == $('#c_password').val()) {
            $('#showErrorPwd').html('รหัสผ่านตรง').css('color', 'green');
        } else {
            $('#showErrorPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
        }
    });


        $('#frm_insert_admin').on('submit',function(event){
            event.preventDefault();
            var usr_username = $('#usr_username').val();
            var usr_password = $('#usr_password').val();
            var c_password = $('#c_password').val();

            if(usr_username == false || usr_password == false || c_password == false){
                alert('กรุณากรอกข้อมูลให้ครบ');
            } else {

                $.ajax({
                    url:"action/insert_admin.php",
                    method:"POST",
                    data:{
                        usr_username:usr_username,
                        usr_password:usr_password,
                        c_password:c_password
                    },
                    success:function(data){
                        $('#showErrorPwd').hide();
                        $('#message').html(data);
                    }
                });
            }
        });
});