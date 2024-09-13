
@if($status!='inactive')
<a href="{{route('users.show',$user)}}" class="btn btn-outline-success btn-sm">
    <i class="fa fa-eye"></i>
</a>
<a href="{{route('users.edit',$user)}}" class="btn btn-outline-warning btn-sm">
    <i class="fa fa-pencil-square-o"></i>
</a>
{{--// en lang necesitamos parametrizar esta accion--}}

<form action="{{route('admin.users.trash',$user)}}" method="POST" style="display: inline">
    @csrf
    @method('PATCH')
    <button class="user-delete btn btn-outline-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
</form>
@endif

