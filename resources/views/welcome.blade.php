<x-layouts::auth.simple>
    <!-- Header/Navigation -->
    <header class="w-full flex justify-between items-center mb-24 animate-in fade-in slide-in-from-top-4 duration-1000">
        <div class="flex items-center gap-3">
            <x-app-logo class="size-10 fill-white drop-shadow-lg" />
            <span class="text-xl font-black tracking-tighter uppercase text-white">Workshop Hub</span>
        </div>
        
        @if (Route::has('login'))
            <nav class="flex items-center gap-8">
                @auth
                    <a href="{{ route('dashboard') }}" class="glass px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-105 transition-all text-white">แดชบอร์ด</a>
                @else
                    <a href="{{ route('login') }}" class="text-white/70 hover:text-white font-bold transition-colors">เข้าสู่ระบบ</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-zinc-900 px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-white/10">สมัครสมาชิก</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Main Content -->
    <div class="flex flex-col items-center text-center space-y-16 py-12">
        <div class="space-y-8 animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-200">
            <!-- Badge -->
            <div class="flex justify-center">
                <div class="glass px-6 py-2 rounded-full border-white/10 flex items-center gap-2 group cursor-default">
                    <span class="size-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-white/60">Coming Soon: March 2026</span>
                </div>
            </div>

            <!-- Hero Title -->
            <div class="space-y-6">
                <h1 class="text-6xl md:text-9xl font-black tracking-tighter leading-[0.9] text-white select-none">
                    SENIOR TO JUNIOR<br/>
                    <span class="bg-clip-text text-transparent bg-linear-to-r from-brand-400 to-indigo-400">WORKSHOP</span>
                </h1>
                <p class="text-xl md:text-3xl font-medium text-white/50 max-w-3xl mx-auto font-sans leading-relaxed">
                    ถ่ายทอดประสบการณ์จากพี่สู่น้อง<br/>
                    พร้อมเวิร์กชอปสุดพรีเมียมที่จะเปลี่ยนคุณเป็นมือโปร
                </p>
            </div>
        </div>

        <!-- Scenario Card -->
        <div class="flex justify-center w-full animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-400">
            <div class="glass p-10 md:p-14 rounded-[4rem] border-white/5 max-w-4xl relative overflow-hidden group hover:shadow-brand-500/20 transition-all duration-700">
                <div class="absolute top-0 left-0 w-full h-1 bg-linear-to-r from-brand-500 to-indigo-500"></div>
                <p class="text-xl md:text-3xl font-medium text-white/80 leading-relaxed italic">
                    "มหาวิทยาลัยจะจัดงาน <strong>Senior-to-Junior Workshop</strong> โดยมีหัวข้อแยกย่อยหลายหัวข้อ แต่ละหัวข้อมีวิทยากรต่างกัน และมีการ <strong>จำกัดจำนวนที่นั่ง</strong> เพื่อความเหมาะสมในการสอน"
                </p>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-600">
            <a href="{{ route('register') }}" class="group relative w-full md:w-auto px-16 py-8 rounded-[3rem] bg-brand-600 hover:bg-brand-500 text-white font-black text-2xl transition-all shadow-3xl shadow-brand-600/30 hover:scale-105 active:scale-95">
                ลงทะเบียนตอนนี้
                <flux:icon name="arrow-right" class="inline-block size-7 ml-4 group-hover:translate-x-2 transition-transform" />
            </a>
            <a href="{{ route('login') }}" class="glass w-full md:w-auto px-16 py-8 rounded-[3rem] text-white font-black text-2xl transition-all hover:bg-white/10 border-white/5 hover:scale-105">
                ดูรายละเอียดกิจกรรม
            </a>
        </div>

        <!-- Features -->
        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-10 mt-32 animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-800">
            <div class="glass p-12 rounded-[4rem] border-white/5 hover:-translate-y-4 transition-all duration-500 text-left">
                <div class="size-20 bg-brand-500/10 rounded-3xl flex items-center justify-center mb-10">
                    <flux:icon name="users" class="size-10 text-brand-500" />
                </div>
                <h4 class="text-3xl font-black mb-4 text-white">โดยวิทยากรผู้เชี่ยวชาญ</h4>
                <p class="text-white/40 font-medium text-xl leading-relaxed">หัวข้อที่หลากหลายจากวิทยากรตัวจริงที่พร้อมแชร์ประสบการณ์สุดเอ็กซ์คลูซีฟ</p>
            </div>
            
            <div class="glass p-12 rounded-[4rem] border-white/5 hover:-translate-y-4 transition-all duration-500 text-left">
                <div class="size-20 bg-indigo-500/10 rounded-3xl flex items-center justify-center mb-10">
                    <flux:icon name="user-group" class="size-10 text-indigo-500" />
                </div>
                <h4 class="text-3xl font-black mb-4 text-white">จำกัดจำนวนที่นั่ง</h4>
                <p class="text-white/40 font-medium text-xl leading-relaxed">เพื่อคุณภาพสูงสุดในการเรียนการสอน เราจึงจำกัดสิทธิ์ผู้เข้าร่วมในแต่ละเวิร์กชอป</p>
            </div>

            <div class="glass p-12 rounded-[4rem] border-white/5 hover:-translate-y-4 transition-all duration-500 text-left">
                <div class="size-20 bg-emerald-500/10 rounded-3xl flex items-center justify-center mb-10">
                    <flux:icon name="check-circle" class="size-10 text-emerald-500" />
                </div>
                <h4 class="text-3xl font-black mb-4 text-white">ลงทะเบียนง่าย</h4>
                <p class="text-white/40 font-medium text-xl leading-relaxed">ระบบลงทะเบียนที่รวดเร็ว พร้อมจัดการสิทธิ์และคิวผู้เข้าร่วมอย่างเป็นระบบ</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full mt-48 py-20 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-10">
        <p class="text-white/20 font-black text-sm uppercase tracking-[0.3em]">&copy; 2026 Workshop Hub. All rights reserved.</p>
        <div class="flex items-center gap-12">
            <a href="#" class="text-white/20 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">Privacy Policy</a>
            <a href="#" class="text-white/20 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">Terms of Service</a>
        </div>
    </footer>
</x-layouts::auth.simple>
