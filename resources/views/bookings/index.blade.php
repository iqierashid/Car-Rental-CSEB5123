@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<h2>My Bookings</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Cars</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>
                        @foreach($booking->cars as $car)
                            {{ $car->brand }} {{ $car->model }}<br>
                        @endforeach
                    </td>
                    <td>{{ $booking->start_date->format('d M Y') }}</td>
                    <td>{{ $booking->end_date->format('d M Y') }}</td>
                    <td>RM{{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $booking->status === 'approved' ? 'success' : 
                            ($booking->status === 'rejected' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        @if($booking->status === 'pending')
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $bookings->links() }}
</div>
@endsection