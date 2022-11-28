@extends('Admin.layouts.master')
@section('page_title', 'Role Index')
@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h5 class="card-header">Role Index/ List Page</h5>
                    <a href="{{ route('role.create') }}" class="btn btn-primary me-4">Add New</a>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>Role Name</th>
                                <th>Role Slug</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ( $roles as $role)
                                <tr>
                                    <td><strong>{{ $loop->index+1 }}</strong></td>
                                    <td>{{ $role->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->role_slug }}</td>
                                    <td>
                                        @foreach ( $role->permissions->chunk(5) as $key=>$chunks )
                                        <div class="row">
                                            <div class="col">
                                                @foreach ($chunks as $permission)
                                                <span class="badge bg-info m-1">{{ $permission->permission_slug }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('edit-role')
                                                <a class="dropdown-item" href="{{ route('role.edit',$role->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                @endcan

                                                @if ($role->is_deleteable && Auth::user()->hasPermission('delete-role'))
                                                <form action="{{ route('role.destroy',$role->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show-conform" href=""><i class="bx bx-trash me-1"></i>Delete</button>
                                                </form>
                                                @endif

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td>No permission found yet!</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('admin_script')
<script>
    $(document).ready(function(){
        $('.show-conform').click(function(event){
            let form=$(this).closest('form');
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        })
    });

</script>
@endpush
