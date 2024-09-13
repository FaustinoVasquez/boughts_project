<div class="modal" tabindex="-1" role="dialog" aria-hidden="false" id="myModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="success">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" aria-hidden="false" id="myModal2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h2 class="modal-title">Clean compatibility</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  data-dismiss="modal" id="compatibility-apply">Apply</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" aria-hidden="false" id="myModal3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="save-same">Save-Next Same SKU</button>
                <button type="button" class="btn btn-success" id="save-new">Save-Next New SKU</button>
                <button type="button" class="btn btn-primary" id="success">Save changes</button>
                <button type="button" class="btn btn-primary" id="save-bulk">Update Bulk</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

@push('header_styles')
    {{--<link rel="stylesheet" href="{{ asset('library/modal/css/component.css')}}"/>--}}
    {{--<link rel="stylesheet" href="{{asset('css/advmodals.css')}}">--}}
    <link rel="stylesheet" href="{{asset('library/Buttons/css/buttons.css')}}">
    <link rel="stylesheet" href="{{asset('css/advbuttons.css')}}">

@endpush

@push('footer_scripts')
    <script src="{{asset('library/Buttons/js/buttons.js')}}"></script>
    <script src="{{ asset('library/modal/js/classie.js')}}"></script>
@endpush