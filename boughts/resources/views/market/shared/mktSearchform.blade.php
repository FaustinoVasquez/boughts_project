<form id="mkt-search-form">
    <div class="form-row align-items-center">
        <div class="col-auto">
            <label class="sr-only" for="condition">Condition</label>
            <select class="form-control" name="condition" id="condition">
                <option value="">-- Condition --</option>
                <option value="New">New</option>
                <option value="Used - Like New">Used - Like New</option>
                <option value="Used - Very Good">Used - Very Good</option>
                <option value="Refurbished">Refurbished</option>
            </select>
        </div>
        <div class="col-auto">
            <label class="sr-only" for="fulfillment">Fulfillment</label>
            <select class="form-control" name="fulfillment" id="fulfillment">
                <option value="">-- Fulfillment --</option>
                <option value="Amazon">Amazon</option>
                <option value="Merchant">Merchant</option>
                <option value="Wallmart">Wallmart</option>
            </select>
        </div>
        <div class="col-auto">
            <label class="sr-only" for="isCN">Is CN ?</label>
            <select class="form-control" name="isCN" id="isCN">
                <option value="">-- Is CN ? --</option>
                <option value="true">True</option>
                <option value="false">False</option>
            </select>
        </div>
        <div class="col-auto mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>