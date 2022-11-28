@extends('Admin.layouts.master')
@section('page_title','Permission Edit')
@push('admin_style')

@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Permission Edit form</h5>
                  <small class="text-muted float-end">

                    <a class="btn btn-secondary" href="{{ route('permission.index') }}"><i class="bx bx-arrow-back"></i> Back to Permisssion List</a>
                  </small>
                </div>
                <div class="card-body">
                  <form action="{{ route('permission.update',$permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Module Selection</label>
                        <select name="module_id" id="" class="form-select @error('module_id')
                        is-invalid
                      @enderror">
                      <option value="">Select a module</option>
                            @foreach ( $modules as $module )
                                <option value="{{ $module->id }}" @if ($permission->module_id==$module->id)
                                    selected
                                @endif>{{ $module->module_name }}</option>
                            @endforeach
                        </select>
                        @error('module_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Permission Name</label>
                      <input type="text" name="permission_name" value="{{ $permission->permission_name }}" class="form-control @error('permission_name')
                      is-invalid
                    @enderror" id="basic-default-fullname" placeholder="enter permission name">
                      @error('permission_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                  </form>
                </div>
              </div>
        </div>
    </div>
@endsection

@push('admin_script')

@endpush
