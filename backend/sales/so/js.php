<script type="text/javascript">
$(function() {

    $("#sideSales").show()
    getSO();



});

// ย้ายไปหน้า เพิ่ม SF
// $("#btnAddSO").click(function() {

//     enabledSupSO()
//     $("#socode").prop('disabled', true);
//     $("#sfdate").val(new Date().toISOString().substring(0, 7));

//     previewSOcode();


//     $("#txtHead").text('เพิ่มใบสั่งขาย (Add Sales Order)');
//     $("#frmSO").show();
//     $("#divfrmSO").show();
//     $("#divfrmEditSO").hide();
//     // $('#divtableSO').hide();

//     $("#btnAddSubmit").show();
//     // $("#btnRefresh").hide();
//     $("#btnPrint").hide();

// });

function onClick_tr(id, supname, address, tel) {
    $('#cuscode').val(id);
    $('#tdname').val(supname);
    $('#address').val(address);
    $('#tel').val(tel.substring(0, 3) + '-' + tel.substring(3));

    $('#editcuscode').val(id);
    $('#editcusname').val(supname);
    $('#editaddress').val(address);
    $('#edittel').val(tel.substring(0, 3) + '-' + tel.substring(3));
}


function onCreate_detail(stcode, stname1, unit) {

    var all_row = $('#tableSODetail tr').length;

    $('#tableSODetail').append(
        '<tr id="new' + all_row +
        '" ><td><p class="form-control-static" style="text-align:center">' +
        all_row +
        '</p></td><td><p class="form-control-static" name="stcode1"  id="stcode1' +
        all_row +
        '" style="text-align:center">' +
        stcode +
        '</p></td><td><p class="form-control-static" name="stname1"  id="stname1' +
        all_row +
        '" style="text-align:left" >' +
        stname1 +
        '</p></td><td><input type="number" class="form-control" name="amount1"  id="amount1' +
        all_row +
        '" min="1" value="1"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
        all_row + '" value="' +
        unit +
        '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
        all_row +
        ',tableSODetail,' +
        stcode +
        '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><button type="button" onClick="onDelete_MainTable(' +
        all_row +
        ',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> </button></td></tr>'
    );


}


function onCal_detail(row) {
    $('#total1' + row).html(formatMoney(($(
            '#amount1' + row)
        .val() *
        $('#price1' +
            row).val()) - ((($(
            '#amount1' + row
        )
        .val() *
        $(
            '#price1' + row)
        .val()) * $(
        '#discount1' +
        row).val()) / 100), 2));

    $('#amount1' + row).change(function() {
        $('#total1' + row).html(formatMoney(($(
                '#amount1' + row)
            .val() *
            $('#price1' +
                row).val()) - ((($(
                '#amount1' + row
            )
            .val() *
            $(
                '#price1' + row)
            .val()) * $(
            '#discount1' +
            row).val()) / 100), 2));
    });

    $('#price1' + row).change(function() {
        $('#total1' + row).html(formatMoney(($(
                '#amount1' + row)
            .val() *
            $('#price1' +
                row).val()) - ((($(
                '#amount1' + row
            )
            .val() *
            $(
                '#price1' + row)
            .val()) * $(
            '#discount1' +
            row).val()) / 100), 2));
    });

    $('#discount1' + row).change(function() {
        $('#total1' + row).html(formatMoney(($(
                '#amount1' + row)
            .val() *
            $('#price1' +
                row).val()) - ((($(
                '#amount1' + row
            )
            .val() *
            $(
                '#price1' + row)
            .val()) * $(
            '#discount1' +
            row).val()) / 100), 2));
    });

    $('input[type=text]').on('keydown', function(e) {
        $('#total1' + row).html(formatMoney(($(
                '#amount1' + row)
            .val() *
            $('#price1' +
                row).val()) - ((($(
                '#amount1' + row
            )
            .val() *
            $(
                '#price1' + row)
            .val()) * $(
            '#discount1' +
            row).val()) / 100), 2));
    });

}

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    var stcode = target.split(',')[2];
    // alert(target + ' ' + stcode);
    // console.log($('#amount1' + row).val() + ' ' + stcode);


    $.ajax({
        type: "POST",
        url: "ajax/cal_stock.php",
        data: "idcode=" + stcode,
        success: function(result) {

            $('#unit1' + row).val(unit);
            if (unit == 'ลัง')
                $('#price1' + row).val(result.ratio * result.sellprice);
            else
                $('#price1' + row).val(result.sellprice);

        }
    });

}

function onClick_unit2(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    // alert(row + ' ' + (target));

    $('#unit2' + row).val(unit);

}

function previewSOcode() {
    $.ajax({
        type: "POST",
        url: "ajax/get_socode.php",
        success: function(result) {

            $("#socode").val(result.socode);

        }
    });

}

