@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- User Profile Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center space-x-4">
            <div class="bg-blue-100 p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Welcome, {{ $user->name }}</h1>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
    </div>

    <!-- Bookings Section -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Your Bookings</h2>
        </div>

        @if($bookings->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Car Details</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">#{{ $booking->id }}</div>
        <div class="text-sm text-gray-500">{{ $booking->created_at->format('M d, Y') }}</div>
    </td>
    <td class="px-6 py-4">
        @foreach($booking->cars as $car)
        <div class="flex items-center space-x-3 mb-2 last:mb-0">
            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-medium text-gray-900">{{ $car->brand }} {{ $car->model }}</div>
                <div class="text-sm text-gray-500">{{ $car->plate_number }}</div>
            </div>
        </div>
        @endforeach
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">
            {{ $booking->start_date instanceof \DateTime ? $booking->start_date->format('M d, Y') : \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
        </div>
        <div class="text-sm text-gray-500">
            to {{ $booking->end_date instanceof \DateTime ? $booking->end_date->format('M d, Y') : \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
        </div>
        <div class="text-xs text-gray-400 mt-1">
            @php
                $start = $booking->start_date instanceof \DateTime ? $booking->start_date : \Carbon\Carbon::parse($booking->start_date);
                $end = $booking->end_date instanceof \DateTime ? $booking->end_date : \Carbon\Carbon::parse($booking->end_date);
                echo $start->diffInDays($end) . ' days';
            @endphp
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <!-- Status badge remains the same -->
    </td>
</tr>
@endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by making your first booking.</p>
                <div class="mt-6">
                    <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Browse Cars
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection