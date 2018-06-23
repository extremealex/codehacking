<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;
use Throwable;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        //$users = [];

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $roles = Role::lists('name', 'id')->all();
//        $roles = ['' => 'Choose Role'] + $roles;
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        try {
            DB::transaction(
                function () use ($request) {
                    $input = $request->all();

                    if ($request->hasFile('photo_id')) {
                        $file = $request->file('photo_id');
                        $name = time() . $file->getClientOriginalName();
                        $file->move('images', $name);
                        $photo = Photo::create(['file' => $name]);
                        $input['photo_id'] = $photo->id;
                    }

                    $input['password'] = bcrypt($input['password']);
                    User::create($input);
                }
            );
        } catch (Throwable $t) {
            Log::error($t);
        }
//        if ($request->hasFile('photo_id')) {
//            $file = $request->file('photo_id');
//            $name = time() . $file->getClientOriginalName();
//            $file->move('images', $name);
//            $photo = Photo::create(['file' => $name]);
//            $input['photo_id'] = $photo->id;
//        }
//
//        $input['password'] = bcrypt($input['password']);
//        try {
//            User::create($input);
//        } catch (Throwable $t) {
//            $photo->delete();
//        }

        Session::flash('created_user', 'The user has been created');

        return redirect(url('admin/users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::all();


        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        if (empty($input['password'])) {
            unset($input['password']);
        }

        if ($request->hasFile('photo_id')) {
            $file = $request->file('photo_id');
            $name = time() . $file->getClientOriginalName();
            $attributes = ['file' => $name];
            if (empty($user->photo)) {
                $photo = Photo::create($attributes);
                $input['photo_id'] = $photo->id;
            } else {
                unlink(public_path($user->photo->file));
                $user->photo->update($attributes);
                unset($input['photo_id']);
            }
            $file->move('images', $name);
        }

        $input['updated_at'] = Carbon::now()->toDateTimeString();
        $user->update($input);
        //$user->fill($input)->save();

        Session::flash('updated_user', 'The user has been updated');

        return redirect('admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path() . $user->photo->file);
        $user->delete();
        Session::flash('deleted_user', 'The user has been deleted');
        return redirect('admin/users');
    }
}