<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\PermissionStoreRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::with(['module:id,module_name,module_slug'])->select(['id','module_id','permission_name','permission_slug','updated_at'])->latest()->paginate();
        return view('Admin.pages.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules=Module::select(['id','module_name'])->get();
        return view('Admin.pages.permission.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        Permission::updateOrCreate([
            'module_id'=>$request->module_id,
            'permission_name'=>$request->permission_name,
            'permission_slug'=>Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission Created Successfully');
        return redirect()->route('permission.index');
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
        $permission=Permission::find($id);
        $modules=Module::select(['id','module_name'])->get();
        return view('Admin.pages.permission.edit',compact('modules','permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionStoreRequest $request, $id)
    {
        $permission=Permission::find($id);
        $permission->update([
            'module_id'=>$request->module_id,
            'permission_name'=>$request->permission_name,
            'permission_slug'=>Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission updated Successfully');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission=Permission::find($id);
        $permission->delete();

        Toastr::warning('Permission Deleted Successfully');
        return redirect()->route('permission.index');
    }
}
