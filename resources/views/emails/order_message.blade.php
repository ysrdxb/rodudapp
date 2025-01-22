<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .email-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Order Update: #{{ $order->id }}</h2>
        </div>
        <div class="email-body">
            <p><strong>Pickup Location:</strong> {{ $order->pickup_location }}</p>
            <p><strong>Delivery Location:</strong> {{ $order->delivery_location }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $messageContent }}</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Your Company. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
