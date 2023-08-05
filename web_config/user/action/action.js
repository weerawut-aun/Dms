// $(document).ready(function () {

//     $('#c_password').on('keyup', function () {
//         if ($('#password').val() == $('#c_password').val()) {
//             $('#showPwd').html('รหัสผ่านตรง').css('color', 'green');
//         } else {
//             $('#showPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
//         }
//     });

//     $('#frm_edit').on('submit', function () {
//         var username = $('#username').val();
//         var password = $('#password').val();
//         var c_password = $('#c_password').val();

//         console.log(username);

//         // if (username == false || password == false || c_password == false) {
//         //     alert('กรุณากรอกข้อมูลให้ครบ ก่อนทำรายการ');
//         // } else {
//         //     $.ajax({
//         //         url: "action/edit_user.php",
//         //         method: "POST",
//         //         data: {
//         //             username: username,
//         //             password: password,
//         //             c_password:c_password
//         //         },
//         //         success: function (data) {
//         //             alert(data);
//         //             // $('#frm_edit')[0].reset();
//         //             // $('#showPwd').hide();
//         //             // $('#message').html(data);
//         //         }
//         //     });
//         // }
//     });
// });