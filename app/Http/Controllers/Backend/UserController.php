<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with(['role:id,role_name,role_slug'])
        ->select(['id','role_id','name','email','is_active','updated_at'])
        ->latest()
        ->paginate();
        //return $users;
        return view('Admin.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::select(['id','role_name'])->get();
        return view('Admin.pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //dd($request->all());
        User::updateOrCreate(
            [
                'role_id'=>$request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
            ]
        );

        Toastr::success('User Created Successfully');
        return redirect()->route('users.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $user=User::find($id);
        $roles=Role::select(['id','role_name'])->get();
        return view('Admin.pages.users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //dd($request->all());
        $user=User::find($id);

        $user->update(
            [
                'role_id'=>$request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        Toastr::info('User Updated Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id)->delete();
        Toastr::warning('user Deleted Successfully');
        return redirect()->route('users.index');
    }

    //ajax call function
    public function checkActive($user_id){
        //dd($user_id);
        $user=User::find($user_id);
        //toggle the is-active
        if($user->is_active==1){
            $user->is_active=0;
        }else{
            $user->is_active=1;
        }

        $user->update();

        return response()->json([
            'type'=>'success',
            'message'=>'Status Updated',
        ]);
    }
}
