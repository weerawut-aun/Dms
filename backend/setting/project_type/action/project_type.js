$(document).ready(function() {

    load_project_type();

    function load_project_type() {

        var action = 'fetch';

        $.ajax({
            url: "../backend/setting/project_type/action/action.php",
            method: "POST",
            data: {
                action: action
            },
            success: function(data) {
                $('#project_type_list').html(data);
                $("#tb_project_type").DataTable();
            }
        });
    }

    $('#insert_form_pty').on('submit', function(event) {
        event.preventDefault();
        var pty_type = $('#pty_type').val();
        var action = 'insert_data';
        if (pty_type == '') {
            alert("กรุณากรอกข้อมูล ก่อนทำรายการ");
        } else {
            $.ajax({
                url: "../backend/setting/project_type/action/action.php",
                method: "POST",
                data: {
                    pty_type: pty_type,
                    action: action
                },
                success: function(data) {
                    // alert(data);
                    $('#insert_form_pty')[0].reset();
                    $('#add_data_Modal').modal('hide');
                    $('#message_project_type').html(data);
                    load_project_type();
                }
            });
        }
    });


    $(document).on('click', '.edit', function() {

        var pty_id = $(this).data('pty_id');
        var pty_show = $(this).data('pty_show');
        var action = 'change_status_on';
        $('#message_project_type').html('');
        if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนประเภทโครงการ?")) {

            $.ajax({
                url: '../backend/setting/project_type/action/action.php',
                method: "POST",
                data: {
                    pty_id: pty_id,
                    pty_show: pty_show,
                    action: action
                },
                success: function(data) {
                    load_project_type();
                    $('#message_project_type').html(data);

                }
            });
        } else {
            return false;
        }
    });

    $(document).on('click', '.delect', function() {

        var pty_id = $(this).data('pty_id');
        var pty_show = $(this).data('pty_show');
        var action = 'change_status_off';
        $('#message_project_type').html('');
        if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนประเภทโครงการ?")) {

            $.ajax({
                url: '../backend/setting/project_type/action/action.php',
                method: "POST",
                data: {
                    pty_id: pty_id,
                    pty_show: pty_show,
                    action: action
                },
                success: function(data) {
                    load_project_type();
                    $('#message_project_type').html(data);

                }
            });
        } else {
            return false;
        }
    });
});