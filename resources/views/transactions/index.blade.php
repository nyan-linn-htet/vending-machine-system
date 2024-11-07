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
      <h1>{{ trans('cruds.transaction.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="transaction-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        {{-- <form action="{{ route('admin.transactions.filter') }}" method="POST">
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
                        </form> --}}
                    </div>
                </div>
            @if(count($transactions) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>{{ trans('cruds.transaction.no') }}</th>
                        @hasanyrole('Admin')
                            <th>{{ trans('cruds.transaction.user_name') }}</th>
                        @endhasanyrole
                        <th>{{ trans('cruds.product.fields.quantity') }}</th>
                        <th>{{ trans('cruds.product.fields.price') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr id="row{{ $transaction->id }}">
                                <td>{{ $loop->iteration + $transactions->firstItem() - 1 }}</td>
                                @hasanyrole('Admin')
                                    <td>{{ $transaction->user->name }}</td>
                                @endhasanyrole
                                <td>{{ $transaction->total_quantity }}</td>
                                <td>{{ $transaction->total_price }} USD</td>
                                <td>
                                    <div class="d-flex">
                                        @role('User')
                                            <a href="{{ route('transactions.show', $transaction->id) }}" class="pe-3" title="Transaction Details">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="pe-3" title="Transaction Details">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endrole
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ trans('global.no') }} {{ trans('cruds.transaction.title_singular') }} {{ trans('global.found') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $transactions->links() }}
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
