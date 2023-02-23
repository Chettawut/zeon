<script type="text/javascript">
$(function() {

    $("#sideStore").show()
    
    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.unitcode.length; count++) {

                let status
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'
                $('#tableUnit').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .unitcode[
                        count] + '" data-whatever="' + result.unitcode[
                        count] + '">.<td>' + result.unit[count] + '</td><td  style="text-align:center">' + status + '</td></tr>');
            }

            var table = $('#tableUnit').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });



        }
    });


})


$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_unit.php",
        data: "idcode=" + recipient,
        success: function(result) {            
            modal.find('.modal-body #unitcode').val(result.unitcode);
            modal.find('.modal-body #unit').val(result.unit);
            modal.find('.modal-body #status').val(result.status);


        }
    });
});

$('#modelEdit').on('hidden.bs.modal', function() {
    $("#frmEditInventory *").prop('disabled', true);
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มวัสดุ
$("#frmAddUnit").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_unit.php",
        data: $("#frmAddUnit").serialize(),
        success: function(result) {
            if (result.status == 1) // Success
            {
                alert(result.message);
                window.location.reload();
                // console.log(result.message);
            } else {
                alert('รหัสซ้ำ');
            }
        }
    });


});

$("#frmEditUnit").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_unit.php",
        data: $("#frmEditUnit").serialize(),
        success: function(result) {

            if (result.status == 1) // Success
            {
                alert(result.message);
                window.location.reload();
                // console.log(result.message);
            }
        }
    });

});
</script>