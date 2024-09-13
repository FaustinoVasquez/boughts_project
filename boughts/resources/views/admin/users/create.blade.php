@extends('layouts.default')

@section('content')
    @card
    @slot('header','Create New User')
    @slot('type','panel-warning')
    <form method="POST" action="{{ route('admin.users.store') }}"
          class="form-horizontal form-bordered">
        @include('admin.users.shared._fields')

        <div class="form-group">
            <div class="row">
                <label for="submit" class="col-md-3 control-label"></label>
                <div class="col-md-6">
                    <button type="submit" class="button btn-block button-rounded button-primary button-large">
                        {{ __('Register User') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
    @endcard
@endsection

@push('header_styles')
    <link rel="stylesheet" href="{{asset('css/form_layouts.css')}}">
    <link rel="stylesheet" href="{{asset('library/Buttons/css/buttons.css')}}">
    <link rel="stylesheet" href="{{asset('css/advbuttons.css')}}">
@endpush

@push('footer_scripts')
    <script src="{{asset('js/form_layouts.js')}}"></script>
    <script src="{{asset('library/Buttons/js/buttons.js')}}"></script>
@endpush
