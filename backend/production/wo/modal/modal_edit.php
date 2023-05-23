<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF); text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขใบผลิตสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditWO" id="frmEditWO" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <button type="button" id="btnPrintGR" class="btn btn-primary"><i class="fa fa-print"
                                aria-hidden="true"></i> ปริ้นใบผลิตสินค้า</button>
                        <!-- <button type="button" id="btnCancleGR" class="btn btn-danger"><i class="fas fa-times-circle"
                                aria-hidden="true"></i> ยกเลิกการรับสินค้า</button> -->


                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ WO</label>
                            <input type="text" class="form-control" name="wocode" id="wocode" maxlength="50"
                                readonly>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่ผลิตสินค้า</label>
                            <input type="date" class="form-control" name="wodate" id="wodate" required>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">กะ</label>
                            <select class="form-control" name="shift" id="shift" required>
                                <option value="เช้า">เช้า</option>
                                <option value="เย็น">เย็น</option>
                                <option value="ดึก">ดึก</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="location">
                        </div>
                    </div>
                    <div class="table-responsives overflow-auto ">
                        <table name="tableEditWODetail" id="tableEditWODetail"
                            class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                            <thead class="sticky-top table-defalut bg-gray">
                                <tr>
                                    <th style="width:100px;text-align:center">ลำดับ</th>
                                    <th style="width:100px;text-align:center">รหัสสินค้า</th>
                                    <th style="width:300px;text-align:left">รายการสินค้า</th>
                                    <th style="width:100px;text-align:center">จำนวน</th>
                                    <th style="width:100px;text-align:center">หน่วย</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn"
                            style="color:white;background : #BFACE2; text-shadow:2px 2px 4px #000000;"
                            data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmEditWO" class="btn"
                            style="color:white;background : #7e57c2; text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>