$('#modal_add').on('show.bs.modal', function(event) {
    previewSOcode()
});

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $("#editsocode").val(recipient);
    $("#tableEditSODetail").show();
    $("#printsocode").val(recipient);

    var status_so = $("#" + recipient + " td:eq(5)").text();
    // alert(status_so);
    if (status_so == "รออนุมัติขาย") {
        // enabledSupSO(); 
        $("#btnEdit").show();
        $("#btnAddSOdetail2").show();
        // $("#btnAddSOGiveaway2").show();
    } else {
        $("#btnEdit").hide();
        $("#btnAddSOdetail2").hide();
        // $("#btnAddSOGiveaway2").hide();
    }

    if (status_so == "ยกเลิกการใช้งาน")
        $("#btnPrint").hide();
    else
        $("#btnPrint").show();

    if ((status_so != "ยกเลิกการใช้งาน") && (status_so != "รออนุมัติขาย") && (status_so != "รอออกใบกำกับภาษี"))
        $("#btnInvoice").show();
    else
        $("#btnInvoice").hide();


    $.ajax({
        type: "POST",
        url: "ajax/getsup_so.php",
        data: "idcode=" + recipient,
        success: function(result) {

            $("#editsfcode").val(result.sfcode);
            $("#editsfdate").val(result.sfdate);
            $("#editremark").val(result.remark);

        }
    });

    if (($("#" + recipient + " td:eq(5)").text() != "สมบูรณ์") && ($("#" + recipient + " td:eq(5)").text() !=
            "ยกเลิกการใช้งาน"))
        $("#btnCancle").show();
    else
        $("#btnCancle").hide();

    $("#txtHead").text('แก้ไขใบสั่งขาย (Edit Sale Order)');

    $("#divfrmEditSO").show();
    // $('#divtableSO').hide();
    // $('#btnAddSO').hide();
    // $("#btnRefresh").hide();
    $("#tableEditSODetail tbody").empty();
    // $("#tableEditSOGiveaway tbody").empty();
    // $('#tableEditSOGiveaway').hide();
    var option = '';
    $.ajax({
        type: "POST",
        url: "ajax/get_places.php",

        success: function(result) {

            for (count = 0; count < result.places.length; count++) {

                option += '<option value="' + result.placescode[count] + '">' + result
                    .places[count] + '</option>';


            }
            $.ajax({
                type: "POST",
                url: "ajax/getsup_sodetail.php",
                data: "idcode=" + recipient,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditSODetail').append(
                            '<tr id="' + result.codedetail[count] +
                            '" ><td name="sono" id="sono" ><p class="form-control-static" style="text-align:center">' +
                            result.sono[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .sono[count] + ');" name="amount1"  id="amount1' +
                            result.sono[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            result.sono[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.sono[count] +
                            ',tableEditSODetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><button type="button" onClick="onDelete_MainTable(' +
                            result.codedetail[count] +
                            ',\'edit\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> </button></td></tr>'
                        );

                    }

                }
            });

        }
    });
});


function getSO() {
    $.ajax({
        type: "POST",
        url: "ajax/get_so.php",
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.socode.length; count++) {


                if (result.supstatus[count] == '01') {
                    supstatus = 'รออนุมัติขาย'
                    suptitle = 'รออนุมัติขาย'
                } else if (result.supstatus[count] == '02') {
                    supstatus = 'รอออกใบกำกับภาษี'
                    suptitle = 'รอออกใบกำกับภาษี'
                } else if (result.supstatus[count] == '03') {
                    supstatus = 'รอยืนยันส่งสินค้า'
                    suptitle = 'รอยืนยันส่งสินค้า'
                } else if (result.supstatus[count] == '04') {
                    supstatus = 'สมบูรณ์';
                    suptitle = 'สมบูรณ์';
                } else if (result.supstatus[count] == 'C') {
                    supstatus = 'ยกเลิกการใช้งาน'
                    suptitle = 'ยกเลิกการใช้งาน'
                } else if (result.supstatus[count] == 'N') {
                    supstatus = 'ยังส่งของไม่ครบ'
                    suptitle = 'ยังส่งของไม่ครบ'
                }
                // sodate = result
                //     .sodate[count].substring(8) + '-' + result
                //     .sodate[count].substring(5, 7) + '-' + result
                //     .sodate[count].substring(0, 4);

                $('#tableSO').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .socode[
                        count] + '" data-whatever="' + result.socode[
                        count] + '" ><td>' + result.socode[count] +
                    '</td><td>' + result.sfdate[count] + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result.amount[
                        count] + '</td><td>' + result.unit[count] + '</td></tr>');
            }

            var table = $('#tableSO').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "order": [1, 'desc'],
                "pageLength": 20
            })


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });

        }
    });
}

