<?php

use Livewire\Component;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public function with(): array
    {
        return [
            'events' => collect(Event::withCount('registrations')->get()),
            'userRegistrations' => collect(Registration::where('user_id', Auth::id())->pluck('event_id')),
            'totalRegistrations' => Registration::where('user_id', Auth::id())->count()
        ];
    }

    public function register($eventId)
    {
        $userId = Auth::id();

        // Check if already registered
        if (Registration::where('user_id', $userId)->where('event_id', $eventId)->exists()) {
            session()->flash('error', 'You are already registered for this event.');
            return;
        }

        // Check if user limit reached (max 3)
        if (Registration::where('user_id', $userId)->count() >= 3) {
            session()->flash('error', 'You can only register for a maximum of 3 events.');
            return;
        }

        // Check availability
        $event = Event::withCount('registrations')->findOrFail($eventId);
        if ($event->registrations_count >= $event->total_seats) {
            session()->flash('error', 'This event is already full.');
            return;
        }

        // Create registration
        try {
            Registration::create([
                'user_id' => $userId,
                'event_id' => $eventId,
            ]);
            session()->flash('success', "Successfully registered for {$event->title}!");
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to register. Please try again.');
        }
    }
    
    public function cancel($eventId)
    {
        Registration::where('user_id', Auth::id())->where('event_id', $eventId)->delete();
        session()->flash('info', 'Registration cancelled.');
    }
}; ?>

<div wire:poll.5s>
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            {{ session('info') }}
        </div>
    @endif

    <div class="mb-4 text-right">
        <span class="inline-block bg-neutral-100 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 px-4 py-2 rounded-lg font-semibold">
            Your Registrations: {{ $totalRegistrations }} / 3
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 overflow-hidden flex flex-col transition-all hover:shadow-md">
                <div class="p-5 flex-1">
                    <h3 class="text-xl font-bold text-neutral-900 dark:text-neutral-100 mb-1">{{ $event->title }}</h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">{{ $event->speaker }}</p>

                    <div class="space-y-2 mt-auto">
                        <div class="flex items-center text-sm text-neutral-600 dark:text-neutral-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $event->location }}
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-neutral-700 dark:text-neutral-300">Available Seats:</span>
                            @php
                                $remaining = $event->total_seats - $event->registrations_count;
                                $isFull = $remaining <= 0;
                                $isRegistered = $userRegistrations->contains($event->id);
                            @endphp
                            <span class="font-bold {{ $isFull ? 'text-red-500' : 'text-green-500' }}">
                                {{ $remaining > 0 ? $remaining : 0 }} / {{ $event->total_seats }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-neutral-50 dark:bg-neutral-900 border-t border-neutral-200 dark:border-neutral-700 p-4">
                    @if($isRegistered)
                        <button wire:click="cancel({{ $event->id }})" class="w-full bg-neutral-200 dark:bg-neutral-700 hover:bg-neutral-300 dark:hover:bg-neutral-600 text-neutral-800 dark:text-neutral-200 font-bold py-2 px-4 rounded transition-colors break-words">
                            Registered (Cancel)
                        </button>
                    @elseif($isFull)
                        <button disabled class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-bold py-2 px-4 rounded cursor-not-allowed">
                            Closed
                        </button>
                    @elseif($totalRegistrations >= 3)
                        <button disabled class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-bold py-2 px-4 rounded cursor-not-allowed" title="You have reached the maximum of 3 registrations">
                            Limit Reached
                        </button>
                    @else
                        <button wire:click="register({{ $event->id }})" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="register({{ $event->id }})">Register</span>
                            <span wire:loading wire:target="register({{ $event->id }})">Registering...</span>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 bg-neutral-50 dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                <p class="text-neutral-500 dark:text-neutral-400">No events available at the moment.</p>
            </div>
        @endforelse
    </div>
</div>