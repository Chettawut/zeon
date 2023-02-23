<script type="text/javascript">
$(function() {

    $("#sideSales").show()
    
    $.ajax({
        type: "POST",
        url: "ajax/get_customer.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.cuscode.length; count++) {

                let status
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'
                $('#tableCustomer').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .cuscode[
                        count] + '" data-whatever="' + result.cuscode[
                        count] + '"><td>' + result.cuscode[count] + '</td><td>' + result.cusname[count] + '</td><td>' + result.province[count] + '</td><td>' + result.address[count] + '</td><td  style="text-align:center">' + status + '</td></tr>');
            }

            var table = $('#tableCustomer').DataTable({
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
        url: "ajax/getsup_customer.php",
        data: "idcode=" + recipient,
        success: function(result) {            
            modal.find('.modal-body #code').val(result.code);
            modal.find('.modal-body #cuscode').val(result.cuscode);
            modal.find('.modal-body #cusname').val(result.cusname);
            modal.find('.modal-body #idno').val(result.idno);
            modal.find('.modal-body #road').val(result.road);
            modal.find('.modal-body #subdistrict').val(result.subdistrict);
            modal.find('.modal-body #district').val(result.district);
            modal.find('.modal-body #province').val(result.province);
            modal.find('.modal-body #zipcode').val(result.zipcode);
            modal.find('.modal-body #tel').val(result.tel);
            modal.find('.modal-body #fax').val(result.fax);
            modal.find('.modal-body #taxnumber').val(result.taxnumber);
            modal.find('.modal-body #status').val(result.status);
            modal.find('.modal-body #email').val(result.email);
            

        }
    });
});

$('#modelEdit').on('hidden.bs.modal', function() {
    $("#frmEditInventory *").prop('disabled', true);
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มผู้ขาย
$("#frmAddCustomer").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_customer.php",
        data: $("#frmAddCustomer").serialize(),
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

$("#frmEditCustomer").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_customer.php",
        data: $("#frmEditCustomer").serialize(),
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