$.ajax({
    type: "POST",
    url: "ajax/get_customer.php",
    success: function(result) {

        for (count = 0; count < result.code.length; count++) {

            $('#table_id tbody').append(
                '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                .cuscode[count] + '" onClick="onClick_tr(this.id,\'' + result.cusname[
                    count] + '\',\'' + result.address[count] + '\',\'' + result.tel[count] +
                '\');"><td>' + result.code[
                    count] + '</td><td>' +
                result.cuscode[count] + '</td><td>' +
                result.cusname[count] + '</td></tr>');


        }

        $('#table_id').DataTable({
            "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
            "ordering": true
        });


        $(".dataTables_filter input[type='search']").attr({
            size: 40,
            maxlength: 40
        });
    }
});

//modal เพิ่มของขาย
$.ajax({
    type: "POST",
    url: "ajax/get_stock.php",

    success: function(result) {

        for (count = 0; count < result.code.length; count++) {

            $('#table_stock tbody').append(
                '<tr data-toggle="modal" data-dismiss="modal" data-target="#modelStockEdit" id="' +
                result.stcode[count] + '" data-whatever="' + result
                .code[count] + '"><td>' + result.stcode[count] +
                '</td><td>' +
                result.stname1[count] +
                '</td><td>' +
                result.unit[count] +
                '</td></tr>');


        }

        $('#table_stock').DataTable({
            "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
            "ordering": true
        });


        $(".dataTables_filter input[type='search']").attr({
            size: 40,
            maxlength: 40
        });
    }
});

//modal เพิ่มของขาย
$.ajax({
    type: "POST",
    url: "ajax/get_stock.php",

    success: function(result) {

        for (count = 0; count < result.code.length; count++) {

            $('#table_stock2 tbody').append(
                '<tr data-toggle="modal" data-dismiss="modal" data-target="#modelStockEdit" id="' +
                result.stcode[count] + '" data-whatever="' + result
                .code[count] + '"><td>' + result.stcode[count] +
                '</td><td>' +
                result.stname1[count] +
                '</td><td>' +
                result.unit[count] +
                '</td></tr>');

        }

        $('#table_stock2').DataTable({
            "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
            "ordering": true
        });


        $(".dataTables_filter input[type='search']").attr({
            size: 40,
            maxlength: 40
        });
    }
});

$.ajax({
    type: "POST",
    url: "ajax/get_unit.php",

    success: function(result) {

        for (count = 0; count < result.unitcode.length; count++) {

            $('#table_unit tbody').append(
                '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                result.unit[count] + '\');"  id="' +
                result
                .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                '</td><td>' +
                result.unit[count] + '</td></tr>');


        }

        $('#table_unit').DataTable({
            "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
            "ordering": true
        });


        $(".dataTables_filter input[type='search']").attr({
            size: 40,
            maxlength: 40
        });
    }
});



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
                    .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }


        }
    });
})

$('#modal_unit2').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",

        success: function(result) {
            $('#table_unit2 tbody').empty();
            for (count = 0; count < result.unitcode.length; count++) {

                $('#table_unit2 tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit2(\'' +
                    result.unit[count] + '\',\'' + recipient + '\');"  id="' +
                    result
                    .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }


        }
    });
})



// กดยืนยันเพิ่ม SO
$("#frmAddSO").submit(function(event) {
    event.preventDefault();

    var amount = [];
    var stcode = [];
    var unit = [];
    var price = [];
    var discount = [];


    $('#tableSODetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode1" + (++key)).text());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount1" + (++key)).val());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit1" + (++key)).val());
    });
    // $('#tableSODetail tbody tr').each(function(key) {
    //     price.push($(this).find("td #price1" + (++key)).val());
    // });
    // $('#tableSODetail tbody tr').each(function(key) {
    //     discount.push($(this).find("td #discount1" + (++key)).val());
    // });
    // alert($("#frmAddSO").serialize())

    if (stcode != 0) {

        $(':disabled').each(function(event) {
            $(this).removeAttr('disabled');
        });

        $.ajax({
            type: "POST",
            url: "ajax/add_so.php",
            data: $("#frmAddSO").serialize() + "&amount=" + amount + "&stcode=" +
                stcode + "&unit=" + unit,
            success: async function(result) {

                if (result.status == 1) // Success
                {
                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();
                    // console.log(result.message);
                } else {
                    alert(result.message);
                    $("#socode").prop("disabled", true);
                    $("#cuscode").prop("disabled", true);
                    $("#cusname").prop("disabled", true);
                    $("#tdname").prop("disabled", true);
                    $("#tel").prop("disabled", true);
                    $("#address").prop("disabled", true);

                    // console.log(result.message);
                }
            }
        });

    } else {
        Swal.fire('เกิดข้อผิดพลาด', 'กรุณาเพิ่มรายการ', 'error')
    }

});

