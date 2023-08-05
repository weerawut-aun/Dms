   $(document).ready(function () {

       load_place();

       function load_place() {
           var action = 'fetch';

           $.ajax({
               url: "../backend/setting/place/action/action.php",
               method: "POST",
               data: {
                   action: action
               },
               success: function (data) {
                   $('#place_liest').html(data);
                   $("#tb_place").DataTable();
               }
           });
       }

       $('#frm_insert_pla').on('submit', function (event) {
           event.preventDefault();

           var pla_name = $('#pla_name').val();
           var action = 'insert_data';
           if (pla_name == false) {
               alert('กรอกข้อมูลก่อนทำรายการ');
           } else {
               $.ajax({
                   url: '../backend/setting/place/action/action.php',
                   method: "POST",
                   data: {
                       pla_name: pla_name,
                       action:action
                   },
                   success: function (data) {
                       // console.log(data);
                       $('#frm_insert_pla')[0].reset();
                       $('#modal_insert_pla').modal('hide');
                       $('#message_place_list').html(data);
                       load_place()
                   }
               });
           }
       });


       $(document).on('click', '.edit', function () {

           var pla_id = $(this).data('pla_id');
           var pla_show = $(this).data('pla_show');
           var action = 'change_status_on';
           $('#message_place_list').html('');
           if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนรายการสถานที่?")) {
               $.ajax({
                   url: '../backend/setting/place/action/action.php',
                   method: "POST",
                   data: {
                       pla_id: pla_id,
                       pla_show: pla_show,
                       action: action
                   },
                   success: function (data) {
                       load_place();
                       $('#message_place_list').html(data);
                   }
               });
           } else {
               return false;
           }

       });

       $(document).on('click', '.delect', function () {

           var pla_id = $(this).data('pla_id');
           var pla_show = $(this).data('pla_show');
           var action = 'change_status_off';
           $('#message_place_list').html('');
           if (confirm("คุณแน่ใจหรือว่าจะเปลี่ยนรายการสถานที่?")) {
               $.ajax({
                   url: '../backend/setting/place/action/action.php',
                   method: "POST",
                   data: {
                       pla_id: pla_id,
                       pla_show: pla_show,
                       action: action
                   },
                   success: function (data) {
                       load_place();
                       $('#message_place_list').html(data);
                   }
               });
           } else {
               return false;
           }

       });
   });