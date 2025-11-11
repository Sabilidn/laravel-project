<div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Booking Management</h1>
                <button wire:click="toggleForm"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ $showForm ? 'Cancel' : 'Add Booking' }}
                </button>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @if ($showForm)
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-xl font-semibold mb-4">{{ $editingBookingId ? 'Edit Booking' : 'Add New Booking' }}</h2>
                    <form wire:submit.prevent="{{ $editingBookingId ? 'update' : 'create' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="guest_name" class="block text-gray-700 text-sm font-bold mb-2">Guest
                                    Name</label>
                                <input type="text" wire:model="guest_name" id="guest_name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('guest_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="guest_email" class="block text-gray-700 text-sm font-bold mb-2">Guest
                                    Email</label>
                                <input type="email" wire:model="guest_email" id="guest_email"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('guest_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="guest_phone" class="block text-gray-700 text-sm font-bold mb-2">Guest
                                    Phone</label>
                                <input type="text" wire:model="guest_phone" id="guest_phone"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('guest_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="room_id" class="block text-gray-700 text-sm font-bold mb-2">Room</label>
                                <select wire:model="room_id" id="room_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Select a room</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }} -
                                            ${{ number_format($room->price_per_night, 2) }}/night</option>
                                    @endforeach
                                </select>
                                @error('room_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="check_in_date" class="block text-gray-700 text-sm font-bold mb-2">Check-in
                                    Date</label>
                                <input type="date" wire:model="check_in_date" id="check_in_date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('check_in_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="check_out_date" class="block text-gray-700 text-sm font-bold mb-2">Check-out
                                    Date</label>
                                <input type="date" wire:model="check_out_date" id="check_out_date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('check_out_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="number_of_guests" class="block text-gray-700 text-sm font-bold mb-2">Number of
                                    Guests</label>
                                <input type="number" wire:model="number_of_guests" id="number_of_guests"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('number_of_guests') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                                <select wire:model="status" id="status"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ $editingBookingId ? 'Update Booking' : 'Create Booking' }}
                            </button>
                            <button type="button" wire:click="resetForm"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $booking->guest_name }}</h3>
                                        <p class="mt-1 text-sm text-gray-600">{{ $booking->guest_email }}</p>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <span class="mr-4">Room: {{ $booking->room->name }}</span>
                                            <span class="mr-4">Check-in:
                                                {{ $booking->check_in_date->format('M d, Y') }}</span>
                                            <span class="mr-4">Check-out:
                                                {{ $booking->check_out_date->format('M d, Y') }}</span>
                                            <span class="mr-4">Guests: {{ $booking->number_of_guests }}</span>
                                            <span class="mr-4">Total: ${{ number_format($booking->total_price, 2) }}</span>
                                            <span class="px-2 py-1 rounded text-xs font-medium
                                                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $booking->id }})"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $booking->id }})"
                                            wire:confirm="Are you sure you want to delete this booking?"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <p class="text-gray-500">No bookings found. <button wire:click="toggleForm"
                                        class="text-blue-500 underline">Add one now</button></p>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>