<script>
//modal เปิดซ้อนกันได้
$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
        'modal-stack'));
});


$(function() {

    getData('29/12/2022');

});


$("#toolyear").change(function() {
    //   alert($("#toolyear").val());
    getData($("#toolyear").val());
});

function getData(date) {


    $.ajax({
        type: "POST",
        url: "ajax/get_data.php",
        // data: "year=" + year,
        success: function(result) {
            $('#tableData tbody').empty();
            // alert(result.projectname)

            let total= 0,vat= 0,totalvat = 0

            for (count = 0; count < result.projectname.length; count++) {


                $('#tableData tbody').append(
                    '<tr id="' +
                    count +
                    '"  ><td class="table03" align="center" bgcolor=\"#fefbc7\">' +
                    result.projectname[count] +
                    '</td><td class="table03" align="right" style=\"color:#004080;\" bgcolor=\"#ffffff\">' +
                    formatMoney(result.total[count],2) +
                    '</td><td class="table03" align="right" style=\"color:#004080;\" bgcolor=\"#ffffff\">' +
                    formatMoney((result.total[count]*7)/100,2) +
                    '</td><td class="table03" align="right" style=\"color:#004080;\" bgcolor=\"#ffffff\">' +
                    formatMoney((parseFloat(result.total[count])+parseFloat(result.total[count]*7)/100),2) +
                    '</td></tr>');

                    total+=parseFloat(result.total[count])
                    vat+=parseFloat((result.total[count]*7)/100)
                    totalvat+=parseFloat(result.total[count])+parseFloat(result.total[count]*7)/100
            }

             $('#tableData tfoot').append(
                    '<tr id="' +
                    count +
                    '"  ><td class="table03" align="center" bgcolor=\"#83E8E9\">ยอดรวม</td><td class="table03" align="right" style=\"color:#004080;\" bgcolor=\"#83E8E9\">' +
                    formatMoney(total,2) +
                    '</td><td class="table03" align="right" style=\"color:#004080;\" bgcolor=\"#83E8E9\">' +
                    formatMoney(vat,2) +
                    '</td><td class="table03" align="right" style=\"color:#004080;\" bgcolor=\"#83E8E9\">' +
                    formatMoney(totalvat,2) +
                    '</td></tr>');

            var table = $("#tableData").DataTable({
                "ordering": false,
                "info": false,
                "lengthChange": false,
                "searching": false,
                "paging": false,
                "buttons": ["copy", "excel", "print", "colvis"]
            }).buttons().container().appendTo('#tableData_wrapper .col-md-6:eq(0)');
        }
    });
}
</script>