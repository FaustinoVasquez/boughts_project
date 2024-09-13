<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Forms\UserForm;
use App\Http\Requests\Admin\Users\CreateUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index',[
            'view' => 'users',
            'page_title' => 'Users List',
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function getUsers(Request $request)
    {
        $status = $request->deleted;

        return datatables()->of(User::query()
            ->filterBy($request->only(['deleted','role'])))
            ->setRowId(function ($user) {
                return $user->Id;
            })
            ->addColumn('Actions',function(User $user) use($status) {
                return view ('admin.users.shared._userActions',
                    [
                        'user' => $user,
                        'status' => $status
                    ]);
            })
            ->rawColumns(['Actions'])->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return UserForm
     */
    public function create()
    {
        return new UserForm('admin.users.create', new User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        User::create($request->all());
        return redirect()
            ->route('admin.users.index')
            ->with('success','This user has been Updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user,Request $request)
    {
        $user->deleted = $request->Deleted;
        $user->save();
        return redirect()->route('admin.users.index')->with('flash','This user has been removed');
    }


    public function trash(User $user,Request $request)
    {
        //could be better
        if ($request->ajax()){
            $user->delete();
            $user->Deleted ='inactive';
            $user->save();
            return response()->json([
                'success','This users has been deleted'
                ]);
        }
    }

    public function restore()
    {

    }
}
