<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">Add Production Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmAddSO" id="frmAddSO" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-3 col-12">
                            <label class="col-form-label">PP No.</label>
                            <input type="text" class="form-control" name="socode" id="socode" disabled>
                        </div>
                        <div class="form-group col-lg-5 col-12">
                            <label class="col-form-label">PP Date</label>
                            <input type="date" class="form-control" name="sfdate" id="sfdate">
                        </div>
                           
                    </div>
                    <div class="row">
                    <div class="form-group col-lg-12 col-12">
                            <label for="comment">หมายเหตุ:</label>
                            <textarea class="form-control" rows="2" name="remark" id="remark"></textarea>
                        </div>  
                    </div>

                    <br>
                    <div class="form-group col-md-12">
                        <button type="button" id="btnAddSOdetail" class="btn btn-success" data-toggle="modal"
                            data-target="#modal_stock"><i class="fa fa fa-tags" aria-hidden="true"></i>
                            Add Finished Goods</button>

                        <!-- <button type="button" id="btnAddSOGiveaway" class="btn btn-info" data-toggle="modal"
                            data-target="#modal_giveaway"><i class="fa fa fa-gift" aria-hidden="true"></i>
                            เพิ่มของแถม</button> -->

                    </div>


                    <table name="tableSODetail" id="tableSODetail" class="table table-bordered table-striped">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="frmAddSO" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>