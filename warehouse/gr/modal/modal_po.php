<!-- Modal table_id -->
<div class="modal fade bd-example-modal-xl" id="modal_po" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">เลือกใบสั่งซื้อจากผู้ขาย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <table id="table_po" name="table_stock" class="table table-bordered table-striped">
                                <thead style=" background-color:#D6EAF8;">
                                    <tr>
                                        <th></th>
                                        <th>ลำดับ</th>
                                        <th>เลขที่ใบสั่งซื้อ</th>
                                        <th>รหัสพัสดุ</th>
                                        <th>รายการ</th>
                                        <th>หน่วย</th>
                                        <th>จำนวนสั่งซื้อ</th>
                                        <th>จำนวนที่รับแล้ว</th>
                                        <th>สถานะ</th>

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="btnAddPO" form="frmPO" class="btn btn-primary">ตกลง</button>
                </div>

            </div>
        </div>
    </div>
</div>