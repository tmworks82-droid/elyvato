<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->id ?? 'XXXX' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-box {
            padding: 30px;
            border: 1px solid #eee;
            font-size: 14px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .signature {
            margin-top: 80px;
            font-size: 12px;
        }
        .borderless td, .borderless th {
            border: none !important;
        }
    </style>
</head>
<body>

<div class="container invoice-box mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Tax Invoice</h4>
        <h6>(Original For Recipient)</h6>
    </div>

    <div class="row">
        <div class="col-md-6">
            <strong>M/s GLOSOL CONTENT TECH PRIVATE LIMITED</strong><br>
            <small>
                Registered Office:<br>
                B2-803 Ivy County SECTOR-75 NOIDA<br>
                Gautam Buddha Nagar UP 201301<br>
                Works:<br>
                C-34, First Floor, Street No-11, J.P. Extension,<br>
                Madhu Vihar, New Delhi-110092
            </small><br><br>
            <b>LUT NO.:</b> AD7opu202068664<br>
            <b>GSTIN:</b> 07AAHCT8646R2ZN<br>
            <b>PAN:</b> AAHCT8646R<br>
            <b>TAN:</b> MRTT02534G
        </div>
        <div class="col-md-6">
            <b>Invoice No:</b> TMW/25-26/0342P<br> 
            <b>Date:</b> {{ \Carbon\Carbon::parse($payment->created_on)->format('d-M-y') }}
            <br>
            <b>PO Date:</b> {{ \Carbon\Carbon::parse($payment->created_on)->format('d-M-y') }}<br>
            <b>PO No:</b> 1105484785<br><br>

            <strong>To,</strong><br>
            {{$payment->creator->username}}<br>
            {{$payment->creator->profile->company_name}}<br>
            {{$payment->creator->profile->address_line1}}-<br>
            {{$payment->creator->profile->state}}
            {{$payment->creator->profile->country}}
            {{$payment->creator->profile->pincode}}
            
            <b>GST No:</b> {{$payment->creator->profile->gst_number}}
        </div>
    </div>

    <hr>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>S.No.</th>
                <th>Service name</th>
                <th>HSN/SAC</th>
                <th>Amount (Rs.)</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>{{  ServiceNmae($payment->booking->statementOfWork->service_id)->name}}</td>
                <td>998365</td>
                <td>₹ {{ $payment->amount }}</td>
            </tr>

        </tbody>

    </table>

    <table class="table borderless">
        <tr>
            <td class="text-end"><strong>Total</strong></td>
            <td class="text-end">₹ {{ $payment->amount }}</td>
        </tr>
        <tr>
            <td class="text-end">Add: CGST @9%</td>
            @php
            $amount=$payment->amount*9/100;
            @endphp
            <td class="text-end">{{ $amount}}</td>
        </tr>
        <tr>
            <td class="text-end">Add: SGST @9%</td>
            <td class="text-end">₹ {{ $amount}}</td>
        </tr>
        <tr>
            <td class="text-end"><strong>Total Amount</strong></td>
            <td class="text-end"><strong>₹ {{ $payment->amount }}</strong></td>
        </tr>
    </table>

    <p><strong>Amount in Words:</strong> Four Thousand Seven Hundred Twenty Rupees Only</p>

    <h6 class="mt-4">Company’s Banking Details:</h6>
    <p>
        <b>Bank Name:</b> ICICI Bank Ltd.<br>
        <b>Account No:</b> *081859008067<br>
        <b>IFSC:</b> ICIC0000815
    </p>

    <div class="signature text-end">
        <img src="https://dummyimage.com/150x50/ddd/000&text=Signed" alt="Digital Signature"><br>
        RATNENDRA KUMAR PANDEY<br>
        Date: 2025-07-10<br>
        Time: 12:37:43 +05:30<br>
        <small>Account, GLOSOL CONTENT TECH PRIVATE LIMITED<br>Authorized Signatory</small>
    </div>

    <p class="mt-4 text-muted small"><em>(Invoice is digitally signed. Hence no physical sign is required.)</em></p>
</div>

</body>
</html>
