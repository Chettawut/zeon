<script type="text/javascript">
//modal เปิดซ้อนกันได้
$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
        'modal-stack'));
});

$(function() {

    $("#sideEngineer").show()

    $.ajax({
        type: "POST",
        url: "ajax/get_bom.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {
            // alert(result)
            for (count = 0; count < result.stcodemain.length; count++) {


                $('#tableBom').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .stcodemain[
                        count] + '" data-whatever="' + result.stcodemain[
                        count] + '"><td>' + result.stcodemain[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');
            }

            var table = $('#tableBom').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 30,
                maxlength: 30
            });



        }
    });


})


$.ajax({
    type: "POST",
    url: "ajax/get_stock.php",
    success: function(result) {

        for (count = 0; count < result.stcode.length; count++) {


            $('#table_addstock').append(
                '<tr data-toggle="modal" data-dismiss="modal" onClick="onSelect_addstock(\'' +
                result.stcode[count] + '\',\'' +
                result.stname1[count] + '\',\'' +
                result.unit[count] + '\');" ><td>' + result.stcode[count] + '</td><td>' +
                result.stname1[count] + '</td><td>' +
                result.unit[count] + '</td></tr>');
        }

        $('#table_addstock').DataTable({
            "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
            "ordering": true
        });


        $(".dataTables_filter input[type='search']").attr({
            size: 60,
            maxlength: 60
        });


    }
});

function onSelect_addstock(stcode, stname1, unit) {

    let stcodemain = $('#stcode').val()

    if (confirm("คุณต้องการเพิ่ม " + stname1 + " ลงใน Bom หรือไม่")) {
        $.ajax({
            type: "POST",
            url: "ajax/add_bom.php",
            data: "stcode=" + stcode + "&stcodemain=" + stcodemain + "&unit=" + unit,
            success: function(result) {

                getbom_detail(stcodemain)

            }
        });
    }



}

function getbom_detail(stcodemain) {

    $("#tableBomDetail tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_bom.php",
        data: "idcode=" + stcodemain,
        success: function(result) {
            $('#stcode').val(result.stcodemain[0]);
            $('#stname1').val(result.stnamemain[0]);
            $('#unit').val(result.unitmain[0]);

            for (count = 0; count < result.stcode.length; count++) {


                $('#tableBomDetail').append(
                    '<tr id="' + result.code[count] + '"><td>' + result.stcode[count] +
                    '<input type="hidden" name="code" id="code' + [count + 1] +
                    '"" class="form-control" value="' +
                    result.code[count] + '" ></td><td>' +
                    result.stname1[count] +
                    '</td><td><input type="number" name="amount" id="amount' + [count + 1] +
                    '"" step="0.001" class="form-control" value="' +
                    result.amount[count] + '" ></td><td><input type="text" name="unit" id="unit' + [
                        count + 1
                    ] +
                    '"" class="form-control" value="' +
                    result.unit[count] +
                    '" ></td><td><button type="button" onClick="onDelete_MainTable(\'' +
                    result.code[count] +
                    '\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=></button></td></tr>'
                );
            }


        }
    });
}

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    getbom_detail(recipient)
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

$("#frmEditBom").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })

    let code = [];
    let amount = [];
    let unit = [];

    $('#tableBomDetail tbody tr').each(function(key) {
        code.push($(this).find("td #code" + (++key)).val());
    });

    $('#tableBomDetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });

    $('#tableBomDetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });

    $.ajax({
        type: "POST",
        url: "ajax/edit_bom.php",
        data: $("#frmEditBom").serialize() + "&code=" + code + "&amount=" + amount + "&unit=" + unit,
        success: async function(result) {

            if (result.status == 1) // Success
            {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.message);
            }
        }
    });

});

function onDelete_MainTable(code) {

    // alert(code)
    if (confirm("ยืนยันการลบรายการ")) {

        $.ajax({
            type: "POST",
            url: "ajax/deletesup_bom.php",
            data: "code=" + code,
            success: function(result) {
                if (result.status == 1) // Success
                {
                    $("#" + code).remove();
                } else // Err
                {
                    alert(result.message);
                }
                // alert(result);
            }
        });

    }
}
</script>