@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <img src="{{ asset('storage/cars/' . $car->image) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">
            <div class="card-body">
                <h2 class="card-title">{{ $car->brand }} {{ $car->model }}</h2>
                <p class="card-text">
                    <strong>Type:</strong> {{ ucfirst($car->type) }}<br>
                    <strong>Transmission:</strong> {{ ucfirst($car->transmission) }}<br>
                    <strong>Branch:</strong> {{ $car->branch->name }}<br>
                    <strong>Price per day:</strong> RM{{ number_format($car->price_per_day, 2) }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Book This Car</div>
            <div class="card-body">
                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    <input type="hidden" name="car_ids[]" value="{{ $car->id }}">
                    
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" min="{{ now()->addDays(2)->format('Y-m-d') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection