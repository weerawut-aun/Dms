$(document).ready(function() {
    load_repon_data();

    function load_repon_data() {
        var action = 'fetch';

        $.ajax({
            url: '../backend/setting/respon/action/action.php',
            method: "POST",
            data: {
                action: action
            },
            success: function(data) {
                $('#list_person').html(data);
                $("#tb_repon").DataTable();
            }
        });
    }
    //   เพิ่มรายชื่อผู้รับผิดชอบ
    $('#frm_insert_rpt').on('submit', function(event) {
        event.preventDefault();
        var prefix_repon = $('#prefix_repon').val();
        var rpt_firstname = $('#rpt_firstname').val();
        var rpt_lastname = $('#rpt_lastname').val();
        var action = 'insert_data';
        if (prefix_repon == false || rpt_firstname == false || rpt_lastname == false) {
            alert('กรอกข้อมูลก่อนทำรายการ');
        } else {
            $.ajax({
                url: '../backend/setting/respon/action/action.php',
                method: "POST",
                data: {
                    prefix_repon: prefix_repon,
                    rpt_firstname: rpt_firstname,
                    rpt_lastname: rpt_lastname,
                    action: action
                },
                success: function(data) {
                    $('#frm_insert_rpt')[0].reset();
                    $('#add_data_rpt').modal('hide');
                    $('#message_repon').html(data);
                    load_repon_data();
                }
            });
        }

    });



    $(document).on('click', '.edit', function() {

        var rpt_id = $(this).data('rpt_id');
        var rpt_show = $(this).data('rpt_show');
        var action = 'change_status_on';
        $('#message_repon').html('');
        if (confirm("คุณแน่ใจหรือว่าจะสถานะรายการผู้รับผิดชอบ?")) {
            $.ajax({
                url: '../backend/setting/respon/action/action.php',
                method: "POST",
                data: {
                    rpt_id: rpt_id,
                    rpt_show: rpt_show,
                    action: action
                },
                success: function(data) {
                    load_repon_data();
                    $('#message_repon').html(data);
                }
            });
        } else {
            return false;
        }
    });


    $(document).on('click', '.delect', function() {

        var rpt_id = $(this).data('rpt_id');
        var rpt_show = $(this).data('rpt_show');
        var action = 'change_status_off';
        $('#message_repon').html('');
        if (confirm("คุณแน่ใจหรือว่าจะสถานะรายการผู้รับผิดชอบ?")) {
            $.ajax({
                url: '../backend/setting/respon/action/action.php',
                method: "POST",
                data: {
                    rpt_id: rpt_id,
                    rpt_show: rpt_show,
                    action: action
                },
                success: function(data) {
                    load_repon_data();
                    $('#message_repon').html(data);
                }
            });
        } else {
            return false;
        }
    });
});