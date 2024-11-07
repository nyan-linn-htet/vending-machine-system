@extends('layouts.app')

@section('styles')
{{-- sweet alert --}}
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<style>
.delete{
    cursor: pointer;
}
</style>
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.user.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="user-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="{{ route('admin.users.filter') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <select class="form-select" aria-label="Filter by role" name="filter_by_role">
                                    <option value="" selected>{{ trans('global.filter') }} {{ trans('cruds.role.title_singular') }}</option>
                                    @foreach($roles as $key => $value)
                                        <option value="{{ $value }}" @if(isset($role_filter_id) &&  $value == $role_filter_id ) selected @endif>{{ $key }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-filter"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="" style="float:right">
                            <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                                <i class="fa-solid fa-plus"></i> {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('cruds.user.title_singular') }}
                            </a>
                        </div>
                    </div>
                </div>
            @if(count($users) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('cruds.user.fields.name') }}</th>
                    <th>{{ trans('cruds.user.fields.email') }}</th>
                    <th>{{ trans('cruds.user.fields.role') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr id="row{{ $user->id }}">
                                <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-info rounded-pill">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="pe-3" title="User Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="pe-3" title="Edit User Details">
                                            <i class="fa-regular fa-pen-to-square text-success"></i>
                                        </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="pe-3 delete text-danger" title="Delete User">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ trans('global.no') }} {{ trans('cruds.user.title_singular') }} {{ trans('global.found') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<script>


$('.delete').on('click', function(){
    Swal.fire({
        title: 'Warning!',
        text: 'Do you really want to delete?',
        icon: 'warning',
        confirmButtonText: 'Yes',
        showCancelButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            $(this).parent().submit()
        }
    })
})
</script>
@endsection
