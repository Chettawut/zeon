<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">เพิ่มข้อมูลวัสดุ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmAdd" id="frmAdd" method="POST" action="javascript:void(0);">
                <div id="divAdd" class="modal-body">

                <div class="row" style="padding: 5px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <table id="table_stock" name="table_customer" class="table table-bordered table-striped">
                                <thead style=" background-color:#D6EAF8;">
                                    <tr>
                                        <th width="15%">ตัวย่อ</th>
                                        <th width="60%"  style="text-align:right">ชื่อสินค้า</th>
                                        <th width="25%" style="text-align:right">ขนาด (mm.)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
                        <button type="submit" id="btnAddSo" form="frmAdd" class="btn btn-primary">ตกลง</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>