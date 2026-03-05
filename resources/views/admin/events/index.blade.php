<x-layouts::app :title="__('จัดการกิจกรรม')">
    <div class="flex h-full w-full flex-1 flex-col gap-10 animate-in fade-in duration-700">
        @if(session('success'))
            <div class="px-6 py-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 font-bold text-sm animate-in slide-in-from-top-4 duration-500">
                <div class="flex items-center gap-3">
                    <flux:icon name="check-circle" class="size-5" />
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tight text-zinc-900 dark:text-white lg:text-6xl">
                    <span class="bg-clip-text text-transparent bg-linear-to-r from-indigo-500 via-brand-500 to-sky-500 drop-shadow-sm">จัดการกิจกรรม</span>
                </h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-4 text-xl font-medium">ควบคุมและดูแลข้อมูลกิจกรรมทั้งหมดในระบบของคุณ</p>
            </div>
            <flux:button href="{{ route('admin.events.create') }}" variant="primary" icon="plus" class="bg-brand-600 hover:bg-brand-500 shadow-2xl shadow-brand-600/30 rounded-2xl h-14 px-8 font-black text-lg transition-all hover:scale-105 active:scale-95">
                เพิ่มกิจกรรมใหม่
            </flux:button>
        </div>

        <!-- Table Container -->
        <div class="glass-premium rounded-[3rem] overflow-hidden border-0 shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-zinc-50/50 dark:bg-white/[0.02] border-b border-zinc-100 dark:border-white/[0.05]">
                        <tr>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400">รหัส</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400">หัวเรื่อง / วิทยากร</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400">สถานที่</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400">สถานะที่นั่ง</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400 text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-white/[0.05]">
                        @forelse($events as $event)
                            <tr class="group hover:bg-zinc-50/50 dark:hover:bg-white/[0.01] transition-all duration-300">
                                <td class="px-8 py-6 text-sm font-black text-zinc-400 group-hover:text-brand-500 transition-colors">#{{ $event->id }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-lg font-black text-zinc-900 dark:text-white group-hover:text-brand-600 transition-colors">{{ $event->title }}</span>
                                        <span class="text-sm font-medium text-zinc-400 mt-1 flex items-center gap-2">
                                            <flux:icon name="user" class="size-3" />
                                            {{ $event->speaker }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-sm font-bold text-zinc-600 dark:text-zinc-300">
                                        <flux:icon name="map-pin" class="size-4 opacity-50" />
                                        {{ $event->location }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-3 max-w-[160px]">
                                        <div class="flex justify-between items-center">
                                            <span class="text-[11px] font-black text-zinc-400 tracking-tighter">{{ $event->registrations_count }} / {{ $event->total_seats }}</span>
                                            @php 
                                                $percentage = $event->total_seats > 0 ? ($event->registrations_count / $event->total_seats) * 100 : 0;
                                                $statusColor = $percentage >= 100 ? 'bg-rose-500' : ($percentage >= 80 ? 'bg-amber-500' : 'bg-brand-500');
                                            @endphp
                                            <span class="text-[10px] font-black {{ str_replace('bg-', 'text-', $statusColor) }}">{{ round($percentage) }}%</span>
                                        </div>
                                        <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                            <div class="h-full {{ $statusColor }} transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(0,0,0,0.1)]" style="width: {{ min($percentage, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <flux:button href="{{ route('admin.events.show', $event->id) }}" variant="subtle" icon="eye" class="rounded-xl hover:bg-brand-50 dark:hover:bg-brand-900/20 hover:text-brand-600 transition-all" />
                                        <flux:button href="{{ route('admin.events.edit', $event->id) }}" variant="subtle" icon="pencil-square" class="rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 transition-all" />
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-zinc-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all cursor-pointer">
                                                <flux:icon name="trash" class="size-5" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4 opacity-30">
                                        <flux:icon name="archive-box" class="size-20" />
                                        <span class="text-xl font-black uppercase tracking-widest">ไม่พบกิจกรรมในระบบ</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
