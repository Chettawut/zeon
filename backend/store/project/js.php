<script type="text/javascript">
$(function() {

    $("#sideStore").show()
    
    $.ajax({
        type: "POST",
        url: "ajax/get_project.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.projectcode.length; count++) {

                let status
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'
                $('#tableProject').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .projectcode[
                        count] + '" data-whatever="' + result.projectcode[
                        count] + '"><td>' + result.projectcode[count] + '</td><td>' + result.projectname[count] + '</td><td  style="text-align:center">' + status + '</td></tr>');
            }

            var table = $('#tableProject').DataTable({
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
        url: "ajax/getsup_project.php",
        data: "idcode=" + recipient,
        success: function(result) {            
            modal.find('.modal-body #projectcode').val(result.projectcode);
            modal.find('.modal-body #projectname').val(result.projectname);
            modal.find('.modal-body #status').val(result.status);
            

        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มวัสดุ
$("#frmAddProject").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_project.php",
        data: $("#frmAddProject").serialize(),
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

$("#frmEditProject").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_project.php",
        data: $("#frmEditProject").serialize(),
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