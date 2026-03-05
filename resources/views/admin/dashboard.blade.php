<x-layouts::app :title="__('แดชบอร์ดผู้ดูแลระบบ')">
    <div class="flex h-full w-full flex-1 flex-col gap-12 animate-in fade-in duration-700">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tight text-zinc-900 dark:text-white lg:text-6xl">
                    <span class="bg-clip-text text-transparent bg-linear-to-r from-brand-500 to-indigo-500">แผงควบคุม</span>
                </h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-3 text-xl font-medium">ยินดีต้อนรับกลับมา! ระบบพร้อมสำหรับการจัดการข้อมูลกิจกรรมพรีเมียมของคุณแล้ว</p>
            </div>
            <div class="flex items-center gap-4">
                <flux:button href="{{ route('admin.events.create') }}" variant="primary" icon="plus" class="bg-brand-600 hover:bg-brand-500 shadow-2xl shadow-brand-600/30 rounded-2xl h-14 px-8 font-black text-lg transition-all hover:scale-105 active:scale-95">
                    สร้างกิจกรรมใหม่
                </flux:button>
            </div>
        </div>

        <!-- Main Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Stats Card 1 -->
            <div class="group relative overflow-hidden glass p-8 rounded-[2.5rem] transition-all duration-500 hover:-translate-y-2">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 size-32 bg-brand-500/10 rounded-full blur-3xl group-hover:bg-brand-500/20 transition-colors"></div>
                <div class="flex items-center gap-6">
                    <div class="p-5 bg-brand-500/10 rounded-3xl group-hover:bg-brand-500/20 transition-colors">
                        <flux:icon name="book-open-text" class="size-8 text-brand-600 dark:text-brand-400" />
                    </div>
                    <div>
                        <p class="text-sm font-black text-zinc-400 uppercase tracking-[0.2em] mb-1">กิจกรรมทั้งหมด</p>
                        <h3 class="text-5xl font-black text-zinc-900 dark:text-white">{{ $events->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Stats Card 2 -->
            <div class="group relative overflow-hidden glass p-8 rounded-[2.5rem] transition-all duration-500 hover:-translate-y-2">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 size-32 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-colors"></div>
                <div class="flex items-center gap-6">
                    <div class="p-5 bg-indigo-500/10 rounded-3xl group-hover:bg-indigo-500/20 transition-colors">
                        <flux:icon name="users" class="size-8 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <div>
                        <p class="text-sm font-black text-zinc-400 uppercase tracking-[0.2em] mb-1">ผู้ลงทะเบียน</p>
                        <h3 class="text-5xl font-black text-zinc-900 dark:text-white">{{ $events->sum('registrations_count') }}</h3>
                    </div>
                </div>
            </div>

            <!-- Stats Card 3 -->
            <div class="group relative overflow-hidden glass p-8 rounded-[2.5rem] transition-all duration-500 hover:-translate-y-2">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 size-32 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-colors"></div>
                <div class="flex items-center gap-6">
                    <div class="p-5 bg-emerald-500/10 rounded-3xl group-hover:bg-emerald-500/20 transition-colors">
                        <flux:icon name="user-group" class="size-8 text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <div>
                        <p class="text-sm font-black text-zinc-400 uppercase tracking-[0.2em] mb-1">ที่นั่งว่าง</p>
                        <h3 class="text-5xl font-black text-zinc-900 dark:text-white">{{ $events->sum('total_seats') - $events->sum('registrations_count') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <!-- Left Column: Table Overview -->
            <div class="lg:col-span-3 flex flex-col gap-8">
                <div class="flex justify-between items-end">
                    <h2 class="text-3xl font-black text-zinc-900 dark:text-white">ภาพรวมกิจกรรม</h2>
                    <flux:link href="{{ route('admin.events.index') }}" class="text-sm font-bold text-brand-600 hover:scale-105 transition-transform">ดูกิจกรรมทั้งหมด &rarr;</flux:link>
                </div>
                
                <div class="overflow-hidden glass rounded-[3rem] border-0 shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-zinc-50/50 dark:bg-zinc-900/50">
                                <tr>
                                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">ชื่อกิจกรรม</th>
                                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">สถานะที่นั่ง</th>
                                    <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">ตรวจสอบ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @foreach($events->take(6) as $event)
                                    <tr class="group hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-all duration-300">
                                        <td class="px-10 py-8">
                                            <div class="flex flex-col">
                                                <span class="text-lg font-black text-zinc-900 dark:text-white group-hover:text-brand-600 transition-colors">{{ $event->title }}</span>
                                                <span class="text-sm font-medium text-zinc-400 mt-1">{{ $event->speaker }}</span>
                                            </div>
                                        </td>
                                        <td class="px-10 py-8">
                                            <div class="flex flex-col gap-3">
                                                <div class="flex justify-between items-center text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                                                    <span>{{ $event->registrations_count }} / {{ $event->total_seats }}</span>
                                                </div>
                                                <div class="w-48 h-2 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                                    @php $percentage = $event->total_seats > 0 ? ($event->registrations_count / $event->total_seats) * 100 : 0; @endphp
                                                    <div class="h-full bg-brand-500 transition-all duration-1000 group-hover:bg-brand-400" style="width: {{ min($percentage, 100) }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-10 py-8 text-right">
                                            <flux:button variant="subtle" icon="eye" class="rounded-xl hover:bg-zinc-100 dark:hover:bg-zinc-800" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Quick Actions & System Info -->
            <div class="lg:col-span-1 flex flex-col gap-8">
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white text-right">เมนูด่วน</h2>
                <div class="flex flex-col gap-4">
                    <button class="w-full glass p-6 rounded-[2rem] flex flex-col gap-4 hover:bg-zinc-50/50 transition-all text-left">
                        <div class="size-12 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center">
                            <flux:icon name="cog" class="size-6 text-zinc-500" />
                        </div>
                        <span class="font-black text-zinc-900 dark:text-white text-lg">ตั้งค่าระบบ</span>
                    </button>
                    <button class="w-full glass p-6 rounded-[2rem] flex flex-col gap-4 hover:bg-zinc-50/50 transition-all text-left border-l-4 border-brand-500">
                        <div class="size-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center">
                            <flux:icon name="bell" class="size-6 text-brand-600" />
                        </div>
                        <span class="font-black text-zinc-900 dark:text-white text-lg">ประกาศข่าวสาร</span>
                    </button>
                    <div class="glass p-8 rounded-[2rem] bg-linear-to-br from-brand-600 to-indigo-700 text-white mt-4 border-0">
                        <h4 class="font-black text-2xl mb-2 italic">Pro Version</h4>
                        <p class="text-white/80 text-sm leading-relaxed mb-6 font-medium">สัมผัสประสบการณ์การใช้งานที่เหนือกว่าด้วยระบบวิเคราะห์ข้อมูลอัจฉริยะ</p>
                        <button class="w-full bg-white text-brand-600 py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-105 transition-transform">อัปเกรดเลย</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
