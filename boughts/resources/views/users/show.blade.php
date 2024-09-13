@extends('layouts.default')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-heading">
                        <h3 class="card-title">
                            {{$user->fullname}}, Profile
                        </h3>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-file">
                                    <img src="{{asset('img/authors/no_avatar.jpg')}}" alt="..."
                                         class="img-fluid">
                                </div>
                                <div class="my-4">
                                    <div class="row">
                                        @if(auth()->user()->isAdmin())
                                            <div class="col-md-6">
                                                <a href="{{route('admin.users.index')}}"
                                                   class="button btn-block button-primary button-jumbo">Return Users</a>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <a href="{{route('users.edit',$user)}}"
                                               class="button btn-block button-warning button-jumbo">Edit User</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                    <table class="table table-bordered table-striped" id="users">
                                        <tbody>
                                        <tr>
                                            <td>First Name</td>
                                            <td>
                                                <p class="user_name_max">{{$user->Name}}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>
                                                <p class="user_name_max">{{$user->LastName}}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>E-mail</td>
                                            <td>
                                                {{$user->Email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>User Name</td>
                                            <td>
                                                {{$user->Username}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Profile</td>
                                            <td>
                                                {{$user->Profile}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                {{!$user->deleted_at?'Activated':'Deleted'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created At</td>
                                            <td>
                                                {{$user->HashDate->diffForHumans()}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header_styles')
    <link rel="stylesheet" href="{{asset('library/Buttons/css/buttons.css')}}">
    <link rel="stylesheet" href="{{asset('css/advbuttons.css')}}">
@endpush

@push('footer_scripts')
    <link rel="stylesheet" href="{{asset('library/Buttons/js/buttons.js')}}">
@endpush