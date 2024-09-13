let $createSkuFields = `
<form id="create-sku-form" class="form-active">
    <ul id="myTab" class="nav nav-tabs">
         <li class="nav-item">
            <a href="#tab1" data-toggle="tab" class="nav-link active">SKU Data</a>
        </li>
        <li class="nav-item">
            <a href="#tab2" data-toggle="tab" class="nav-link">Compatibility</a>
        </li>
        <li class="nav-item">
            <a href="#tab3" data-toggle="tab" class="nav-link">Shipping Dimensions</a>
        </li>
        <li class="nav-item">
            <a href="#tab4" data-toggle="tab" class="nav-link">US</a>
        </li>
        <li class="nav-item">
            <a href="#tab5" data-toggle="tab" class="nav-link">EU</a>
        </li>
        <li class="nav-item">
            <a href="#tab6" data-toggle="tab" class="nav-link">WholeSale</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="SKU">SKU</label>
                                <input type="text" class="form-control" name="SKU" id="SKU"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" name="Manufacturer" id="Manufacturer"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="PartNumber">Part Number</label>
                                <input type="text" class="form-control" name="PartNumber" id="PartNumber"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CategoryID">Category Name</label>
                                <select class="form-control myselect2"
                                name="CategoryID"
                                id="CategoryID"
                                data-allow-clear="1"><option></option></select>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="AlternatePN2">Alternate Part Number</label>
                                <input type="text" class="form-control" name="AlternatePN2" id="AlternatePN2"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ResearchComplete">
                                        <input type="checkbox" name="ResearchComplete" class="custom-checkbox" id="ResearchComplete">
                                        Research Complete</label>
                                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="AlternatePN">Legal Part Number</label>
                                <input type="text" class="form-control" name="AlternatePN" id="AlternatePN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                         
                        <div class="col-md-6">
                            <div class="row my-4">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="HaveCNVariant">
                                        <input type="checkbox" name="HaveCNVariant" class="custom-checkbox" id="HaveCNVariant">
                                        Have CN Variant</label>
                                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab2">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for="OriginallySuppliedWith">Originally Supplied With</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" cols="60" name="OriginallySuppliedWith" id="OriginallySuppliedWith"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-4">
                               <button type="button" id="btn-original-supplied-with"
                                    class="button button-rounded button-warning button-large btn-block" 
                                    data-toggle="modal"      
                                    data-target="#myModal2">Check</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AlsoCompatibleWith">Also Compatible With</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" cols="60" name="AlsoCompatibleWith" id="AlsoCompatibleWith"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-4">
                               <button type="button" id="btn-also-compatible-with"
                                    class="button button-rounded button-warning button-large btn-block" 
                                    data-toggle="modal"      
                                    data-target="#myModal2">Check</button> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="WebDescription">Web Description</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" name="WebDescription" id="WebDescription"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-3"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Notes">Notes</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" name="Notes" id="Notes"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Length">Length (Inches)</label>
                                <input type="number" step="any" class="form-control" name="Length" id="Length" value="8"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Width">Width (Inches)</label>
                                <input type="number" step="any" class="form-control" name="Width" id="Width" value="2"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Height">Height (Inches)</label>
                                <input type="number" step="any" class="form-control" name="Height" id="Height" value="0.5"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="WeightOz">weight (lbs)</label>
                                <input type="number" step="any" class="form-control" name="WeightOz" id="WeightOz" value="0.2"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab4">
            <div class="card panel-yellow my-3">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FloorPrice">Floor Price OEM</label>
                                <input type="number" step="any" class="form-control" name="FloorPrice" id="FloorPrice" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CeilingPrice">Ceiling Price OEM</label>
                                <input type="number" step="any" class="form-control" name="CeilingPrice" id="CeilingPrice" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="UnitCost">Unit Cost OEM</label>
                                <input type="number" step="any" class="form-control" name="UnitCost" id="UnitCost" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FloorPriceCN">Floor Price CN</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceCN" id="FloorPriceCN" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CeilingPriceCN">Ceiling Price CN</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceCN" id="CeilingPriceCN" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="UnitCostCN">Unit Cost CN</label>
                                <input type="number" step="any" class="form-control" name="UnitCostCN" id="UnitCostCN" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FloorPriceUSED">Floor Price USED</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceUSED" id="FloorPriceUSED" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CeilingPriceUSED">Ceiling Price USED</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceUSED" id="CeilingPriceUSED" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="UnitCostUSED">Unit Cost USED</label>
                                <input type="number" step="any" class="form-control" name="UnitCostUSED" id="UnitCostUSED" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab5">
            <div class="card panel-green my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FloorPriceEU">Floor Price EU</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceEU" id="FloorPriceEU" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CeilingPriceEU">Ceiling Price EU</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceEU" id="CeilingPriceEU" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FloorPriceEUCN">Floor Price EU CN</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceEUCN" id="FloorPriceEUCN" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CeilingPriceEUCN">Ceiling Price EU CN</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceEUCN" id="CeilingPriceEUCN" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FloorPriceEUUSED">Floor Price EU Used</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceEUUSED" id="FloorPriceEUUSED" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CeilingPriceEUUSED">Ceiling Price EU Used</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceEUUSED" id="CeilingPriceEUUSED" value="299.99"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab6">
          <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Wholesale ml-2">
                                    <input type="checkbox" 
                                            name="Wholesale" 
                                            class="custom-checkbox" 
                                            id="Wholesale">
                                            &nbsp;&nbsp; Wholesale </label>
                                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                                </div>
                            </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="WholesalePrice">Wholesale Price</label>
                                    <div class="input-group">
                                         <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"
                                                class="form-control"
                                                name="WholesalePrice"
                                                id="WholesalePrice"
                                                step="0.01" disabled/>
                                    </div>      
                                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group ">
                                    <label for="WholesaleInvPercent">Wholesale Inv Percent</label>
                                     <div class="input-group">
                                        <input type="number"
                                                class="form-control"
                                                name="WholesaleInvPercent"
                                                id="WholesaleInvPercent" disabled/>
                                                
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
   
                                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>`;

