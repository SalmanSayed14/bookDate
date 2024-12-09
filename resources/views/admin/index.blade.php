<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="text-green-600">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="text-red-600">
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
                                <form action="{{ route('admin.updateBookingStatus', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <input type="hidden" name="action" value="send_admin_letter">

                                    <textarea name="admin_letter" placeholder="Write a letter" rows="4" cols="50" class="border rounded p-2 w-full">{{ old('admin_letter', $booking->admin_letter) }}</textarea>
                                    
                                    <button type="submit" class="bg-blue-500 text-black px-4 py-2 mt-2 rounded">Send Admin Letter</button>
                                </form>
                            @else
                                <p class="text-gray-500 mt-2">Letter has been sent for this booking.</p>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if($booking->status == 'pending')
                            <form action="{{ route('admin.updateBookingStatus', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="confirm" class="text-green-600 mt-2 ml-2">Confirm</button>
                                <button type="submit" name="action" value="reject" class="text-red-600 mt-2 ml-2">Reject</button>
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
</x-app-layout>
