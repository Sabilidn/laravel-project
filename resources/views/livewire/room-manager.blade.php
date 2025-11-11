<div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Room Management</h1>
                <button wire:click="toggleForm"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ $showForm ? 'Cancel' : 'Add Room' }}
                </button>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @if ($showForm)
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-xl font-semibold mb-4">{{ $editingRoomId ? 'Edit Room' : 'Add New Room' }}</h2>
                    <form wire:submit.prevent="{{ $editingRoomId ? 'update' : 'create' }}">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" wire:model="name" id="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price_per_night" class="block text-gray-700 text-sm font-bold mb-2">Price per
                                Night</label>
                            <input type="number" step="0.01" wire:model="price_per_night" id="price_per_night"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('price_per_night') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="capacity" class="block text-gray-700 text-sm font-bold mb-2">Capacity</label>
                            <input type="number" wire:model="capacity" id="capacity"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('capacity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" wire:model="available" class="mr-2"> Available
                            </label>
                            @error('available') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ $editingRoomId ? 'Update Room' : 'Create Room' }}
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
                    @forelse ($rooms as $room)
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $room->name }}</h3>
                                        <p class="mt-1 text-sm text-gray-600">{{ $room->description }}</p>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <span class="mr-4">Price:
                                                ${{ number_format($room->price_per_night, 2) }}/night</span>
                                            <span class="mr-4">Capacity: {{ $room->capacity }}</span>
                                            <span class="{{ $room->available ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $room->available ? 'Available' : 'Unavailable' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $room->id }})"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Edit
                                        </button>
                                        <button wire:click="delete({{ $room->id }})"
                                            wire:confirm="Are you sure you want to delete this room?"
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
                                <p class="text-gray-500">No rooms found. <button wire:click="toggleForm"
                                        class="text-blue-500 underline">Add one now</button></p>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>