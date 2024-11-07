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
      <h1>{{ trans('cruds.role.title') }}</h1>
    </div><!-- End Page Title -->

    @if (Session::has('msg'))
    <div class="alert @if(Session::get("status") == 'true') alert-success @else alert-danger @endif alert-dismissible fade show" role="alert">
        {{ Session::get("msg") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section class="role-table">
        <div class="card p-2">
            <div class="row mb-2">
                <div class="col-md-12">
                    <a class="btn btn-primary" style="float:right" href="{{ route('admin.roles.create') }}">
                        <i class="fa-solid fa-plus"></i> {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('cruds.role.title_singular') }}
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <th>{{ trans('global.no') }}</th>
                    <th>{{ trans('cruds.role.fields.name') }}</th>
                    <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr id="row{{ $role->id }}">
                                <td>{{ $loop->iteration + $roles->firstItem() - 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.roles.show', $role->id) }}" class="pe-3" title="Role Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="pe-3" title="Edit Role Details">
                                        <i class="fa-regular fa-pen-to-square text-success"></i>
                                    </a>
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a class="pe-3 delete text-danger" title="Delete role">
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

            <div class="row">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $roles->links() }}
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
