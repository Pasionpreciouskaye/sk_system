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
        $columns = ['name', 'email', 'actions'];
        $data = User::getAllUsers();
        $data = User::with('budgets')->get(); // Eager load budgets


        return view('cms.user.index', compact(
        'page_title',
       'resource',
                  'columns',
                  'data'
            ));

    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['role'] = $data['role'] ?? \App\Models\User::ROLE_MEMBER;
        User::create($data);

        \App\Models\AuditTrail::log('create', 'User', "Created user: {$data['first_name']} {$data['last_name']}");

        return redirect()->route('user.index')->with('success', 'You have successfully created a user!');
    }


    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        \App\Models\AuditTrail::log('update', 'User', "Updated user: {$user->first_name} {$user->last_name}");

        return redirect()->route('user.index')->with('success', 'You have successfully updated a user!');
    }

    public function destroy(User $user)
    {
        $name = "{$user->first_name} {$user->last_name}";
        $user->delete();

        \App\Models\AuditTrail::log('delete', 'User', "Deleted user: {$name}");

        return redirect()->route('user.index')->with('success', 'You have successfully deleted a user!');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function updateProfile(UserRequest $request, User $user)
    {
        // Always use the authenticated user, ignore route binding
        $user = auth()->user();
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($request->hasFile('profile_picture')) {
            try {
                // Ensure the profiles directory exists
                $profilesDir = public_path('profiles');
                if (!is_dir($profilesDir)) {
                    mkdir($profilesDir, 0755, true);
                }
                // Delete old picture if exists
                if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                    @unlink(public_path($user->profile_picture));
                }
                $file = $request->file('profile_picture');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($profilesDir, $filename);
                $data['profile_picture'] = 'profiles/' . $filename;
            } catch (\Throwable $e) {
                unset($data['profile_picture']);
            }
        } else {
            unset($data['profile_picture']);
        }

        // Remove profile_picture from update data if column doesn't exist yet
        if (!in_array('profile_picture', \Illuminate\Support\Facades\Schema::getColumnListing('users'))) {
            unset($data['profile_picture']);
        }

        $user->update($data);

        return redirect()
            ->route('profile.index')
            ->with('success', 'You have successfully updated your profile!');
    }
}
