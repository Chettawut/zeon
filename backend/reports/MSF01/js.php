<script type="text/javascript">
$(function() {

    $("#yeardate").val(new Date().getFullYear());


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


    CreateReport('100001', '2023')



})

// เพิ่ม po detail เมื่อเลือกสต๊อก
$("#table_stock").delegate('tr', 'click', function() {
    let id = $(this).attr("id");
    $('#stcode').val(id),
        CreateReport(id, $('#yeardate').val())

});

$('#yeardate').on('change', function() {
    CreateReport($('#stcode').val(), $('#yeardate').val())
});

function CreateReport(stcode, year) {

    $('#tableData thead').empty()
    $('#tableData tbody').empty()

    $.ajax({
        type: "POST",
        url: "ajax/create_report.php",
        data: "stcode=" + stcode + "&year=" + year,
        success: function(result) {

            $('#tableData thead').append(
                '<tr><th colspan="2" scope="row">' + result.stname1 + '</th><th>Jan-' + year.substring(
                    2) + '</th><th>Feb-' + year.substring(2) + '</th><th>Mar-' + year.substring(2) + '</th><th>Apr-' + year.substring(2) +
                '</th><th>May-' + year.substring(2) + '</th><th>Jun-' + year.substring(2) + '</th><th>Jul-' + year.substring(2) +
                '</th><th>Aug-' + year.substring(2) + '</th><th>Sep-' + year.substring(2) + '</th><th>Oct-' + year.substring(2) +
                '</th><th>Nov-' + year.substring(2) + '</th><th>Dec-' + year.substring(2) + '</th><th>Total</th></tr>');



            let oJan = 0;
            let oFeb = oJan + parseFloat(result.cJan) - parseFloat(result.sJan);
            let oMar = oFeb + parseFloat(result.cFeb) - parseFloat(result.sFeb);
            let oApr = oMar + parseFloat(result.cMar) - parseFloat(result.sMar);
            let oMay = oApr + parseFloat(result.cApr) - parseFloat(result.sApr);
            let oJun = oMay + parseFloat(result.cMay) - parseFloat(result.sMay);
            let oJul = oJun + parseFloat(result.cJun) - parseFloat(result.sJun);
            let oAug = oJul + parseFloat(result.cJul) - parseFloat(result.sJul);
            let oSep = oAug + parseFloat(result.cAug) - parseFloat(result.sAug);
            let oOct = oSep + parseFloat(result.cSep) - parseFloat(result.sSep);
            let oNov = oOct + parseFloat(result.cOct) - parseFloat(result.sOct);
            let oDec = oNov + parseFloat(result.cNov) - parseFloat(result.sNov);
            // alert(oMay+parseFloat(result.cMay))

            $('#tableData tbody').append(
                '<tr><td class="lefttable" colspan="2" scope="row">Beg of Month </td><td scope="row">' +
                formatMoney(oJan, 0) + '</td><td scope="row">' +
                formatMoney(oFeb, 0) + '</td><td scope="row">' + formatMoney(oMar,
                    0) + '</td><td scope="row">' + formatMoney(oApr, 0) +
                '</td><td scope="row">' + formatMoney(oMay, 0) +
                '</td><td scope="row">' + formatMoney(oJun, 0) +
                '</td><td scope="row">' + formatMoney(oJul, 0) +
                '</td><td scope="row">' + formatMoney(oAug, 0) +
                '</td><td scope="row">' + formatMoney(oSep, 0) +
                '</td><td scope="row">' + formatMoney(oOct, 0) +
                '</td><td scope="row">' + formatMoney(oNov, 0) +
                '</td><td scope="row">' + formatMoney(oDec, 0) +
                '</td><td scope="row"></td></tr>');

            let totalc = parseFloat(result.cJan) + parseFloat(result.cFeb) + parseFloat(
                result
                .cMar) + parseFloat(result.cApr) + parseFloat(result.cMay) + parseFloat(
                result
                .cJun) + parseFloat(result.cJul) + parseFloat(result.cAug) + parseFloat(
                result
                .cSep) + parseFloat(result.cOct) + parseFloat(result.cNov) + parseFloat(
                result
                .cDec);

            $('#tableData tbody').append(
                '<tr><td height="70" class="lefttable" colspan="2" scope="row">Product</td><td scope="row">' +
                formatMoney(result.cJan, 0) + '</td><td scope="row">' +
                formatMoney(result.cFeb, 0) + '</td><td scope="row">' +
                formatMoney(result.cMar, 0) + '</td><td scope="row">' +
                formatMoney(result.cApr, 0) + '</td><td scope="row">' + formatMoney(result
                    .cMay,
                    0) + '</td><td scope="row">' + formatMoney(result.cJun, 0) +
                '</td><td scope="row">' + formatMoney(result.cJul, 0) +
                '</td><td scope="row">' + formatMoney(result.cAug, 0) +
                '</td><td scope="row">' + formatMoney(result.cSet, 0) +
                '</td><td scope="row">' + formatMoney(result.cOct, 0) +
                '</td><td scope="row">' + formatMoney(result.cNov, 0) +
                '</td><td scope="row">' + formatMoney(result.cDec, 0) +
                '</td><td scope="row">' + formatMoney(totalc, 0) +
                '</td></tr>'
            );

            let totals = parseFloat(result.sJan) + parseFloat(result.sFeb) + parseFloat(
                result
                .sMar) + parseFloat(result.sApr) + parseFloat(result.sMay) + parseFloat(
                result
                .sJun) + parseFloat(result.sJul) + parseFloat(result.sAug) + parseFloat(
                result
                .sSep) + parseFloat(result.sOct) + parseFloat(result.sNov) + parseFloat(
                result
                .sDec);

            $('#tableData tbody').append(
                '<tr><td height="70" class="lefttable" colspan="2" scope="row">Sales</td><td class="font-weight-bold" scope="row">' +
                formatMoney(result.sJan, 0) +
                '</td><td class="font-weight-bold" scope="row">' +
                formatMoney(result.sFeb, 0) +
                '</td><td class="font-weight-bold" scope="row">' +
                formatMoney(result.sMar, 0) +
                '</td><td class="font-weight-bold" scope="row">' +
                formatMoney(result.sApr, 0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sMay,
                    0) + '</td><td class="font-weight-bold" scope="row">' + formatMoney(
                    result.sJun, 0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sJul,
                    0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sAug,
                    0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sSet,
                    0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sOct,
                    0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sNov,
                    0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(result.sDec,
                    0) +
                '</td><td class="font-weight-bold" scope="row">' + formatMoney(totals, 0) +
                '</td></tr>'
            );

            $('#tableData tbody').append(
                '<tr><td height="70" class="lefttable" colspan="2" scope="row">End of Month</td><td scope="row">' +
                formatMoney(oFeb, 0) + '</td><td scope="row">' +
                formatMoney(oMar, 0) + '</td><td scope="row">' +
                formatMoney(oApr, 0) + '</td><td scope="row">' + formatMoney(oMay,
                    0) + '</td><td scope="row">' + formatMoney(oJun, 0) +
                '</td><td scope="row">' + formatMoney(oJul, 0) +
                '</td><td scope="row">' + formatMoney(oAug, 0) +
                '</td><td scope="row">' + formatMoney(oSep, 0) +
                '</td><td scope="row">' + formatMoney(oOct, 0) +
                '</td><td scope="row">' + formatMoney(oNov, 0) +
                '</td><td scope="row">' + formatMoney(oDec, 0) +
                '</td><td scope="row">' + formatMoney(oNov + parseFloat(result.cDec) - parseFloat(result
                    .sDec), 0) +
                '</td><td scope="row">' + formatMoney(totalc / totals, 2) +
                '</td></tr>'
            );

            $('#tableData tbody').append(
                '<tr><td height="70" class="lefttable" colspan="2" scope="row">Inventory ratio</td><td scope="row">' +
                formatMoney(oFeb / result.sJan, 0) + '</td><td scope="row">' +
                formatMoney(oMar, 0) + '</td><td scope="row">' +
                formatMoney(oApr, 0) + '</td><td scope="row">' + formatMoney(oMay / result.sApr,
                    2) + '</td><td scope="row">' + formatMoney(oJun / result.sMay, 2) +
                '</td><td scope="row">' + formatMoney(oJul, 0) +
                '</td><td scope="row">' + formatMoney(oAug, 0) +
                '</td><td scope="row">' + formatMoney(oSep, 0) +
                '</td><td scope="row">' + formatMoney(oOct, 0) +
                '</td><td scope="row">' + formatMoney(oNov, 0) +
                '</td><td scope="row">' + formatMoney(oDec, 0) +
                '</td><td scope="row">' + formatMoney(oNov + parseFloat(result.cDec) - parseFloat(result
                    .sDec), 0) +
                '</td></tr>'
            );

        }
    });
}


$("#btnRefresh").click(function() {
    window.location.reload();
});
</script>