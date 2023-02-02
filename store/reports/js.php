<script type="text/javascript">
$(function() {


    $("#sideStore").show()

    $("#toolyear").val(new Date().toISOString().slice(0, 10))
    
    

})

$('#btnprint2').click(function() {

    let year = $('#toolyear').val()

    $('#myModalLabel').text('รายงานสรุปยอดเบิกแยก Project')

    $('#printf').attr('src', 'WD_byproject/index.php?year=' + year)

    setTimeout(function() {
        window.frames["printf"].focus();
        $('#modal_report').modal('show');
    }, 100);
});

$('#cancleSelect').click(function() {
    $("#frmMenu").hide();
    $("#frmList").removeClass();
    $("#frmList").addClass("col-lg-12 col-12");
});

$("#month").click(function() {
    $("#frmMenu").show();
    $("#frmList").removeClass();
    $("#frmList").addClass("col-lg-3 col-3");
});

$("#newreport").click(function() {
    alert('อยู่ระหว่างการปรับปรุง')
});
</script>