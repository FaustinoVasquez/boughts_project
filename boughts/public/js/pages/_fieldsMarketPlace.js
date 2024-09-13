let $createMktFields = `
<form id="create-mkt-form" class="form-active">
    <div class="card panel my-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="SKU" value="">SKU</label>
                        <select class="form-control myselect2 mySku"
                        name="SKU"
                        id="SKU"
                        data-allow-clear="1"><option>--SELECT--</option></select>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Condition">Condition</label>
                        <select class="form-control myselect2"
                        name="Condition"
                        id="Condition"
                        data-allow-clear="1">
                            <option></option>
                            <option value="New"selected>New</option>
                            <option value="Used - Like New"> Used - Like New</option>
                            <option value="Used - Very Good"> Used - Very Good</option>
                            <option value="Refurbished"> Refurbished</option>
                        </select>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="FulfillmentType">Fulfillment Type</label>
                       <select class="form-control myselect2"
                        name="FulfillmentType"
                        id="FulfillmentType"
                        data-allow-clear="1">
                            <option></option>
                            <option value="Amazon" selected>Amazon</option>
                            <option value="Merchant">Merchant</option>
                            <option value="Walmart">Walmart</option>
                        </select>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MerchantSKU">Merchant SKU</label>
                        <input type="text" class="form-control" name="MerchantSKU" id="MerchantSKU" readonly/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ASIN">ASIN</label>
                        <input type="text" class="form-control" name="ASIN" id="ASIN"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row my-6">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="IsCN">
                                <input type="checkbox" name="IsCN" class="custom-checkbox" id="IsCN">
                                Is CN</label>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="IsSnL">
                                <input type="checkbox" name="IsSnL" class="custom-checkbox" id="IsSnL">
                                Is SnL</label>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Floor">Floor</label>
                        <input type="number" class="form-control" name="Floor" id="Floor"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="Ceiling">Ceiling</label>
                         <input type="text" class="form-control" name="Ceiling" id="Ceiling"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>`;

let $updateMktFields = `
<form id="update-mkt-form" class="form-active">
    <div class="card panel my-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="SKU">SKU</label>
                        <select class="form-control myselect2"
                        name="SKU"
                        id="SKU"
                        data-allow-clear="1"><option value="">--SELECT--</option></select>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Condition">Condition</label>
                        <select class="form-control myselect2"
                        name="Condition"
                        id="Condition"
                        data-allow-clear="1">
                            <option></option>
                            <option value="New">New</option>
                            <option value="Used - Like New">Used - Like New</option>
                            <option value="Used - Very Good">Used - Very Good</option>
                            <option value="Refurbished">Refurbished</option>
                        </select>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="FulfillmentType">Fulfillment Type</label>
                       <select class="form-control myselect2"
                        name="FulfillmentType"
                        id="FulfillmentType"
                        data-allow-clear="1">
                            <option></option>
                            <option value="Amazon">Amazon</option>
                            <option value="Merchant">Merchant</option>
                            <option value="Walmart">Walmart</option>
                        </select>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MerchantSKU">Merchant SKU</label>
                        <input type="text" class="form-control" name="MerchantSKU" id="MerchantSKU" readonly/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ASIN">ASIN</label>
                        <input type="text" class="form-control" name="ASIN" id="ASIN"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row my-6">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="IsCN">
                                <input type="checkbox" name="IsCN" class="custom-checkbox" id="IsCN">
                                Is CN</label>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="IsSnL">
                                <input type="checkbox" name="IsSnL" class="custom-checkbox" id="IsSnL">
                                Is SnL</label>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Floor">Floor</label>
                        <input type="number" class="form-control" name="Floor" id="Floor"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="Ceiling">Ceiling</label>
                         <input type="number" class="form-control" name="Ceiling" id="Ceiling"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>`;

let $updateBulkFields =`
<form id="update-bulk-form" class="form-active">
    <div class="form-group">
        <label for="bulkFloorPrice">Foor Price</label>
        <input type="number" class="form-control" name="bulkFloorPrice" id="bulkFloorPrice" required/>
        <span class="invalid-feedback" role="alert"><strong></strong></span>
    </div>
     <div class="form-group">
        <label for="bulkCeilingPrice">Ceilinig Price</label>
        <input type="number" class="form-control" name="bulkCeilingPrice" id="bulkCeilingPrice" required/>
        <span class="invalid-feedback" role="alert"><strong></strong></span>
    </div>
 </form>
`;

let $deleteBulkFields =`
<form id="delete-bulk-form" class="form-active">
 </form>
`;
