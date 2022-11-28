@extends('Admin.layouts.master')
@section('page_title','Role Create')
@push('admin_style')

@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Role Create form</h5>
                  <small class="text-muted float-end">

                    <a class="btn btn-secondary" href="{{ route('role.index') }}"><i class="bx bx-arrow-back"></i> Back to Role List</a>
                  </small>
                </div>
                <div class="card-body">
                  <form action="{{ route('role.update',$role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Role Name</label>
                      <input type="text" name="role_name" class="form-control @error('role_name')
                      is-invalid
                    @enderror" id="basic-default-fullname" value="{{ $role->role_name }}" placeholder="enter role name">
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Roles Note</label>
                      <input type="text" name="role_note" class="form-control @error('role_note')
                      is-invalid
                    @enderror" id="basic-default-fullname" alue="{{ $role->role_note }}"  placeholder="enter roles note">
                    @error('role_note')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_deleteable" id="defaultCheck3" checked>
                            <label class="form-check-label" for="defaultCheck3"> Is Deleteable </label>
                          </div>
                    </div> --}}
                    <div class="mt-4 mb-4">
                        <strong class="@error('permissions') is-invalid @enderror">Manage Permissions for Role</strong>
                        @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_deleteable" id="select-all">
                            <label class="form-check-label" for="select-all"> Select All </label>
                          </div>
                    </div>
                    <div class="my-2">
                        @foreach ($modules->chunk(2) as $key=>$chunks)
                            <div class="row">
                                @foreach ( $chunks as $module)
                                <div class="col">
                                    <h5 class="text-primary">Module: {{ $module->module_name }}</h5>

                                    <!--module permissions list -->
                                    @foreach ( $module->permissions as $permission)
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission-{{ $permission->id }}"
                                                @if (isset($role))
                                                    @foreach ($role->permissions as $rPermission)
                                                        {{ $rPermission->id == $permission->id ? 'checked':'' }}
                                                    @endforeach

                                                @endif
                                                >
                                                <label class="form-check-label" for="permission-{{ $permission->id }}"> {{ $permission->permission_name }} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!--module permissions list -->
                                </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                  </form>
                </div>
              </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script>
    //Listern for check on select all checkbox
    $('#select-all').click(function(event){
        if(this.checked){
            //loop each checkbox
            $(':checkbox').each(function(){
                this.checked=true;
            })
        }else{
            $(':checkbox').each(function(){
                this.checked=false;
            })
        }
    });
</script>
@endpush
