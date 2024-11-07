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
      <h1>{{ trans('cruds.product.title') }}</h1>
    </div><!-- End Page Title -->

    <section class="product-table">
        <div class="card p-2">

                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="{{ route('admin.products.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Enter product name">
                                <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="" style="float:right">
                            <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                                <i class="fa-solid fa-plus"></i> {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('cruds.product.title_singular') }}
                            </a>
                        </div>
                    </div>
                </div>
            @if(count($products) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>{{ trans('global.no') }}</th>
                        <th>{{ trans('cruds.product.fields.name') }}</th>
                        <th>{{ trans('cruds.product.fields.price') }}</th>
                        <th>{{ trans('cruds.product.fields.quantity') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr id="row{{ $product->id }}">
                                <td>{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }} USD</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="pe-3" title="Product Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="pe-3" title="Edit Product Details">
                                            <i class="fa-regular fa-pen-to-square text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a class="pe-3 delete text-danger" title="Delete Product">
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
                {{ trans('global.no') }} {{ trans('cruds.product.title_singular') }} {{ trans('global.found') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div style="float:right">
                        {{ $products->links() }}
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
