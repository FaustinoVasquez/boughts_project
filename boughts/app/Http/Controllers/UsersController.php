<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',[
            'view' => 'show',
            'page_title' => 'Users Show',
            'user'=>$user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return UserForm
     */
    public function edit(User $user)
    {
        return new UserForm('users.edit', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $request->updateUser($user);
        return redirect()
            ->route('users.show',$user)
            ->with('success','This user has been Updated');
    }

}
