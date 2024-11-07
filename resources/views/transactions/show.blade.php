@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.transaction.title') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">{{ trans('cruds.transaction.title') }}</a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.transaction.title_singular') }} {{ trans('global.show') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="transaction-table">
        <div class="card p-2">

            <table class="table">
                <thead>
                    <th>{{ trans('cruds.product.fields.name') }}</th>
                    <th>{{ trans('cruds.product.fields.quantity') }}</th>
                    <th>{{ trans('cruds.product.fields.price') }}</th>
                </thead>
                <tbody>
                    @foreach($transaction->transactionDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->total_quantity }}</td>
                            <td>{{ $detail->total_price }} USD</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Total</td>
                        <td>{{ $transaction->total_price }} USD</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        @role('User')
                            <a class="btn btn-secondary btn-sm float-right" href="{{ route('transactions.index') }}">{{ trans('global.back_to_list') }}</a>
                        @else
                            <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.transactions.index') }}">{{ trans('global.back_to_list') }}</a>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
