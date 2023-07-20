<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">Edit Production Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditSO" id="frmEditSO" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-3 col-12">
                            <label class="col-form-label">PP No.</label>
                            <input type="text" class="form-control" name="editsfcode" id="editsfcode" disabled>
                        </div>
                        <div class="form-group col-lg-5 col-12">
                            <label class="col-form-label">PP Date</label>
                            <input type="date" class="form-control" size="4" name="editsfdate" id="editsfdate">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-12">
                            <label for="comment">หมายเหตุ:</label>
                            <textarea class="form-control" rows="2" name="editremark" id="editremark"></textarea>
                        </div>
                    </div>

                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">

                            <button type="button" id="btnAddSOdetail2" class="btn btn-success" data-toggle="modal"
                                data-target="#modal_stock2"><i class="fa fa fa-tags" aria-hidden="true"></i>
                                เพิ่มรายการ</button>

                            <button type="button" id="btnCancel" style="display:none" class="btn btn-danger"><i
                                    class="fa fa-times-circle" aria-hidden="true"></i>
                                ยกเลิกใบสั่งขาย</button>
                            <button type="button" id="btnActive" style="display:none" class="btn btn-warning"><i
                                    class="fa fa-check-circle" aria-hidden="true"></i>
                                คืนค่าให้ใบสั่งขาย</button>
                        </div>
                    </div>
                    <br>

                    <table name="tableEditSODetail" id="tableEditSODetail" class="table table-bordered table-striped">
                        <thead style="background-color:#D6EAF8;">
                            <tr>
                                <th style="width:10%;text-align:center">No.</th>
                                <th style="width:15%;text-align:center">Product Code</th>
                                <th style="width:35%;text-align:center">Product Name</th>
                                <th style="width:15%;text-align:center">Amount</th>
                                <th style="width:15%;text-align:center">Unit</th>
                                <th style="width:10%;text-align:center"></th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmEditSO" class="btn btn-primary">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>