let $updateSkuFields = `
<form id="update-sku-form" class="form-active">
    <ul id="myTab" class="nav nav-tabs">
         <li class="nav-item">
            <a href="#tab1" data-toggle="tab" class="nav-link active">SKU Data</a>
        </li>
        <li class="nav-item">
            <a href="#tab2" data-toggle="tab" class="nav-link">Compatibility</a>
        </li>
        <li class="nav-item">
            <a href="#tab3" data-toggle="tab" class="nav-link">Shipping Dimensions</a>
        </li>
        <li class="nav-item">
            <a href="#tab4" data-toggle="tab" class="nav-link">US</a>
        </li>
        <li class="nav-item">
            <a href="#tab5" data-toggle="tab" class="nav-link">EU</a>
        </li>
        <li class="nav-item">
            <a href="#tab6" data-toggle="tab" class="nav-link">WholeSale</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="SKU">SKU</label>
                                <input type="text" class="form-control" name="SKU" id="SKU"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" name="Manufacturer" id="Manufacturer"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="PartNumber">Part Number</label>
                                <input type="text" class="form-control" name="PartNumber" id="PartNumber"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CategoryID" class="mt-1 mb-2">Category Name</label>
                                <select class="form-control myselect2"
                                name="CategoryID"
                                id="CategoryID"
                                data-allow-clear="1"><option></option></select>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="AlternatePN2">Alternate Part Number</label>
                                <input type="text" class="form-control" name="AlternatePN2" id="AlternatePN2"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ResearchComplete">
                                        <input type="checkbox" name="ResearchComplete" class="custom-checkbox" id="ResearchComplete">
                                        Research Complete</label>
                                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="AlternatePN">Legal Part Number</label>
                                <input type="text" class="form-control" name="AlternatePN" id="AlternatePN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                         
                        <div class="col-md-6">
                            <div class="row my-4">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="HaveCNVariant">
                                        <input type="checkbox" name="HaveCNVariant" class="custom-checkbox" id="HaveCNVariant">
                                        Have CN Variant</label>
                                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab2">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for="OriginallySuppliedWith">Originally Supplied With</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" cols="60" name="OriginallySuppliedWith" id="OriginallySuppliedWith"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-4">
                            <button type="button" id="btn-original-supplied-with"
                                    class="button button-rounded button-primary button-large btn-block" 
                                    data-toggle="modal"      
                                    data-target="#myModal2">Check</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AlsoCompatibleWith">Also Compatible With</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" cols="60" name="AlsoCompatibleWith" id="AlsoCompatibleWith"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-4">
                             <button type="button" id="btn-also-compatible-with"
                                    class="button button-rounded button-primary button-large btn-block" 
                                    data-toggle="modal"      
                                    data-target="#myModal2">Check</button> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="WebDescription">Web Description</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" name="WebDescription" id="WebDescription"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-3"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Notes">Notes</label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="4" name="Notes" id="Notes"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <div class="col my-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Length">Length (Inches)</label>
                                <input type="number" step="any" class="form-control" name="Length" id="Length"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Width">Width (Inches)</label>
                                <input type="number" step="any" class="form-control" name="Width" id="Width"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Height">Height (Inches)</label>
                                <input type="number" step="any" class="form-control" name="Height" id="Height"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="WeightOz">weight (lbs)</label>
                                <input type="number" step="any" class="form-control" name="WeightOz" id="WeightOz"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab4">
            <div class="card panel-yellow my-3">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FloorPrice">Floor Price OEM</label>
                                <input type="number" step="any" class="form-control" name="FloorPrice" id="FloorPrice"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CeilingPrice">Ceiling Price OEM</label>
                                <input type="number" step="any" class="form-control" name="CeilingPrice" id="CeilingPrice"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="UnitCost">Unit Cost OEM</label>
                                <input type="number" step="any" class="form-control" name="UnitCost" id="UnitCost"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FloorPriceCN">Floor Price CN</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceCN" id="FloorPriceCN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CeilingPriceCN">Ceiling Price CN</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceCN" id="CeilingPriceCN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="UnitCostCN">Unit Cost CN</label>
                                <input type="number" step="any" class="form-control" name="UnitCostCN" id="UnitCostCN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FloorPriceUSED">Floor Price USED</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceUSED" id="FloorPriceUSED"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CeilingPriceUSED">Ceiling Price USED</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceUSED"
                                       id="CeilingPriceUSED"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="UnitCostUSED">Unit Cost USED</label>
                                <input type="number" step="any" class="form-control" name="UnitCostUSED" id="UnitCostUSED"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab5">
            <div class="card panel-green my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FloorPriceEU">Floor Price EU</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceEU" id="FloorPriceEU"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CeilingPriceEU">Ceiling Price EU</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceEU" id="CeilingPriceEU"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FloorPriceEUCN">Floor Price EU CN</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceEUCN" id="FloorPriceEUCN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CeilingPriceEUCN">Ceiling Price EU CN</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceEUCN"
                                       id="CeilingPriceEUCN"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FloorPriceEUUSED">Floor Price EU Used</label>
                                <input type="number" step="any" class="form-control" name="FloorPriceEUUSED"
                                       id="FloorPriceEUUSED"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="CeilingPriceEUUSED">Ceiling Price EU Used</label>
                                <input type="number" step="any" class="form-control" name="CeilingPriceEUUSED"
                                       id="CeilingPriceEUUSED"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab6">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Wholesale">
                                    <input type="checkbox" 
                                            name="Wholesale" 
                                            class="custom-checkbox" 
                                            id="Wholesale"> Wholesale</label>
                                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                                </div>
                            </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="WholesalePrice">Wholesale Price</label>
                                    <div class="input-group">
                                         <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"
                                                class="form-control"
                                                name="WholesalePrice"
                                                id="WholesalePrice"
                                                step="0.01" disabled/>
                                    </div>      
                                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="WholesaleInvPercent">Wholesale Inv Percent</label>
                                     <div class="input-group">
                                        <input type="number"
                                                class="form-control"
                                                name="WholesaleInvPercent"
                                                id="WholesaleInvPercent" disabled/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>`;

