@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    <strong>Edit Product</strong>
                </div>
                <div class="card-body">
                    <form name="editProductForm" id="editProductForm" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="form-group">
                            <label for="name">Product name</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity_in_stock">Quantity in Stock</label>
                            <input type="number" name="quantity_in_stock" id="quantity_in_stock" value="{{ $product->quantity_in_stock }}" class="form-control"
                                   min="0" step="1" required>
                        </div>

                        <div class="form-group">
                            <label for="price_per_item">Price per Item</label>
                            <input type="number" name="price_per_item" id="price_per_item" value="{{ $product->price_per_item }}" class="form-control" min="0"
                                   required>
                        </div>
                        <button type="button" onclick="updateProduct()" class="btn btn-success" id="submit">Update</button>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('index') }}" class="btn btn-primary btn-sm">Home</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
    <script>
        function updateProduct() {
            disableSubmit();
            var name = $('#name').val();
            var quantity_in_stock = $('#quantity_in_stock').val();
            var price_per_item = $('#price_per_item').val();

            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ route('update', $product->id) }}',
                type: "POST",
                data: {
                    name: name,
                    quantity_in_stock: quantity_in_stock,
                    price_per_item: price_per_item,
                    _token: _token
                },
                success: function (response) {
                    if (response.code == 200) {
                        $('#alert-div').html('<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><p class="mb-0"> '+ response.message + ' </p></div>');
                        enableSubmit();
                    }
                },
                error: function (response) {
                    $('#alert-div').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><p class="mb-0">' + response.message + '</p></div>');
                    enableSubmit();
                }
            });


        }
    </script>

@endpush
