@extends('layouts.app')

@section('styles')
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<style>
    .required:after {
        content:" *";
        color: red;
    }
</style>

@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.role.title') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ trans('cruds.role.title') }}</a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.role.title_singular') }} {{ trans('global.update') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="role-table">
        <div class="card p-2">
            {{-- <div class="card-header">
                <h5>{{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}</h5>
            </div> --}}
            <div class="card-body p-2">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.role.fields.name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="required" for="permissions">{{ trans('cruds.permission.title') }}</label>
                                <select name="permissions[]" id="role" class="form-control {{ $errors->has('permissions') ? 'is-invalid' : '' }}" multiple>
                                    <option value="" disabled>{{ trans('global.please_select') }}</option>
                                    @foreach ($permissions as $key => $value)
                                        <option value="{{ $value }}"{{ in_array($value, old('permissions', [])) || $role->permissions->contains($value) ? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('permissions'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('permissions') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right">
                                <a class="btn btn-secondary float-right" href="{{ route('admin.roles.index') }}">{{ trans('global.cancel') }}</a>
                                <button type="submit" class="btn btn-success float-right">{{ trans('global.update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#role').select2({
        width: '100%'
    });
});
</script>
@endsection
