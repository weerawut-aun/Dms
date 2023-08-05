$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(document).ready(function () {



    // $('.datepicker').datepicker({
    //     format: 'dd/mm/yyyy',
    //     todayBtn: true,
    //     language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    //     thaiyear: true              //Set เป็นปี พ.ศ.
    // }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true //Set เป็นปี พ.ศ.
    }).datepicker();

});





$(document).ready(function () {


    $('#uploadForminv').submit(function (event) {

        if ($('#inv_filename').val()) {

            event.preventDefault();
            // $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    // $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์ก่อนกดเพิ่มไฟล์หนังสือเชิญ');
        }

        return false;



    });

});
$(document).ready(function () {
    $('#uploadFormsign').submit(function (event) {
        if ($('#sig_filename').val()) {

            event.preventDefault();
            // $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    // $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์ก่อนกดเพิ่มไฟล์ใบเซ็นชื่อ');
        }

        return false;

    });
});

$(document).ready(function () {
    $('#uploadFormmin').submit(function (event) {

        if ($('#min_filename').val()) {

            event.preventDefault();
            // $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    // $('#loader-icon').hide();
                    $('#targetLayer').show();
                  
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์ก่อนกดเพิ่มไฟล์');
        }

        return false;

    });
});




$(document).ready(function () {

    $('#frm_insert_type').on('submit', function (event) {
        event.preventDefault();
        if ($('input#pty_type-1').val() == false) {
            alert("กรุณากรอกข้อมูล");
        } else {

            $.ajax({
                url: "./../setting/insert_pty2.php",
                method: "POST",
                data: $('#frm_insert_type').serialize(),
                success: function (data) {
                    $('#frm_insert_type')[0].reset();
                    $('#modal-pty').modal('hide');
                    $('#list_pty').html(data);
                    $('#list_pty').load();
                }
            });
        }
    });




    $('#modal_insert_rpt').on('submit', function (event) {
        event.preventDefault();
        if ($('#rpt_modal').val() == false) {
            alert("กรุณากรอกข้อมูล");
        } else {
            //  alert("ข้อมูล");
            $.ajax({
                url: './../setting/insert_rpt2.php',
                method: "POST",
                data: $('#modal_insert_rpt').serialize(),
                success: function (data) {
                    $('#modal_insert_rpt')[0].reset();
                    $('#modal-rpt').modal('hide');
                    $('#select_person').html(data);

                }
            });
        }
    });


    $('#frm_add_details').on('submit', function (event) {
        event.preventDefault();

        var iof_object = $('#iof_object').val();
        var ipt_pty = [];
        var ise_schedule = $('#ise_schedule').val();
        var ipe_place = $('#ipe_place').val();
        var irn_repon = $('#irn_repon').val();


        $('.get_value').each(function () {
            if ($(this).is(":checked")) {
                ipt_pty.push($(this).val());
            }
        });
        ipt_pty = ipt_pty.toString();
        if (iof_object == '' || ipt_pty == '' || ise_schedule == '' ||
            ipe_place == '' || irn_repon == '') {
            alert('กรุณากรอกข้อมูลให้ครบ');
        } else {
            // alert('ครบ');
            $.ajax({
                url: 'add_info.php',
                method: "POST",
                data: {
                    iof_object: iof_object,
                    ipt_pty: ipt_pty,
                    ise_schedule: ise_schedule,
                    ipe_place: ipe_place,
                    irn_repon: irn_repon

                },
                success: function (reponse) {
                    $('#frm_add_details')[0].reset();
                    $('#frm_info').html(reponse);
                }
            });

        }
    
    });

});


$(document).ready(function () {
    $('#uploadFormdoc').submit(function (event) {
        if ($('#doc_filename').val()) {
            event.preventDefault();
            // $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    // $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์ก่อนกดบันทึก');
        }

        return false;

    });
});



$(document).ready(function () {

    $('#comment_form').on('submit', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        //    console.log(form_data);
        $.ajax({
            url: "../backend/agenda/add_comment.php",
            method: "POST",
            data: form_data,
            dataType: "JSON",
            success: function (response) {
                if (response.error != '') {
                    $('#comment_form')[0].reset();
                    $('#comment_message').html(response.error);
                    $('#comment_id').val('0');

                }
                // console.log(response);
            }
        })
    });
    // load_comment();



});


$(document).ready(function () {
    $('#usr_id1').click(function () {
        alert('กรุณากรอกรหัสผ่านของท่าน');
       
    });

    $('#chcek_agenda').on('submit', function (event) {
        event.preventDefault();
        var usr_password = $('#password_agd').val();

        if (usr_password == false) {
            alert('กรอกรหัสผ่านผู้อนุมัติ');
        } else {
            $.ajax({
                url: '../agenda/check_status.php',
                method: "POST",
                data: {
                    usr_password:usr_password
                },
                success: function (data) {
                    $('#error_password').html(data);
                    // console.log(data);
                }
            });
        }
    });
});

