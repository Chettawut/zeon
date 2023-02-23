<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">เพิ่มลูกค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmAddCustomer" id="frmAddCustomer" method="POST" style="padding:10px;"
                    action="javascript:void(0);">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">รหัสลูกค้า</label>
                            <input type="text" class="form-control" name="add_cuscode" id="add_cuscode" minlength="4"
                                maxlength="4" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                            <input type="text" class="form-control" name="add_cusname" id="add_cusname" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">เลขที่</label>
                            <input type="text" class="form-control" name="add_idno" id="add_idno">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">ถนน</label>
                            <input type="text" class="form-control" name="add_road" id="add_road">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">ตำบล</label>
                            <input type="text" class="form-control" name="add_subdistrict" id="add_subdistrict">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">อำเภอ</label>
                            <input type="text" class="form-control" name="add_district" id="add_district">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">จังหวัด</label>
                            <select class="form-control" name="add_province" id="add_province">
                                <?php getProvince();?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" name="add_zipcode" id="add_zipcode">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="recipient-name" class="col-form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="add_tel" id="add_tel">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="recipient-name" class="col-form-label">เบอร์แฟ็ค</label>
                            <input type="text" class="form-control" name="add_fax" id="add_fax">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="recipient-name" class="col-form-label">เลขผู้เสียภาษี</label>
                            <input type="text" class="form-control" name="add_taxnumber" id="add_taxnumber">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="text" class="form-control" name="add_email" id="add_email">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit"  form="frmAddCustomer"
                        class="btn btn-primary">เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>
</div>