// กดยืนยันแก้ไข SO
$("#frmEditSO").submit(function(event) {
    event.preventDefault();

    // alert('ระบบแก้ไขกำลังปรับปรุง')

    var amount = [];
    var stcode = [];
    var unit = [];

    $(':disabled').each(function(event) {
        $(this).removeAttr('disabled');
    });

    $('#tableEditSODetail tbody tr').each(function() {
        stcode.push($(this).attr("id"));
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount1" + (++key)).val());
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit1" + (++key)).val());
    });

    // alert(stcode)
    // alert($("#frmEditSO").serialize())
    $.ajax({
        type: "POST",
        url: "ajax/edit_so.php",
        data: $("#frmEditSO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
            "&unit=" + unit,
        success: async function(result) {

            if (result.status == 1) // Success
            {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.message);
            } else {
                alert(result.message);
                $("#editsfcode").prop("disabled", true);
                // console.log(result.message);
            }
        }
    });

});

// เพิ่ม so detail เมื่อเลือกสต๊อก
$("#table_stock").delegate('tbody tr', 'click', function() {
    var id = $(this).attr("id");


    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + id,
        success: function(result) {

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

            onCreate_detail(result.stcode, result.stname1, result
                .unit);

        }
    });


});

// เพิ่ม so detail เมื่อเลือกสต๊อกเพิ่มเติม
$("#table_stock2").delegate('tbody tr', 'click', function() {
    var id = $(this).attr("id");
    var option = '';

    if (confirm("คุณต้องการเพิ่มสินค้ารหัส " + id + " หรือไม่")) {
        $.ajax({
            type: "POST",
            url: "ajax/add_sodetail.php",
            data: "stcode=" + id + "&socode=" + $("#editsfcode").val(),
            success: function(result) {
                // alert(result.message);

                if (result.status == 1) {

                    var all_row = $('#tableEditSODetail tr').length;

                    $('#tableEditSODetail').append(
                        '<tr id="new' + all_row +
                        '" ><td><p class="form-control-static" style="text-align:center">' +
                        all_row +
                        '</p></td><td><p class="form-control-static" name="stcode1"  id="stcode1' +
                        all_row +
                        '" style="text-align:center">' +
                        id +
                        '</p></td><td><p class="form-control-static" name="stname1"  id="stname1' +
                        all_row +
                        '" style="text-align:left" >' +
                        result.stname1 +
                        '</p></td><td><input type="number" class="form-control" name="amount1"  id="amount1' +
                        all_row +
                        '" min="1" value="1"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                        all_row + '" value="' +
                        result.unit +
                        '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                        all_row +
                        ',tableSODetail,' +
                        id +
                        '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><button type="button" onClick="onDelete_MainTable(' +
                        all_row +
                        ',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> </button></td></tr>'
                    );


                    onSelectSO($("#editsfcode").val());
                    // console.log(result.sql);
                } else {
                    alert(result.message);
                    $("#editsocode").prop("disabled", true);
                    $("#editcuscode").prop("disabled", true);
                    $("#editcusname").prop("disabled", true);
                    $("#edittdname").prop("disabled", true);
                    $("#edittel").prop("disabled", true);
                    $("#editaddress").prop("disabled", true);
                    // console.log(result.message);
                }


            }
        });

    }



});

function onDelete_MainTable(code, type) {

    // alert(code)
    if (confirm("ยืนยันการลบรายการ")) {

        if (type === 'add')
            $("#new" + code).remove();
        else {
            // alert(code)
            $.ajax({
                type: "POST",
                url: "ajax/deletesup_sf.php",
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
}



// ยกเลิกอนุมัติการขาย
$("#btnCancle").click(function() {
    var so_code = $("#editsocode").val();

    var amount = [];
    var stcode = [];
    var unit = [];
    var price = [];
    var discount = [];
    var places = [];

    var stcode2 = [];
    var amount2 = [];
    var unit2 = [];
    var places2 = [];

    $(':disabled').each(function(event) {
        $(this).removeAttr('disabled');
    });


    $('#tableEditSODetail tbody tr').each(function() {
        stcode.push($(this).attr("id"));
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount1" + (++key)).val());
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit1" + (++key)).val());
    });

    if (confirm("คุณต้องการยกเลิกใบสั่งขาย " + so_code + " หรือไม่")) {
        $.ajax({
            type: "POST",
            data: $("#frmEditSO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit +
                "&price=" + price +
                "&places=" + places +
                "&discount=" + discount + "&stcode2=" + stcode2 + "&amount2=" + amount2 +
                "&unit2=" + unit2 +
                "&places2=" + places2,
            url: "ajax/cancle_so.php",
            success: function(result) {
                alert(result["message"]);
                window.location.reload();
            }
        });
    } else
        window.location.reload();
});


//Refresh
$("#btnRefresh").click(function() {
    RefreshPage();
});
</script>