let $partNumberFields = `
<div id="show-partNumber-form" class="card panel my-3">
    <div class="card-body">
        <div class="form-group">
            <label for="OriginallySuppliedWith">Originally Supplied With</label>
            <div class="form-row">
                <div class="col-md-9">
                    <textarea rows="4" cols="60" name="OriginallySuppliedWith" id="OriginallySuppliedWith"
                              style="min-width: 100%"></textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="col my-4">
                    <button class="copy-info button button-rounded button-primary button-large btn-block">Copy</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Also Compatible With</label>
            <div class="form-row">
                <div class="col-md-9">
                    <textarea rows="4" cols="60" name="AlsoCompatibleWith" id="AlsoCompatibleWith"
                              style="min-width: 100%"></textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="col my-4">
                    <button class="copy-info button button-rounded button-primary button-large btn-block">Copy</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Notes</label>
            <div class="form-row">
                <div class="col-md-9">
                    <textarea rows="4" name="Notes" id="Notes"
                              style="min-width: 100%"></textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="col my-4">
                    <button class="copy-info button button-rounded button-primary button-large btn-block">Copy</a>
                </div>
            </div>
        </div>
    </div>
</div>`;

let $newPricesFields = `
<form id="update-new-prices" class="form-active">
    <div class="card panel my-3">
    <div class="card-body">
        <div class="row ">
            <div class="col">
                <div class="form-group">
                    <label for="FloorPrice">Floor Price OEM</label>
                    <input type="number" step="any" class="form-control" name="FloorPrice" id="FloorPrice"/>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="CeilingPrice">Ceiling Price OEM</label>
                    <input type="number" step="any" class="form-control" name="CeilingPrice" id="CeilingPrice"/>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="UnitCost">Unit Cost OEM</label>
                    <input type="number" step="any" class="form-control" name="UnitCost" id="UnitCost"/>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
            </div>
        </div>
    </div>
</div>
</form>`;

