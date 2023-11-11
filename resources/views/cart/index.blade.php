<!-- resources/views/cart/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <ul>
            @foreach($cartItems as $cartItem)
                <li>
                    {{ $cartItem->product->name }} - Quantity: {{ $cartItem->quantity }} - 
                    ${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}
                    <a href="/cart/remove/{{ $cartItem->id }}">Remove</a>
                </li>
            @endforeach
        </ul>

        <form action="/cart/add" method="post">
            @csrf
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>

        <a href="/cart/invoice">Generate Invoice</a>
    </div>
</body>
</html>
