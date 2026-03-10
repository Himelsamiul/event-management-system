<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 850px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .invoice-header p {
            margin: 2px 0;
            font-size: 14px;
        }

        .customer-info {
            text-align: right;
            margin-bottom: 30px;
        }

        .customer-info h3 {
            margin: 0 0 5px;
            font-size: 16px;
        }

        .customer-info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background: #414143;
            color: #fff;
            text-align: left;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        .signature-line {
            width: 200px;
            border-top: 1px solid #000;
            margin-top: 40px;
            text-align: center;
            margin-left: auto;
        }

        .signature-label {
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <!-- Company Info Centered -->
        <div class="invoice-header">
            <h2>Eventre</h2>
            <p>Tongi, Gazipur, Dhaka</p>
            <p>+880 1771-250000</p>
            <p><a href="mailto:admin@gmail.com">admin@gmail.com</a></p>
        </div>

        <!-- Customer Info on Right -->
        <div class="customer-info">
            <h3>Bill To</h3>
            <p><strong>Invoice #:</strong> INV-{{ $booking->id }}</p>
            <p><strong>{{ $booking->customer->name }}</strong></p>
            <p>{{ $booking->customer->phone }}</p>
            <p>{{ $booking->customer->email }}</p>
            
            <p><strong>Date:</strong> {{ $currentDate }}</p>
        </div>

        <!-- Booking Table -->
        <table>
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Foods</th>
                    <th>Decorations</th>
                    <th>Venue</th>
                    <th>Amount</th>
                    <th>Dues</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $booking->event->name ?? 'N/A' }}</td>
                    <td>
                        @foreach($booking->foods as $food)
                            {{ $food->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($booking->decorations as $decoration)
                            {{ $decoration->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ $booking->venue }}</td>
                    <td>{{ $booking->total_amount }}</td>
                    <td>{{ $booking->dues }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>
                        @if($booking->status == 'Cancelled')
                            Booking Cancelled
                        @elseif($booking->status == 'Reject')
                            Booking Rejected
                        @else
                            {{ $booking->payment_status }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <p class="total">Total: <strong>{{ $booking->total_amount }} BDT</strong></p>

        <!-- Footer and Signature -->
        <div class="footer">
           
            <div class="signature-line">
                <div class="signature-label">Customer Signature</div>
            </div>

        </div>
        <p style="font-size: 16px; font-weight: bold; margin-top: 30px;">Thank you for your booking with Eventre!</p>
    </div>
</body>

</html>
