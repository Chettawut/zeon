<script type="text/javascript">
$(function() {

    $("#sidePurchase").show()
    
    $.ajax({
        type: "POST",
        url: "ajax/get_supplier.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.supcode.length; count++) {

                let status
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'
                $('#tableSupplier').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .supcode[
                        count] + '" data-whatever="' + result.supcode[
                        count] + '"><td>' + result.supcode[count] + '</td><td>' + result.supname[count] + '</td><td>' + result.province[count] + '</td><td>' + result.address[count] + '</td><td  style="text-align:center">' + status + '</td></tr>');
            }

            var table = $('#tableSupplier').DataTable({
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
        url: "ajax/getsup_supplier.php",
        data: "idcode=" + recipient,
        success: function(result) {            
            modal.find('.modal-body #code').val(result.code);
            modal.find('.modal-body #supcode').val(result.supcode);
            modal.find('.modal-body #supname').val(result.supname);
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
$("#frmAddSupplier").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_supplier.php",
        data: $("#frmAddSupplier").serialize(),
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

$("#frmEditSupplier").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_supplier.php",
        data: $("#frmEditSupplier").serialize(),
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