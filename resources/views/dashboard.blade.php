@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Products</h1>
        </div>

        @if (Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 col-xl-12">
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-3">
                                <div class="card p-2">
                                    <div class="d-flex justify-content-end">
                                        <span class="badge bg-warning">{{ $product->quantity }}</span>
                                    </div>
                                    <img src="" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title product-name">{{ $product->name }}</h5>
                                        <p class="card-text product-price">{{ $product->price }} USD</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary float-end addBtn" id="{{ $product->id }}">Add</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">There is no products.</h5>
                                </div>

                            </div>
                        </div>
                        @endforelse
                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>

        <div class="pagetitle">
            <h1>Cart</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 col-xl-12">
                    <table class="table" id="cart-table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-start">
                        <form id="transaction-form" action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_data" value="">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="total_quantity" value="">
                            <input type="hidden" name="total_amount" value="">
                            <button class="btn btn-success" type="submit">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
@section('scripts')
<script>
    $(document).on("click", '.addBtn', function() {
        let productId = $(this).attr('id');
        let productName = $(this).closest('.card').find('.product-name').text();
        let productPriceText = $(this).closest('.card').find('.product-price').text();
        let productPrice = parseFloat(productPriceText.replace(/[^0-9.]/g, ''));

        let existingProduct = $('#cart-table tbody').find(`tr[data-product-id="${productId}"]`);

        if (existingProduct.length) {
            let quantity = existingProduct.find('.product-quantity');
            let amount = existingProduct.find('.product-amount');

            let currentQuantity = parseInt(quantity.text());
            let newQuantity = currentQuantity + 1;

            quantity.text(newQuantity);
            amount.text((newQuantity * productPrice).toFixed(2) + " USD");
        } else {
            let newRow = `
                <tr data-product-id="${productId}">
                    <td>${productName}</td>
                    <td class="product-quantity">1</td> <!-- Initial quantity set to 1 -->
                    <td class="product-amount">${productPrice} USD</td>
                </tr>
            `;
            $('#cart-table tbody').append(newRow);
        }
    });

    $('#transaction-form').on('submit', function(e) {
        e.preventDefault();

        if ($('#cart-table tbody tr').length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Cart is empty',
                text: 'Please add products to the cart before proceeding to buy.',
            });
            return;
        }

        $(this).find('input[name="product_data[]"]').remove();

        let product_data = [];
        let totalQuantity = 0;
        let totalAmount = 0;

        $('#cart-table tbody tr').each(function() {
            let productId = $(this).data('product-id');
            let productQuantity = parseInt($(this).find('.product-quantity').text());
            let productAmount = parseFloat($(this).find('.product-amount').text());

            totalQuantity += productQuantity;
            totalAmount += productAmount;

            product_data.push({
                id: productId,
                quantity: productQuantity,
                amount: productAmount
            });
        });

        $('input[name="total_quantity"]').val(totalQuantity);
        $('input[name="total_amount"]').val(totalAmount.toFixed(2));

        $('<input>').attr({
            type: 'hidden',
            name: 'product_data',
            value: JSON.stringify(product_data)
        }).appendTo('form');

        this.submit();
    });
</script>
@endsection
