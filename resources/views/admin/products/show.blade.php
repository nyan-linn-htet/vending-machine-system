@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ trans('cruds.product.title') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('cruds.product.title') }}</a></li>
          <li class="breadcrumb-item active">{{ trans('cruds.product.title_singular') }} {{ trans('global.show') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="product-table">
        <div class="card p-2">

            <table class="table">
                <tbody>
                   <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                   </tr>
                   <tr>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <td>
                            {{ $product->price }} USD
                        </td>
                   </tr>
                   <tr>
                        <th>
                            {{ trans('cruds.product.fields.quantity') }}
                        </th>
                        <td>
                            {{ $product->quantity }}
                        </td>
                   </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <div style="float: right">
                        <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.products.index') }}">{{ trans('global.back_to_list') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@endsection
