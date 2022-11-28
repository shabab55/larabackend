@extends('Admin.layouts.master')
@section('page_title','Module Edit')
@push('admin_style')

@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Module Edit form</h5>
                  <small class="text-muted float-end">

                    <a class="btn btn-secondary" href="{{ route('module.index') }}"><i class="bx bx-arrow-back"></i> Back to Module List</a>
                  </small>
                </div>
                <div class="card-body">
                  <form action="{{ route('module.update',$module->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Module Name</label>
                      <input type="text" name="module_name" class="form-control @error('module_name')
                      is-invalid
                    @enderror" id="basic-default-fullname"  value="{{ $module->module_name }}" placeholder="enter module name">
                    @error('module_name')
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
