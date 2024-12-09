<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach(Auth::user()->bookings as $booking)
    <p>Booking Date: {{ $booking->booking_date }} - Status: {{ $booking->status }}</p>
@endforeach
</x-app-layout>