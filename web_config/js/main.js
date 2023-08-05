$(document).ready(function() {
    $('.logout').click(function() {
        alert('ยืนยันการออกจากระบบ');
    });
    
    $('#captcha_code').on('blur', function () {
      
        var code = $('#captcha_code').val();
        // console.log(code);
        if (code == '') {

            alert('กรุณากรอกข้อมูลให้ครบ');
            $('#edit').attr('disabled', 'disabled');

        } else {
          
            $.ajax({
                url: "../../action/check_code.php",
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

});
