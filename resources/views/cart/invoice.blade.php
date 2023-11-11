<!-- resources/views/cart/invoice.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            padding: 10px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }

        p {
            margin: 10px 0;
        }

        p.discount {
            color: #28a745; /* Green color for discounts */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice</h1>

        <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>
        <p>Shipping: ${{ number_format($shipping, 2) }}</p>
        <p>VAT: ${{ number_format($vat, 2) }}</p>

        @if($shoesDiscount > 0)
            <p class="discount">10% off shoes: -$ {{ number_format($shoesDiscount, 2) }}</p>
        @endif

        @if($jacketDiscount > 0)
            <p class="discount">50% off jacket: -$ {{ number_format($jacketDiscount, 2) }}</p>
        @endif

        @if($shippingDiscount > 0)
            <p class="discount">$10 off shipping: -$ {{ number_format($shippingDiscount, 2) }}</p>
        @endif

        <p>Total: ${{ number_format($total, 2) }}</p>
        <a href="/dashboard">Go to Your Cart</a><br>
        <a href="/logout">Logout</a>
    </div>
</body>
</html>
