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
            session()->flash('error', 'คุณได้ลงทะเบียนกิจกรรมนี้ไปแล้ว');
            return;
        }

        // Check if user limit reached (max 3)
        if (Registration::where('user_id', $userId)->count() >= 3) {
            session()->flash('error', 'คุณสามารถลงทะเบียนได้สูงสุด 3 กิจกรรมเท่านั้น');
            return;
        }

        // Check availability
        $event = Event::withCount('registrations')->findOrFail($eventId);
        if ($event->registrations_count >= $event->total_seats) {
            session()->flash('error', 'กิจกรรมนี้ที่นั่งเต็มแล้ว');
            return;
        }

        // Create registration
        try {
            Registration::create([
                'user_id' => $userId,
                'event_id' => $eventId,
            ]);
            session()->flash('success', "ลงทะเบียนเข้าร่วม {$event->title} สำเร็จ!");
        } catch (\Exception $e) {
            session()->flash('error', 'การลงทะเบียนล้มเหลว กรุณาลองใหม่อีกครั้ง');
        }
    }
    
    public function cancel($eventId)
    {
        Registration::where('user_id', Auth::id())->where('event_id', $eventId)->delete();
        session()->flash('info', 'ยกเลิกการลงทะเบียนเรียบร้อยแล้ว');
    }
}; ?>

