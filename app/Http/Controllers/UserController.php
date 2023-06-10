<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->checkAdmin();

        $users = User::all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkAdmin();

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->checkAdmin();

        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);

        User::create($validated + ['role' => User::ROLE_USER]);

        return redirect()->route('user.index')->with('status', __('User created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $this->checkAdmin();
        abort_if($user->isAdmin(), 403);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->checkAdmin();
        abort_if($user->isAdmin(), 403);

        $validated = $request->validated();
        $password = $request->input('password');

        if ($password) {
            $this->validate($request, [
                'password' => [
                    'required',
                    'string',
                    'min:8',
                ],
            ]);

            $validated['password'] = bcrypt($password);
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('status', __('User updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
