@extends('themes.frest.partials.merchantPanel.app')
@section('title', 'Merchant Delivery Parcel List')
@section('content')

    <div class="card">
        @include('themes.frest.partials.alerts')
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>serial</th>
                        <th>Customer Name</th>
                        <th>CustomerPhone</th>
                        <th>Delivery Address</th>
                        <th>order_id</th>
                        <th>product details</th>
                        <th>Amount</th>
                        <th>Collection</th>
                        <th>note</th>
                        <th>zip Code</th>
                        <th>category</th>
                        <th>weight</th>
                        <th>same_day</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <form action="" method="POST">
                        @csrf
                        @foreach ($data['parcelsImports'] as $key => $item)
                            <tr class="bg-success">
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $key }}][serial]"
                                        value="{{ $item['serial'] }}" required>
                                </td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $key }}][customer_name]" value="{{ $item['customer_name'] }}"
                                        required></td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $key }}][customer_phone]"
                                        value="{{ $item['customer_phone'] }}" required></td>
                                <td>
                                    <textarea class="form-control" name="data[{{ $key }}][delivery_address]" required>{{ $item['delivery_address'] }}</textarea>
                                </td>
                                <td><input type="text" class="form-control" name="data[{{ $key }}][order_id]"
                                        value="{{ $item['order_id'] }}" required></td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $key }}][product_details]"
                                        value="{{ $item['product_details'] }}" required></td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $key }}][product_amount]"
                                        value="{{ $item['product_amount'] }}" required></td>
                                <td>
                                    <input type="text" class="form-control"
                                        name="data[{{ $key }}][collection_amount]"
                                        value="{{ $item['collection_amount'] }}" required>
                                </td>
                                <td><input type="text" class="form-control" name="data[{{ $key }}][note]"
                                        value="{{ $item['note'] }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $key }}][zip_code]"
                                        value="{{ $item['zip_code'] }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $key }}][category]"
                                        value="{{ $item['category'] }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $key }}][weight]"
                                        value="{{ $item['weight'] }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $key }}][same_day]"
                                        value="{{ $item['same_day'] }}" required>
                                </td>



                            </tr>
                        @endforeach
                        @php
                            $count = count($data['parcelsImports']);
                        @endphp
                        @foreach ($data['parcelsImportsErros'] as $item)
                            <tr class="bg-danger">
                                <td><input type="text" class="form-control" name="data[{{ $count }}][serial]"
                                        value="{{ $item['serial'] ?? '' }}" required>
                                </td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $count }}][customer_name]"
                                        value="{{ $item['customer_name'] ?? '' }}" required></td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $count }}][customer_phone]"
                                        value="{{ $item['customer_phone'] ?? '' }}" required></td>
                                <td>
                                    <textarea class="form-control" name="data[{{ $key }}][delivery_address]" required>{{ $item['delivery_address'] }}</textarea>
                                </td>
                                <td><input type="text" class="form-control" name="data[{{ $count }}][order_id]"
                                        value="{{ $item['order_id'] ?? '' }}" required></td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $count }}][product_details]"
                                        value="{{ $item['product_details'] ?? '' }}" required></td>
                                <td><input type="text" class="form-control"
                                        name="data[{{ $count }}][product_amount]"
                                        value="{{ $item['product_amount'] ?? '' }}" required></td>
                                <td>
                                    <input type="text" class="form-control"
                                        name="data[{{ $count }}][collection_amount]"
                                        value="{{ $item['collection_amount'] ?? '' }}">
                                </td>
                                <td><input type="text" class="form-control" name="data[{{ $count }}][note]"
                                        value="{{ $item['note'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $count }}][zip_code]"
                                        value="{{ $item['zip_code'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $count }}][category]"
                                        value="{{ $item['category'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="data[{{ $count }}][weight]"
                                        value="{{ $item['weight'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        name="data[{{ $count }}][same_day]" value="{{ $item['same_day'] ?? '' }}"
                                        required>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="13">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </td>
                    </form>
                </tbody>
            </table>

        </div>
    </div>

@endsection