<div wire:poll.10s>
    @if(session('success'))
        <div class="p-6 mb-8 text-lg font-bold text-emerald-800 rounded-3xl bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800 animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
            <div class="flex items-center gap-3">
                <flux:icon name="circle-check" class="size-6" />
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="p-6 mb-8 text-lg font-bold text-rose-800 rounded-3xl bg-rose-50 dark:bg-rose-900/20 dark:text-rose-400 border border-rose-100 dark:border-rose-800 animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
            <div class="flex items-center gap-3">
                <flux:icon name="circle-alert" class="size-6" />
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 border-b border-zinc-200 dark:border-zinc-800 pb-12 mb-12">
        <div>
            <h1 class="text-4xl md:text-7xl font-black text-zinc-900 dark:text-white tracking-tight">กิจกรรมการเรียนรู้</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-4 text-xl md:text-2xl font-medium">ค้นพบและลงทะเบียนกิจกรรมที่ตอบโจทย์อนาคตของคุณ</p>
        </div>
        <div class="glass px-8 py-5 rounded-[2rem] flex items-center gap-4 group transition-transform hover:scale-105">
            <div class="size-3 bg-brand-500 rounded-full animate-pulse"></div>
            <span class="text-lg font-black text-zinc-800 dark:text-zinc-200 uppercase tracking-widest">
                ลงทะเบียนแล้ว: {{ $totalRegistrations }} / 3
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
        @forelse($events as $event)
            @php
                $remaining = $event->total_seats - $event->registrations_count;
                $isFull = $remaining <= 0;
                $isRegistered = $userRegistrations->contains($event->id);
            @endphp
            <div class="group relative flex flex-col glass rounded-[3rem] overflow-hidden transition-all duration-700 hover:-translate-y-4 hover:shadow-brand-500/20 translate-z-0">
                <!-- Background Glow -->
                <div class="absolute -top-12 -right-12 size-48 bg-brand-500/5 rounded-full blur-3xl group-hover:bg-brand-500/15 transition-all duration-700"></div>
                
                <div class="p-10 flex-1 flex flex-col gap-8 relative z-10">
                    <div class="flex justify-between items-start">
                        <div class="p-5 bg-zinc-100 dark:bg-zinc-800/50 rounded-[1.5rem] group-hover:bg-brand-500 group-hover:text-white transition-all duration-500 shadow-inner">
                            <flux:icon name="book-open-text" class="size-10" />
                        </div>
                        @if($isFull)
                            <span class="px-5 py-2 text-[10px] font-black uppercase tracking-[0.2em] rounded-full bg-rose-100 text-rose-600 dark:bg-rose-900/50 dark:text-rose-400 border border-rose-200 dark:border-rose-800">ที่นั่งเต็มแล้ว</span>
                        @else
                            <span class="px-5 py-2 text-[10px] font-black uppercase tracking-[0.2em] rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">{{ $remaining }} ที่นั่งที่เหลือ</span>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-3xl font-black text-zinc-900 dark:text-white mb-3 leading-[1.1] group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors duration-500">{{ $event->title }}</h3>
                        <p class="text-brand-600 dark:text-brand-400 font-black text-sm uppercase tracking-widest">{{ $event->speaker }}</p>
                    </div>

                    <div class="mt-auto flex flex-col gap-4">
                        <div class="flex items-center gap-3 text-zinc-500 dark:text-zinc-400 font-bold text-sm">
                            <flux:icon name="map-pin" class="size-5 text-zinc-400" />
                            {{ $event->location }}
                        </div>
                        
                        <div class="w-full h-1.5 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden mt-4">
                            @php $p = $event->total_seats > 0 ? ($event->registrations_count / $event->total_seats) * 100 : 0; @endphp
                            <div class="h-full bg-linear-to-r from-brand-600 to-indigo-600 transition-all duration-1000" style="width: {{ min($p, 100) }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="p-8 pt-0 relative z-10">
                    @if($isRegistered)
                        <button wire:click="cancel({{ $event->id }})" class="w-full py-5 rounded-[2rem] bg-zinc-100 dark:bg-zinc-800 hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-900/20 text-zinc-900 dark:text-white font-black text-lg transition-all duration-300 flex items-center justify-center gap-3 shadow-sm border border-transparent hover:border-rose-200">
                            <flux:icon name="circle-x" class="size-6" />
                            ยกเลิกการลงทะเบียน
                        </button>
                    @elseif($isFull)
                        <button disabled class="w-full py-5 rounded-[2rem] bg-zinc-100 dark:bg-zinc-900 text-zinc-400 font-black text-lg cursor-not-allowed opacity-50 flex items-center justify-center gap-3">
                            <flux:icon name="ban" class="size-6" />
                            ไม่สามารถลงทะเบียนได้
                        </button>
                    @elseif($totalRegistrations >= 3)
                        <button disabled class="w-full py-5 rounded-[2rem] bg-zinc-100 dark:bg-zinc-900 text-zinc-400 font-black text-lg cursor-not-allowed opacity-50 flex items-center justify-center gap-3" title="คุณลงทะเบียนครบ 3 กิจกรรมแล้ว">
                            <flux:icon name="lock" class="size-6" />
                            คุณใช้สิทธิ์ครบแล้ว
                        </button>
                    @else
                        <button wire:click="register({{ $event->id }})" class="w-full py-5 rounded-[2rem] bg-brand-600 hover:bg-brand-500 text-white font-black text-xl transition-all duration-300 shadow-xl shadow-brand-600/25 hover:scale-[1.02] flex items-center justify-center gap-3" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="register({{ $event->id }})" class="flex items-center gap-3">
                                <flux:icon name="party-popper" class="size-6" />
                                ลงทะเบียนทันที
                            </span>
                            <span wire:loading wire:target="register({{ $event->id }})" class="animate-pulse">กำลังดำเนินการ...</span>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 flex flex-col items-center justify-center glass rounded-[4rem] border-dashed border-2">
                <div class="p-8 bg-zinc-100 dark:bg-zinc-800 rounded-[2.5rem] mb-6">
                    <flux:icon name="calendar-days" class="size-16 text-zinc-300" />
                </div>
                <h3 class="text-3xl font-black text-zinc-400 italic">ไม่มีกิจกรรมในขณะนี้</h3>
                <p class="text-zinc-400 mt-2 font-medium">โปรดกลับมาตรวจสอบใหม่อีกครั้งในภายหลัง</p>
            </div>
        @endforelse
    </div>
</div>