$(document).ready(function () {
    $('#frm_project').on('submit', function (event) {
        event.preventDefault();
        var pro_name = $('#pro_name').val();
        if (pro_name == false) {
            alert('กรุณากรอกข้อมูลก่อนทำรายการ');
        } else {
            
                $.ajax({
                    url: '../project/add_project.php',
                    method: "POST",
                    data: {
                        pro_name:pro_name
                    },
                    success: function (data) {
                        $('#error_pro').html(data);
                    }
                });
            
        }
    });
});

$(document).ready(function () {
    $('#reload_page').click(function () {
        location.reload();
    });
});

// uloaded write file
$(document).ready(function () {
    $('#uploadFormwpt').submit(function (event) {

        if ($('#wpt_filename').val()) {

            event.preventDefault();
           
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                  
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});
// uploaded approvel file
$(document).ready(function () {
    $('#uploadFormalt').submit(function (event) {

        if ($('#alt_filename').val()) {

            event.preventDefault();
           
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                   
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

// uploaded appoint file
$(document).ready(function () {
    $('#uploadFormapt').submit(function (event) {

        if ($('#apt_filename').val()) {

            event.preventDefault();
          
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                  
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

// uploaded attendtees
$(document).ready(function () {
    $('#uploadFormlat').submit(function (event) {

        if ($('#lat_filename').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

// uploaded othre
$(document).ready(function () {
    $('#uploadFormoth').submit(function (event) {

        if ($('#oth_filename').val()) {

            event.preventDefault();
           
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                   
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

// jquery uploaded image
$(document).ready(function () {

    $('#uploadIamge').submit(function (event) {

        if ($('#img_name').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function (reponse) {

                    if (reponse == 'error') {
                        $('#uploadIamge')[0].reset();
                        alert('นามสกุลรูปภาพไม่ตรงกับกำหนด');
                    } else {
                       
                        $('#loader-icon').hide();
                        $('#targetLayer').show();
                    }

                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;
    });
});

// uploaded project_book
$(document).ready(function () {
    $('#uploadFormpbk').submit(function (event) {

        if ($('#pbk_filename').val()) {

            event.preventDefault();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                   
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

// uploaded complete_letter
$(document).ready(function () {
    $('#uploadFormclt').submit(function (event) {

        if ($('#clt_filename').val()) {

            event.preventDefault();
           
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                   
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

// uploaded document other
$(document).ready(function () {
    $('#uploadFormdon').submit(function (event) {

        if ($('#don_filename').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

$(document).ready(function () {
    $('#chk_project_successfully').click(function () {
        return confirm('กรุณากรอกรหัสผ่านของคุณ');
    });
    $('#chk_project_cancel').click(function () {
        return confirm('กรุณากรอกรหัสผ่านของคุณ');
    });
});

$(document).ready(function () {
    $("#pop").on("click", function () {
        $('#imagepreview').attr('src', $('#imageresource').attr('src'));
        $('#imagemodal').modal('show');
    });
});


$(document).ready(function () {
    $('#uploadFormils').submit(function (event) {

        if ($('#ils_filename').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

$(document).ready(function () {
    $('#uploadFormmss').submit(function (event) {

        if ($('#mss_filename').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});
$(document).ready(function () {
    $('#uploadFormrms').submit(function (event) {

        if ($('#rms_filename').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

$(document).ready(function () {
    $('#uploadFormrpd').submit(function (event) {

        if ($('#rpd_filename').val()) {

            event.preventDefault();
            $('#loader-icon').show();
            $('#targetLayer').hide();
            $(this).ajaxSubmit({
                target: '#targetLayer',
                beforeSubmit: function () {
                    $('.progress-bar').width('50%');
                },
                uploadProgress: function (event, postion, total,
                    percnetageComplete) {
                    $('.progress-bar').animate({
                        width: percnetageComplete + '%'
                    }, {
                        duration: 1000

                    });
                },
                success: function () {
                    $('#loader-icon').hide();
                    $('#targetLayer').show();
                },
                resetForm: true
            });
        } else {
            alert('กรุณาเลือกไฟล์เอกสารก่อนกดบันทึก');
        }

        return false;

    });
});

$(document).ready(function () {
    $('#chk_summary_successfuly').click(function () {
        return confirm('กรุณากรอกรหัสผ่านของคุณ');
    });
});