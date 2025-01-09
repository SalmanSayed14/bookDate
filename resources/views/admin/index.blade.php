<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="text-green-600 p-3 mb-4 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="text-red-600 p-3 mb-4 bg-red-100 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">User</th>
                    <th class="px-4 py-2 text-left">Booking Date</th>
                    <th class="px-4 py-2 text-left">User's Letter</th>
                    <th class="px-4 py-2 text-left">Admin's Letter</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $booking->user->name }}</td>
                        <td class="px-4 py-2">{{ $booking->booking_date }}</td>
                        
                        <td class="px-4 py-2">{{ $booking->user_letter ?? 'No letter from the user.' }}</td>

                        <td class="px-4 py-2">
                            {{ $booking->admin_letter ?? 'No letter from the Admin' }}
                            
                            @if($booking->status == 'pending')
                                <form action="{{ route('admin.updateBookingStatus', $booking->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PUT')
                                    
                                    <input type="hidden" name="action" value="send_admin_letter">

                                    <textarea name="admin_letter" placeholder="Write a letter" rows="4" cols="50" class="border rounded p-2 w-full">{{ old('admin_letter', $booking->admin_letter) }}</textarea>
                                    
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-600 transition">Send Admin Letter</button>
                                </form>
                            @else
                                <p class="text-gray-500 mt-2">Letter has been sent for this booking.</p>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if($booking->status == 'pending')
                            <form action="{{ route('admin.updateBookingStatus', $booking->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="confirm" class="text-green-600 mt-2 ml-2 hover:text-green-700 transition">Confirm</button>
                                <button type="submit" name="action" value="reject" class="text-red-600 mt-2 ml-2 hover:text-red-700 transition">Reject</button>
                            </form>
                            @else
                            <span class="font-semibold 
                            @if($booking->status == 'confirmed') text-green-600
                            @elseif($booking->status == 'rejected') text-red-600
                            @else text-yellow-600 @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .text-green-600 {
            color: #16a34a;
        }

        .text-red-600 {
            color: #dc2626;
        }

        .bg-green-100 {
            background-color: #d1fae5;
        }

        .bg-red-100 {
            background-color: #fee2e2;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .p-3 {
            padding: 12px;
        }

        .form-input {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
            margin-top: 8px;
            font-size: 1rem;
        }

        .form-input:focus {
            border-color: #3b82f6;
            outline: none;
        }

        button {
            cursor: pointer;
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .bg-blue-500:hover {
            background-color: #2563eb;
        }

        .text-green-600:hover {
            color: #10b981;
        }

        .text-red-600:hover {
            color: #ef4444;
        }

        @media (max-width: 768px) {
            table {
                font-size: 0.875rem;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</x-app-layout>
