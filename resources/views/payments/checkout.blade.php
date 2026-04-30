@extends('layouts.app')

@section('content')
<h2>Tuition Payment</h2>

<form method="POST" action="{{ route('payments.process') }}">
    @csrf
    <input type="text" name="student_id" placeholder="Student ID" class="form-control mb-2">
    <input type="number" name="amount" placeholder="Amount" class="form-control mb-2">
    <button type="submit" class="btn btn-success">Pay Now</button>
</form>
@endsection