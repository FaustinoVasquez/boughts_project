let $cleanLaunch = `
<form id="clean-launch-form" class="form-active">
    <ul id="myTab" class="nav nav-tabs">
         <li class="nav-item">
            <a href="#tab1" data-toggle="tab" class="nav-link active">SKU Data</a>
        </li>
        <li class="nav-item">
            <a href="#tab2" data-toggle="tab" class="nav-link">Amazon</a>
        </li>
        <li class="nav-item">
            <a href="#tab3" data-toggle="tab" class="nav-link">Ebay</a>
        </li>
        <li class="nav-item">
            <a href="#tab4" data-toggle="tab" class="nav-link">Description</a>
        </li>
        <li class="nav-item">
            <a href="#tab5" data-toggle="tab" class="nav-link">SEO</a>
        </li>
        <li class="nav-item">
            <a href="#tab6" data-toggle="tab" class="nav-link">Bullets</a>
        </li>
        <li class="nav-item">
            <a href="#tab7" data-toggle="tab" class="nav-link">Custom Fields</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="SKU">SKU:</label>
                                 <input type="text"
                                        class="form-control"
                                        name="SKU"
                                        id="SKU" readonly/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="UPC">UPC:</label>
                                <input type="text"
                                       class="form-control"
                                       name="UPC"
                                       id="UPC"
                                       maxlength="12"
                                       size="12"
                                       pattern="[0-9]+"
                                       onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Condition">Condition:</label>
                                <select class="form-control myselect2"
                                    name="Condition"
                                    id="Condition"
                                    data-allow-clear="1" required>
                                    <option value=""></option>
                                    <option value="New">New</option>
                                    <option value="Used">Used</option>
                                    <option value="CN">CN</option>
                                </select>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ASIN">ASIN:</label>
                                <input type="text"
                                       class="form-control"
                                       name="ASIN"
                                       id="ASIN"
                                       maxlength="15"
                                       size="15"/>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Brand">Brand:</label>
                                <select class="form-control myselect2"
                                name="Brand"
                                id="Brand"
                                data-allow-clear="1" required><option></option></select>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FloorPrice">Floor Price:</label>
                                        <input type="number"
                                               step="any"
                                               class="form-control"
                                               name="FloorPrice"
                                               id="FloorPrice" required/>
                                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="CeilingPrice">Ceiling Price:</label>
                                        <input type="number"
                                        step="any"
                                        class="form-control"
                                        name="CeilingPrice"
                                        id="CeilingPrice"
                                        required/>
                                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="PartNumber">PartNumber:</label>
                                <select class="form-control myselect2"
                                name="PartNumber"
                                id="PartNumber"
                                data-allow-clear="1" required><option></option></select>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
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
                        <label for="AmazonTitle">Amazon Title:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          cols="60"
                                          name="AmazonTitle"
                                          id="AmazonTitle"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AmazonCategory">Amazon Category:&nbsp;&nbsp;<small class="text-muted">Max (50) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          cols="60"
                                          name="AmazonCategory"
                                          id="AmazonCategory"
                                          class="form-control"
                                          maxlength="50" 
                                          size="50"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AmazonProductType">Amazon ProductType:&nbsp;&nbsp;<small class="text-muted">Max (50) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          name="AmazonProductType"
                                          id="AmazonProductType"
                                          class="form-control"
                                          maxlength="50" 
                                          size="50"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AmazonProductSubtype">Amazon Product Subtype:&nbsp;&nbsp;<small class="text-muted">Max (50) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          name="AmazonProductSubtype"
                                          id="AmazonProductSubtype"
                                          class="form-control"
                                          maxlength="50" 
                                          size="50"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="AmazonShipTemplate">Amazon Ship Template:&nbsp;&nbsp;<small class="text-muted">Max (20) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          name="AmazonShipTemplate"
                                          id="AmazonShipTemplate"
                                          class="form-control"
                                          maxlength="20" 
                                          size="20"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3">
            <div class="card panel my-3">
                <div class="card-body">
                     <div class="form-group">
                        <label for="eBayTitle">eBayTitle:&nbsp;&nbsp;<small class="text-muted">Max (80) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          name="eBayTitle"
                                          id="eBayTitle"
                                          class="form-control"
                                          maxlength="80" 
                                          size="80"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                         <label for="eBaySubtitle">eBaySubtitle:&nbsp;&nbsp;<small class="text-muted">Max (55) chars</small></label>
                        <div class="form-row">
                            <div class="col-md-9">
                                <textarea rows="3"
                                          name="eBaySubtitle"
                                          id="eBaySubtitle"
                                          class="form-control"
                                          maxlength="55" 
                                          size="55"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab4">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="MobileDescription">MobileDescription:&nbsp;&nbsp;<small class="text-muted">Max (800) chars</small></label>
                                  <textarea rows="4"
                                            name="MobileDescription"
                                            id="MobileDescription"
                                            class="form-control"
                                            maxlength="800" 
                                            size="800"
                                            style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="FullDescription">Full Description:&nbsp;&nbsp;<small class="text-muted">Max (2000) chars</small></label>
                                  <textarea rows="4"
                                            name="FullDescription"
                                            id="FullDescription"
                                            class="form-control"
                                            maxlength="2000" 
                                            size="2000"
                                            style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab5">
            <div class="card panel my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="SearchKeywords">SearchKeywords:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                                <textarea rows="4"
                                          name="SearchKeywords"
                                          id="SearchKeywords"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab6">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Bullet1">Bullet1:&nbsp;&nbsp;<small class="text-muted">Max (500) chars</small></label>
                                <textarea rows="2"
                                          name="Bullet1"
                                          id="Bullet1"
                                          class="form-control"
                                          maxlength="500" 
                                          size="500"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Bullet2">Bullet2:&nbsp;&nbsp;<small class="text-muted">Max (500) chars</small></label>
                                <textarea rows="2"
                                          name="Bullet2"
                                          id="Bullet2"
                                          class="form-control"
                                          maxlength="500" 
                                          size="500"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Bullet3">Bullet3:&nbsp;&nbsp;<small class="text-muted">Max (500) chars</small></label>
                                <textarea rows="2" 
                                          name="Bullet3" 
                                          id="Bullet3" 
                                          class="form-control"
                                          maxlength="500" 
                                          size="500"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Bullet3">Bullet3:&nbsp;&nbsp;<small class="text-muted">Max (500) chars</small></label>
                                <textarea rows="2"
                                          name="Bullet3"
                                          id="Bullet3"
                                          class="form-control"
                                          maxlength="500" 
                                          size="500"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Bullet4">Bullet4:&nbsp;&nbsp;<small class="text-muted">Max (500) chars</small></label>
                                <textarea rows="2" 
                                          name="Bullet4" 
                                          id="Bullet4" 
                                          class="form-control"
                                          maxlength="500" 
                                          size="500"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Bullet5">Bullet5:&nbsp;&nbsp;<small class="text-muted">Max (500) chars</small></label>
                                <textarea rows="2"
                                          name="Bullet5"
                                          id="Bullet5"
                                          class="form-control"
                                          maxlength="500" 
                                          size="500"
                                          style="min-width: 100%" required></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab7">
            <div class="card my-3">
                <div class="card-body">
                       <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="CustomField1">CustomField1:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                                <textarea rows="2" name="CustomField1" id="CustomField1" class="form-control"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="CustomField2">CustomField2:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                                <textarea rows="2"
                                          name="CustomField2"
                                          id="CustomField2"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="CustomField3">CustomField3:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                                <textarea rows="2"
                                          name="CustomField3"
                                          id="CustomField3"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="CustomField3">CustomField3:&nbsp;&nbsp;<small class="text-muted"> Max (200) chars</small></label>
                                <textarea rows="2"
                                          name="CustomField3"
                                          id="CustomField3"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="CustomField4">CustomField4:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                                <textarea rows="2"
                                          name="CustomField4"
                                          id="CustomField4"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="CustomField5">CustomField5:&nbsp;&nbsp;<small class="text-muted">Max (200) chars</small></label>
                                <textarea rows="2"
                                          name="CustomField5"
                                          id="CustomField5"
                                          class="form-control"
                                          maxlength="200" 
                                          size="200"
                                          style="min-width: 100%"></textarea>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
`;