@extends('layouts.app')

@section('title', 'Available Cars')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Available Cars</h2>
        <form class="row g-3">
            <div class="col-md-3">
                <label for="branch" class="form-label">Branch</label>
                <select class="form-select" id="branch" name="branch">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="">All Types</option>
                    <option value="sedan" {{ request('type') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                    <option value="suv" {{ request('type') == 'suv' ? 'selected' : '' }}>SUV</option>
                    <option value="hatchback" {{ request('type') == 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="transmission" class="form-label">Transmission</label>
                <select class="form-select" id="transmission" name="transmission">
                    <option value="">All</option>
                    <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ request('brand') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @foreach($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/cars/' . $car->image) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                    <p class="card-text">
                        <strong>Type:</strong> {{ ucfirst($car->type) }}<br>
                        <strong>Transmission:</strong> {{ ucfirst($car->transmission) }}<br>
                        <strong>Branch:</strong> {{ $car->branch->name }}<br>
                        <strong>Price:</strong> RM{{ number_format($car->price_per_day, 2) }}/day
                    </p>
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $cars->links() }}
</div>
@endsection