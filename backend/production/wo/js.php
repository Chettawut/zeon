<script type="text/javascript">
//modal เปิดซ้อนกันได้
$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
        'modal-stack'));
});
$(function() {


    $.ajax({
        type: "POST",
        url: "ajax/get_wo.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.wocode.length; count++) {

                $('#tableWO').append(
                    '<tr id="' + result.wocode[
                        count] +
                    '" data-toggle="modal" data-target="#modal_edit" data-whatever="' + result
                    .wocode[
                        count] + '" ><td>' + result.wocode[
                        count] +
                    '</td><td>' + result
                    .wodate[count] + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td style="text-align:center" ><span "title="' + result.wostatus[count] + '">' +
                    result.wostatus[count] +
                    '</span></td></tr>');

            }

            $('#tableWO').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": false,
                "scrollX": true
            });

            $(".dataTables_filter input[type='search']").css({
                'width': '80%'
            });


        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                let type
                if (result.type[count] == 'FG')
                    type = 'Finish Goods'
                else if (result.type[count] == 'MAT')
                    type = 'Material'
                else if (result.type[count] == 'SFG')
                    type = 'Semi Finish Goods'

                $('#table_stock tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .stcode[count] + '" "><td>' + (count + 1) + '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td><td>' +
                    type + '</td></tr>');


            }

            $('#table_stock').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": false
            });


            $(".dataTables_filter input[type='search']").css({
                'width': '80%'
            });
        }
    });

})


$('#btnGetPO').click(function() {
    let supcode = $('#add_supcode').val()
    var table = $('#table_po').DataTable();

    table.clear().draw().destroy();
    if (supcode != '') {
        $.ajax({
            type: "POST",
            url: "ajax/get_po.php",
            data: "supcode=" + supcode,
            success: function(result) {
                for (count = 0; count < result.pocode.length; count++) {

                    $('#table_po tbody').append(
                        '<tr id="' +
                        result.pocode[count] + ',' +
                        result.pono[count] +
                        '" );"><td><input type="checkbox" id="' + 'chk' +
                        count + '" name="' + 'chk' +
                        count + '" value="' + count + '" ></td><td>' + [count + 1] +
                        '</td><td>' +
                        result.pocode[count] + '</td><td>' +
                        result.stcode[count] + '</td><td>' + result.stname1[count] +
                        '</td><td>' +
                        result.unit[count] + '</td><td style="text-align:right">' +
                        result.amount[count] +
                        '</td><td style="text-align:right">' + result.recamount[
                            count] +
                        '</td><td><p style="text-align:center" class="form-control-static" title="' +
                        result.supstatus[count] + '" >' + result.supstatus[count] +
                        '</p></td></tr>');


                }
            }
        });

        $('#modal_po').modal('show');

    } else {
        Swal.fire('แจ้งเตือน', "กรุณาเลือกผู้ขายก่อนเลือกรายการ", 'info');
    }

})

function onDeleteDetail(table, id) {
    $("#" + table + " tbody").empty();
    $("#" + id).hide();

    if (table == "tableRRGiveaway")
        $('#tableRRGiveaway').hide();
}

$('#modal_unit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",

        success: function(result) {
            $('#table_unit tbody').empty();
            for (count = 0; count < result.unitcode.length; count++) {

                $('#table_unit tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                    result.unit[count] + '\',\'' + recipient + '\');"  id="' +
                    result
                    .unitcode[count] + '" );"><td>' + (count + 1) +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }


        }
    });
})

function getTotal(row) {
    $('#total' + row).val(formatMoney(($('#amount' + row).val() *
        $('#price' +
            row).val()) - ((($('#amount' + row).val() *
        $(
            '#price' + row).val()) * $(
        '#discount' +
        row).val()) / 100), 2));

}

$('#btnPrintGR').click(function() {
    alert('อยู่ระหว่างการพัฒนา')
});

$('#btnCancleGR').click(function() {
    alert('อยู่ระหว่างการพัฒนา')
});


// เพิ่ม po detail เมื่อเลือกสต๊อก
$("#table_stock").delegate('tr', 'click', function() {
    let id = $(this).attr("id");

    // alert(id)
    // $('#tableGRDetail').show();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + id,
        success: function(result) {
            // alert(result)
            var today = new Date();
            var dd = today.getDate() + 7;

            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }
            today = yyyy + '-' + mm + '-' + dd;
            // console.log(today);
            let all_row = []
            // $('#tablePoDetail tbody tr').each(function() {
            //     row.push($(this).find("td #stcode" + (++key)).text());
            // });
            $('#tableWODetail tbody tr').each(function() {
                all_row.push($(this).attr("id"));
            });


            if (all_row.length == 0)
                all_row = 1;
            else {
                all_row = parseInt(all_row[(all_row.length - 1)].substring(3, 4)) + 1
            }

            onCreate_detail($('#tableWODetail tr').length, result.stcode, result.stname1, 1, result
                .unit, result.price, 0)

        }
    });


});

function onCreate_detail(row, stcode, stname1, amount, unit) {

    $('#tableWODetail tbody').append(
        '<tr id="new' + row +
        '" ><td name="pono" id="pono" ><p class="form-check-label" style="text-align:center">' +
        row +
        '</p></td><td><p class="form-check-label" name="stcode"  id="stcode' +
        row +
        '" style="text-align:center">' +
        stcode +
        '</p></td><td><p class="form-check-label" name="stname1"  id="stname1' +
        row +
        '" style="text-align:left">' +
        stname1 +
        '</p></td><td><input type="text" class="form-control" name="amount"  id="amount' +
        row +
        '"  onChange="getTotal(' +
        row +
        ');" value="' +
        amount +
        '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
        row + '" value="' +
        unit +
        '" readonly><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
        row +
        ',tablePoDetail,' +
        stcode +
        '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><button type="button" onClick="onDelete_MainTable(' +
        row +
        ',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> </button></td></tr>'
    );

    getTotal(row);


}

$('#modal_add').on('show.bs.modal', function(event) {

    $("#add_wodate").val(new Date().toISOString().substring(0, 10));
    
    $.ajax({
        type: "POST",
        url: "ajax/get_wocode.php",
        success: function(result) {

            $("#add_wocode").val(result.wocode);

        }
    });
});

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var wocode = button.data('whatever');
    var modal = $(this);

    $("#tableEditWODetail tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_wo.php",
        data: "idcode=" + wocode,
        success: function(result) {

            // alert(result)
            $("#wocode").val(result.wocode);
            $("#wodate").val(result.wodate);
            $("#shift").val(result.shift);
            $("#location").val(result.location);
            $("#remark").val(result.remark);

            $.ajax({
                type: "POST",
                url: "ajax/getsup_wodetail.php",
                data: "idcode=" + wocode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditWODetail tbody').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="rrno" id="rrno" ><p class="form-control-static" style="text-align:center">' +
                            result.wono[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" name="amount"  id="amount' +
                            result.wono[count] +
                            '"  value="' +
                            result.amount[count] +
                            '" readonly></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                            result.wono[count] + '" value="' +
                            result.unit[count] +
                            '" readonly><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.wono[count] +
                            ',tableEditWODetail," type="button"><span class="fa fa-search"></span></button></span></div></td></tr>'
                        );


                    }

                }
            });
        }
    });

    $("#divfrmEditGR").show();

    $("#tableEditGRDetail tbody").empty();
});

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    var stcode = target.split(',')[2];

    // alert(target + ' ' + stcode);
    $('#unit' + row).val(unit);

}

function onDelete_MainTable(row) {
    var tmpstcode = [];
    var tmpstname1 = [];
    var tmpunit = [];
    var tmpamount = [];
    var tmpsellprice = [];
    var tmpdiscount = [];
    var all_row = $('#tableWODetail tbody tr').length;

    for (var i = row + 1; i <= all_row; i++) {
        tmpstcode.push($('#stcode' + i).text());
        tmpstname1.push($('#stname1' + i).text());
        tmpamount.push($('#amount' + i).val());
        tmpunit.push($('#unit' + i).val());
        tmpsellprice.push($('#price' + i).val());
        tmpdiscount.push($('#discount' + i).val());
    }

    for (var d = row; d <= all_row; d++)
        $("#new" + d).remove();

    for (var j = 0; j < tmpstcode.length; j++)
        onCreate_detail($('#tableWODetail tr').length, tmpstcode[j], tmpstname1[j], tmpamount[j], tmpunit[j],
            tmpsellprice[j], tmpdiscount[j])

    // onCreate_detail(tmpstcode[j], tmpstname1[j], tmpunit[j], tmpsellprice[j]);

}

$("#btnRefresh").click(function() {
    window.location.reload();
});

// กดยืนยันเพิ่ม WO
$("#frmAddWO").submit(function(event) {
    event.preventDefault();

    var amount = [];
    var stcode = [];
    var unit = [];


    $('#tableWODetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });
    $('#tableWODetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tableWODetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });

    // alert(unit);

    if (stcode != 0) {

        $.ajax({
            type: "POST",
            url: "ajax/add_wo.php",
            data: $("#frmAddWO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit,
            success: async function(result) {
                if (result.status == 1) {
                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();
                    // console.log(result.sql);
                } else {
                    Swal.fire('เกิดข้อผิดพลาด', result.message, 'error');
                    console.log(result.message);
                }
            }
        });
    } else {
        Swal.fire('เกิดข้อผิดพลาด', "กรุณาเพิ่มรายการสินค้า", 'error');
    }

});

// กดยืนยันแก้ไข GR
$("#frmEditGR").submit(function(event) {
    event.preventDefault();

    // alert(stcode)

    $.ajax({
        type: "POST",
        url: "ajax/edit_gr.php",
        data: $("#frmEditGR").serialize(),
        success: async function(result) {
            if (result.status == 1) {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.sql);
            } else {
                Swal.fire('เกิดข้อผิดพลาด', "รหัสซ้ำ", 'error');
                console.log(result.message);
            }
        }
    });

});
</script>