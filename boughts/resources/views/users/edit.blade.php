@extends('layouts.default')

@section('content')
    @card
    @slot('header','Edit a User')
    @slot('type','panel-success')


    <form method="POST" action="{{ route('users.update',$user) }}"
          class="form-horizontal form-bordered">
        {{method_field('PUT')}}
        @include('admin.users.shared._fields')
        <div class="form-group striped-col">
            <div class="row">
                <label for="submit" class="col-md-3 control-label"></label>
                <div class="col-md-6">
                    <button type="submit" class="button btn-block button-rounded button-primary button-large">
                        {{ __('Update User Information') }}
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
    <link rel="stylesheet" href="{{asset('library/iCheck/css/all.css')}}">
@endpush

@push('footer_scripts')
    <script src="{{asset('js/form_layouts.js')}}"></script>
    <script src="{{asset('library/Buttons/js/buttons.js')}}"></script>
    <script src="{{ asset('library/iCheck/js/icheck.js') }}"></script>
@endpush
