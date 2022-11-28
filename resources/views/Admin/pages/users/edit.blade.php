@extends('Admin.layouts.master')
@section('page_title','User Edit')
@push('admin_style')

@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">User Create form</h5>
                  <small class="text-muted float-end">

                    <a class="btn btn-secondary" href="{{ route('users.index') }}"><i class="bx bx-arrow-back"></i> Back to User List</a>
                  </small>
                </div>
                <div class="card-body">
                  <form action="{{ route('users.update',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Role Selection</label>
                        <select name="role_id" id="" class="form-select @error('role_id')
                        is-invalid
                      @enderror">
                      <option value="">Select a role</option>
                            @foreach ( $roles as $role )
                                <option value="{{ $role->id }}" @if ($role->id == $user->role_id)
                                        selected
                                    @endif>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">User Name</label>
                      <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name')
                      is-invalid
                    @enderror" id="basic-default-fullname" placeholder="enter user name">
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">User Email</label>
                      <input type="text" name="email" value="{{ $user->email }}" class="form-control @error('email')
                      is-invalid
                    @enderror" id="basic-default-fullname" placeholder="enter user email">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">User Password</label>
                      <input type="text" name="password" class="form-control @error('password')
                      is-invalid
                    @enderror" id="basic-default-fullname" placeholder="enter user password">
                      @error('password')
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
