<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Professional Booking Receipt</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');

    * { box-sizing: border-box; -webkit-print-color-adjust: exact; }
    body { background-color: #f3f4f6; font-family: 'Outfit', sans-serif; margin: 0; padding: 20px; color: #1f2937; }

    .receipt-card {
        max-width: 800px;
        margin: 0 auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 15px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .top-bar { height: 8px; background: #9f181c; }

    .content-padding { padding: 25px 30px; }

    .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; }
    .brand h1 { font-size: 28px; font-weight: 700; color: #9f181c; margin: 0; letter-spacing: -1px; }
    .brand p { font-size: 12px; color: #6b7280; margin: 3px 0; line-height: 1.3; }
    .invoice-label { text-align: right; }
    .invoice-label h2 { font-size: 12px; font-weight: 600; color: #9f181c; margin: 0; text-transform: uppercase; letter-spacing: 1px; }
    .invoice-label p { font-size: 16px; font-weight: 700; margin: 5px 0; color: #111827; }

    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: #f9fafb; padding: 15px; border-radius: 10px; margin-bottom: 25px; }
    .info-block h4 { font-size: 10px; text-transform: uppercase; color: #9f181c; margin: 0 0 5px 0; letter-spacing: 1px; }
    .info-block p { margin: 1px 0; font-size: 13px; font-weight: 500; }

    .table-container { width: 100%; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
    thead th { padding: 10px 0; border-bottom: 2px solid #111827; font-weight: 700; text-transform: uppercase; color: #111827; }
    tbody td { padding: 12px 0; border-bottom: 1px solid #f3f4f6; color: #374151; }

    .status-pill { display: inline-block; padding: 3px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; background: #fee2e2; color: #9f181c; text-transform: capitalize; }

    .billing-summary { display: flex; justify-content: flex-end; margin-top: 10px; }
    .summary-box { width: 220px; font-size: 13px; }
    .summary-row { display: flex; justify-content: space-between; padding: 5px 0; }
    .summary-row.grand-total { margin-top: 5px; border-top: 2px solid #9f181c; font-weight: 700; color: #111827; }

    /* Footer Signatures */
    .footer { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 35px; flex-wrap: wrap; }
    .signature-section { width: 45%; text-align: center; }
    .sig-line { border-top: 1px solid #111827; padding-top: 5px; font-size: 12px; font-weight: 600; color: #374151; }
    .virtual-sign { font-family: 'Brush Script MT', cursive; font-size: 22px; margin-bottom: 0; color: #000; }

    .thank-you-note { font-size: 13px; color: #6b7280; font-style: italic; text-align: center; margin-top: 10px; }

    @media print {
        body { background: #fff; padding: 0; }
        .receipt-card { box-shadow: none; border: none; width: 100%; max-width: 100%; }
        .content-padding { padding: 20px; }
    }
</style>
</head>
<body>

<div class="receipt-card">
    <div class="top-bar"></div>
    
    <div class="content-padding">
        <!-- Header -->
        <div class="header">
            <div class="brand">
                <h1>Eventre</h1>
                <p>Pallabi, Mirpur 12, Dhaka<br>
                Phone: 01303810979<br>
                Email: tanjinasraboni2001@gmail.com</p>
            </div>
            <div class="invoice-label">
                <h2>Receipt Date</h2>
                <p>{{ $currentDate }}</p>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <div class="info-block">
                <h4>Customer Details</h4>
                <p><strong>{{ $booking->customer->name }}</strong></p>
                <p>{{ $booking->customer->phone }}</p>
                <p>{{ $booking->customer->email }}</p>
            </div>
            <div class="info-block" style="text-align: right;">
                <h4>Event Schedule</h4>
                <p><strong>{{ date('d M Y', strtotime($booking->date)) }}</strong></p>
                <p>{{ $booking->start_time }} - {{ $booking->end_time }}</p>
                <p>Booking ID: #EV-{{ $booking->id }}</p>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: right;">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Main booking row -->
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $booking->package->event->name }}</div>
                            <div style="font-size: 12px; color: #6b7280;">Package: {{ $booking->package->name }}</div>
                        </td>
                        <td style="text-align: center;">
                            <span class="status-pill">{{ $booking->payment_status }}</span>
                        </td>
                        <td style="text-align: right; font-weight: 600;">
                            {{ number_format($booking->total_amount, 2) }} BDT
                        </td>
                    </tr>

                    <!-- Paid / Due row -->
                    <tr>
                        <td style="font-weight: 600;">Payment Details</td>
                        <td style="text-align: center;">&nbsp;</td>
                        <td style="text-align: right; font-size: 12px; color: #6b7280;">
                            Paid: {{ number_format($booking->total_amount - $booking->dues, 2) }} BDT <br>
                            Due: {{ number_format($booking->dues, 2) }} BDT
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Billing Summary -->
        <!-- Billing Summary -->
<div class="billing-summary">
    <div class="summary-box">
        <div class="summary-row">
            <span>Subtotal</span>
            <span>{{ number_format($booking->total_amount, 2) }}</span>
        </div>
        <div class="summary-row" style="color: #1a08a3ff;">
            <span>Paid</span>
            <span>{{ number_format($booking->total_amount - $booking->dues, 2) }}</span>
        </div>
        <div class="summary-row grand-total">
            <span>Grand Total Due</span>
            <span>{{ number_format($booking->dues, 2) }}</span>
        </div>
    </div>
</div>


        <!-- Footer Signatures -->
        <div class="footer">
            <div class="signature-section" style="text-align: left;">
                <div style="height: 40px;"></div>
                <div class="sig-line">Customer Signature</div>
            </div>
        </div>

        <!-- Thank You Note -->
        <div class="thank-you-note">
            Thank you for booking with <strong>Eventre</strong>!
        </div>
    </div>
</div>

</body>
</html>
