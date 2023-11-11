<!-- resources/views/user/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <div class="container">
        <h1>Welcome, {{ $user->name }}!</h1>

        <h2>Shopping Cart</h2>
        @if(count($cartItems) > 0)
            <ul>
                @foreach($cartItems as $cartItem)
                    <li>
                        {{ $cartItem->product->name }} - Quantity: {{ $cartItem->quantity }} -
                        ${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Your shopping cart is empty.</p>
        @endif

        <a href="/cart">Go to Cart</a>
    </div>
</body>
</html>
