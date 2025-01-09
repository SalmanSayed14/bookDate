<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Bookings') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('user.booking') }}" class="booking-form">
        @csrf
        <div class="form-group">
            <label for="booking_date" class="form-label">Select a Date:</label>
            <input type="date" name="booking_date" required class="form-input">
        </div>
        <div class="form-group">
            <label for="user_letter" class="form-label">Letter (optional):</label>
            <input type="text" name="user_letter" placeholder="Enter letter if any" class="form-input">
        </div>
        <button type="submit" class="submit-btn">Book</button>
    </form>

    <h3 class="previous-bookings-header">Your Previous Bookings:</h3>
    @if ($bookings->isEmpty())
        <p>You have no bookings yet.</p>
    @else
        <ul class="booking-list">
            @foreach ($bookings as $booking)
                <li class="booking-item">
                    Booking Date: {{ $booking->booking_date }} - Status: {{ $booking->status }} - Letter: {{ $booking->user_letter }} - Admin Letter:
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

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f7fafc;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .booking-form {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        max-width: 600px;
        margin: 20px auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        font-size: 1rem;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 1rem;
        background-color: #fafafa;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline-color: #ff2d20;
        border-color: #ff2d20;
    }

    .submit-btn {
        background-color: #ff2d20;
        color: #ffffff;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .submit-btn:hover {
        background-color: #e02b1f;
    }

    .previous-bookings-header {
        font-size: 1.5rem;
        color: #2d3748;
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .booking-list {
        list-style-type: none;
        padding-left: 0;
        margin-top: 20px;
    }

    .booking-item {
        background-color: #ffffff;
        border: 1px solid #ddd;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 5px;
        font-size: 1rem;
        color: #333;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .booking-form {
            padding: 15px;
        }

        .submit-btn {
            width: 100%;
        }
    }
</style>
