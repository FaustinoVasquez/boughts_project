<form id="extra-search-form">
    <div class="form-row align-items-center">
        <div class="col-sm-2">
            <label class="sr-only" for="hasCompatibility">Compatibility</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">?</div>
                </div>
                <input type="text" class="form-control" id="hasCompatibility" placeholder="Compatibility">
            </div>
        </div>

        <div class="form-row">
            <div class="col-auto">
                <label class="sr-only" for="hasManufacturer">Manufacturer</label>
                <select class="form-control myselect20" name="hasManufacturer" id="hasManufacturer">
                    <option value="">-- Select Manufacturer --</option>
                    @foreach($partNumbers as $partNumber)
                        <option value="{{$partNumber}}">{{$partNumber}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-auto">
                <label class="sr-only" for="hasCategory">Categories</label>
                <select class="form-control myselect20" name="hasCategory" id="hasCategory">
                    <option value="">--  Select category  --</option>
                    @foreach($categories as $category)
                        <option value="{{$category->CategoryID}}">{{$category->CategoryName}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-auto">
            <label class="sr-only" for="isCn">Is CN ?</label>
            <select class="form-control" name="isCn" id="isCn">
                <option value="0">-- Is CN ? --</option>
                <option value="1">True</option>
                <option value="2">False</option>
            </select>
        </div>

        <div class="col-auto">
            <div class="form-check">
                <input class="form-check-input custom-checkbox" type="checkbox" id="hasInventory" value="false">
                <label class="form-check-label" for="hasInventory">
                    Has Inventory
                </label>
            </div>
        </div>
        <div class="col-auto">
            <label class="sr-only" for="researchComplete">Research Complete ?</label>
            <select class="form-control" name="researchComplete" id="researchComplete">
                <option value="0">-- Research Complete ? --</option>
                <option value="1">True</option>
                <option value="2">False</option>
            </select>
        </div>

        <div class="col-auto mt-2">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>