let $cnPricesFields = `   
<form id="update-cn-prices" class="form-active">
    <div class="card panel my-3">
        <div class="card-body">      
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="FloorPriceCN">Floor Price CN</label>
                        <input type="number" step="any" class="form-control" name="FloorPriceCN" id="FloorPriceCN"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="CeilingPriceCN">Ceiling Price CN</label>
                        <input type="number" step="any" class="form-control" name="CeilingPriceCN" id="CeilingPriceCN"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="UnitCostCN">Unit Cost CN</label>
                        <input type="number" step="any" class="form-control" name="UnitCostCN" id="UnitCostCN"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>`;

let $usedPricesFields = ` 
<form id="update-used-prices" class="form-active">
    <div class="card panel my-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="FloorPriceUSED">Floor Price USED</label>
                        <input type="number" step="any" class="form-control" name="FloorPriceUSED" id="FloorPriceUSED"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="CeilingPriceUSED">Ceiling Price USED</label>
                        <input type="number" step="any" class="form-control" name="CeilingPriceUSED"
                               id="CeilingPriceUSED"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="UnitCostUSED">Unit Cost USED</label>
                        <input type="number" step="any" class="form-control" name="UnitCostUSED" id="UnitCostUSED"/>
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>`;

let $qtyUSDetails = ` 
<ul id="qtyUSTab" class="nav nav-tabs">
    <li class="nav-item">
        <a href="#skuUSDetails" data-toggle="tab" class="nav-link active">SKU Data</a>
       
    </li>
    <li class="nav-item">
        <a href="#skuUSHistory" data-toggle="tab" class="nav-link">SKU History</a>
    </li>      
</ul>
 <div class="tab-content">
    <div class="tab-pane fade show active" id="skuUSDetails">
        <div class="card panel my-3">
            <div class="card-body">
                 <table class="table table-striped table-bordered table-hover" id="bin-stock-us-table" width="100%">
                    <thead>
                        <tr>
                            <th>BinID</th>
                            <th>StockQty</th>
                            <th>ScanCode</th>
                        </tr>
                    </thead>
                 </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade show" id="skuUSHistory">
        <div class="card panel my-3">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover display nowrap" id="bin-history-us-table"  width="100%">
                    <thead>
                        <tr>
                            <th>BinID</th>
                            <th>SKU</th>
                            <th>Qty</th>
                            <th>Flow</th>
                            <th>ScanCode</th>
                            <th>ScanType</th>
                            <th>CreateUser</th>
                            <th>CreateDate</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
 </div>`;

