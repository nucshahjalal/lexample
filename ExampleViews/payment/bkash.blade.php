@extends('master')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Bkash Payment</h1>
    <form action="{{ route('bkash-create-payment') }}" method="get">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Pay with bKash</button>
    </form>
</body>
</html>

@endsection
