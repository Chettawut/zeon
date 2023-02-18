<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">Edit Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditStock" id="frmEditStock" method="POST" style="padding:10px;"
                action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">ProductCode</label>
                            <input type="text" class="form-control" name="stcode" id="stcode" minlength="6"
                                maxlength="9" required>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">ProductName</label>
                            <input type="text" class="form-control" name="stname1" id="stname1" required>
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Unit</label>
                            <select class="form-control" name="unit" id="unit">
                                <?php 
                                            
                                        	$sql = "SELECT * FROM `unit` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["unit"].'">'.$row["unit"].'</option>';
                                            }
                                    ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                    <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Min ขั้นต่ำ</label>
                            <input type="number" class="form-control" name="stmin1" id="stmin1" required>
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Min ขีดแดง</label>
                            <input type="number" class="form-control" name="stmin2" id="stmin2" required>
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Max</label>
                            <input type="number" class="form-control" name="stmax" id="stmax" required>
                        </div>
                    </div>

                    <div class="row">
                        

                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">ProductType</label>
                            <select class="form-control" name="type" id="type">
                                <option value="FG">Finish Goods</option>
                                <option value="SFG">Semi Finish Goods</option>
                                <option value="MAT">Material</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-6">
                            <label for="recipient-name" class="col-form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="Y">Active</option>
                                <option value="N">Inactive</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" id="code" name="code">
                    <div class="modal-footer">
                        <div class="col text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnEditSo" form="frmEditStock"
                                class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>