let $qtyEUDetails = ` 
<ul id="qtyEUTab" class="nav nav-tabs">
    <li class="nav-item">
        <a href="#skuEUDetails" data-toggle="tab" class="nav-link active">SKU Data</a>
       
    </li>
    <li class="nav-item">
        <a href="#skuEUHistory" data-toggle="tab" class="nav-link">SKU History</a>
    </li>      
</ul>
 <div class="tab-content">
    <div class="tab-pane fade show active" id="skuEUDetails">
        <div class="card panel my-3">
            <div class="card-body">
                 <table class="table table-striped table-bordered table-hover" id="bin-stock-eu-table" width="100%">
                    <thead>
                        <tr>
                            <th>BinID</th>
                            <th>StockQty</th>
                            <th>ScanCode</th>
                        </tr>
                    </thead>
                 </table>
            </div>
        </div>
    </div>
      <div class="tab-pane fade show" id="skuEUHistory">
        <div class="card panel my-3">
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover display nowrap" id="bin-history-eu-table" >
                    <thead>
                        <tr>
                            <th>BinID</th>
                            <th>SKU</th>
                            <th>Qty</th>
                            <th>Flow</th>
                            <th>ScanCode</th>
                            <th>ScanType</th>
                            <th>CreateUser</th>
                            <th>CreateDate</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
 </div>`;

let $tableImages = `
<div class="row">
    <div class="col-md-2">
         <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image001">
        </a>
    </div>
    <div class="col-md-4">
          <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage01">Upload Image 1:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage01">
                </div>
          </form>
    </div>
    <div class="col-md-2">
      <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image002">
        </a>
    </div>
    <div class="col-md-4">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage02">Upload Image 2:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage02">
                </div>
          </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-2">
         <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image003">
        </a>
    </div>
     <div class="col-md-4">
          <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage03">Upload Image 3:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage03">
                </div>
          </form>
    </div>
    <div class="col-md-2">
      <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image004">
        </a>
    </div>
    <div class="col-md-4">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage04">Upload Image 4:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage04">
                </div>
          </form>
    </div>
</div>
<hr>
<div class="row">
<div class="col-md-2">
     <a href="#" target="_blank">
        <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image005">
    </a>
</div>
    <div class="col-md-4">
          <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage05">Upload Image 5:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage05">
                </div>
          </form>
    </div>
    <div class="col-md-2">
      <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image006">
        </a>
    </div>
    <div class="col-md-4">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage06">Upload Image 6:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage06">
                </div>
          </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-2">
         <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image007">
        </a>
    </div>
     <div class="col-md-4">
          <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage07">Upload Image 7:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage07">
                </div>
          </form>
    </div>
    <div class="col-md-2">
      <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image008">
        </a>
    </div>
    <div class="col-md-4">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage08">Upload Image 8:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage08">
                </div>
          </form>
    </div>
</div>
<hr>S
<div class="row">
    <div class="col-md-2">
         <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="image009">
        </a>
    </div>
     <div class="col-md-4">
          <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage09">Upload Image 9:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage09">
                </div>
          </form>
    </div>
    <div class="col-md-2">
      <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="010">
        </a>
    </div>
    <div class="col-md-4">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage0">Upload Image 10:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage10">
                </div>
          </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-2">
         <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="011">
        </a>
    </div>
     <div class="col-md-4">
          <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage011">Upload Image 11:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage011">
                </div>
          </form>
    </div>
    <div class="col-md-2">
      <a href="#" target="_blank">
            <img src="http://remotespict.mitechnologiesinc.com/no_image.png" alt="#" width="100" height="100" id="012">
        </a>
    </div>
    <div class="col-md-4">
        <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="UImage012">Upload Image 12:</label>
                     <input data-preview="#preview" name="input_img" type="file" id="UImage012">
                </div>
          </form>
    </div>
</div>
`;

let $cleanCompatibility = `
<form id="clean-compatibility-form" class="form-active">
    <div class="card panel my-3">
        <div class="card-body">
            <div class="form-group">
                <label for="before">Before</label>
                <div class="form-row">
                    <textarea rows="4" cols="60" name="before" id="before"
                              style="min-width: 100%"></textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
            </div>
            <div class="form-group">
                <label for="after">After</label>
                <div class="form-row">
                    <textarea rows="4" cols="60" name="after" id="after"
                              style="min-width: 100%"></textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>     
                </div>
            </div>
        </div>
    </div>
</form>
`;
