<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Bookings') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('user.booking') }}">
        @csrf
        <label for="booking_date">Select a Date:</label>
        <input type="date" name="booking_date" required>
        <label for="user_letter">Letter (optional):</label>
        <input type="text" name="user_letter" placeholder="Enter letter if any">
        <button type="submit">Book</button>
    </form>

    <h3>Your Previous Bookings:</h3>
    @if ($bookings->isEmpty())
        <p>You have no bookings yet.</p>
    @else
        <ul>
            @foreach ($bookings as $booking)
                <li>
                    Booking Date: {{ $booking->booking_date }} - Status: {{ $booking->status }} - letter: {{ $booking->user_letter }} - Admin letter:
                    @if($booking->admin_letter)
        {{ $booking->admin_letter }}
    @else
        No letter from the admin.
    @endif
                </li>
            @endforeach
        </ul>
    @endif
</x-app-layout>
