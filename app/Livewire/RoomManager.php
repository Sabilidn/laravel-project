<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomManager extends Component
{
    public $rooms = [];
    public $name = '';
    public $description = '';
    public $price_per_night = '';
    public $capacity = '';
    public $available = true;
    public $editingRoomId = null;
    public $showForm = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price_per_night' => 'required|numeric|min:0',
        'capacity' => 'required|integer|min:1',
        'available' => 'boolean',
    ];

    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms()
    {
        $this->rooms = Room::all();
    }

    public function create()
    {
        $this->validate();

        Room::create([
            'name' => $this->name,
            'description' => $this->description,
            'price_per_night' => $this->price_per_night,
            'capacity' => $this->capacity,
            'available' => $this->available,
        ]);

        $this->resetForm();
        $this->loadRooms();
        session()->flash('message', 'Room created successfully!');
    }

    public function edit($roomId)
    {
        $room = Room::findOrFail($roomId);
        $this->editingRoomId = $roomId;
        $this->name = $room->name;
        $this->description = $room->description;
        $this->price_per_night = $room->price_per_night;
        $this->capacity = $room->capacity;
        $this->available = $room->available;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();

        $room = Room::findOrFail($this->editingRoomId);
        $room->update([
            'name' => $this->name,
            'description' => $this->description,
            'price_per_night' => $this->price_per_night,
            'capacity' => $this->capacity,
            'available' => $this->available,
        ]);

        $this->resetForm();
        $this->loadRooms();
        session()->flash('message', 'Room updated successfully!');
    }

    public function delete($roomId)
    {
        Room::findOrFail($roomId)->delete();
        $this->loadRooms();
        session()->flash('message', 'Room deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price_per_night = '';
        $this->capacity = '';
        $this->available = true;
        $this->editingRoomId = null;
        $this->showForm = false;
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->resetForm();
        }
    }

    public function render()
    {
        return view('livewire.room-manager');
    }
}
