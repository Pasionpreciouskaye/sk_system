<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\DataTables\CmsDataTable;

class UserController extends Controller
{
    public function index(CmsDataTable $dataTable)
    {
        $page_title = 'Members';
        $resource = 'user';
        $columns = ['name', 'remarks', 'email', 'actions'];
        $data = User::getAllUsers();

        return $dataTable
            ->render('cms.index', compact(
                'page_title',
                'resource',
                'columns',
                'data',
                'dataTable',
            ));
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()
            ->route('user.index')
            ->with('success', 'You have successfully created a user!');
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'You have successfully updated a user!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'You have successfully deleted a user!');
    }

    public function profile(User $user)
    {
        return view('profile.index', compact('user'));
    }

    public function updateProfile(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'You have successfully updated your profile!');
    }
}
