<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Room;
use Livewire\Component;

class BookingManager extends Component
{
    public $bookings = [];
    public $rooms = [];
    public $guest_name = '';
    public $guest_email = '';
    public $guest_phone = '';
    public $room_id = '';
    public $check_in_date = '';
    public $check_out_date = '';
    public $number_of_guests = '';
    public $status = 'pending';
    public $editingBookingId = null;
    public $showForm = false;

    protected $rules = [
        'guest_name' => 'required|string|max:255',
        'guest_email' => 'required|email',
        'guest_phone' => 'nullable|string|max:20',
        'room_id' => 'required|exists:rooms,id',
        'check_in_date' => 'required|date|after:today',
        'check_out_date' => 'required|date|after:check_in_date',
        'number_of_guests' => 'required|integer|min:1',
        'status' => 'required|in:pending,confirmed,cancelled',
    ];

    public function mount()
    {
        $this->loadBookings();
        $this->loadRooms();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::with('room')->get();
    }

    public function loadRooms()
    {
        $this->rooms = Room::where('available', true)->get();
    }

    public function create()
    {
        $this->validate();

        $room = Room::findOrFail($this->room_id);
        $nights = \Carbon\Carbon::parse($this->check_in_date)->diffInDays(\Carbon\Carbon::parse($this->check_out_date));
        $total_price = $room->price_per_night * $nights;

        Booking::create([
            'guest_name' => $this->guest_name,
            'guest_email' => $this->guest_email,
            'guest_phone' => $this->guest_phone,
            'room_id' => $this->room_id,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'number_of_guests' => $this->number_of_guests,
            'total_price' => $total_price,
            'status' => $this->status,
        ]);

        $this->resetForm();
        $this->loadBookings();
        session()->flash('message', 'Booking created successfully!');
    }

    public function edit($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->editingBookingId = $bookingId;
        $this->guest_name = $booking->guest_name;
        $this->guest_email = $booking->guest_email;
        $this->guest_phone = $booking->guest_phone;
        $this->room_id = $booking->room_id;
        $this->check_in_date = $booking->check_in_date->format('Y-m-d');
        $this->check_out_date = $booking->check_out_date->format('Y-m-d');
        $this->number_of_guests = $booking->number_of_guests;
        $this->status = $booking->status;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();

        $booking = Booking::findOrFail($this->editingBookingId);
        $room = Room::findOrFail($this->room_id);
        $nights = \Carbon\Carbon::parse($this->check_in_date)->diffInDays(\Carbon\Carbon::parse($this->check_out_date));
        $total_price = $room->price_per_night * $nights;

        $booking->update([
            'guest_name' => $this->guest_name,
            'guest_email' => $this->guest_email,
            'guest_phone' => $this->guest_phone,
            'room_id' => $this->room_id,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'number_of_guests' => $this->number_of_guests,
            'total_price' => $total_price,
            'status' => $this->status,
        ]);

        $this->resetForm();
        $this->loadBookings();
        session()->flash('message', 'Booking updated successfully!');
    }

    public function delete($bookingId)
    {
        Booking::findOrFail($bookingId)->delete();
        $this->loadBookings();
        session()->flash('message', 'Booking deleted successfully!');
    }

    public function resetForm()
    {
        $this->guest_name = '';
        $this->guest_email = '';
        $this->guest_phone = '';
        $this->room_id = '';
        $this->check_in_date = '';
        $this->check_out_date = '';
        $this->number_of_guests = '';
        $this->status = 'pending';
        $this->editingBookingId = null;
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
        return view('livewire.booking-manager');
    }
}
