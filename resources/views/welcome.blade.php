<x-layouts::auth.simple>
    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Animated Decorative Elements -->
        <div class="absolute -top-24 -left-24 size-96 bg-brand-500/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute top-1/4 -right-48 size-[400px] bg-rose-500/10 rounded-full blur-[130px] animate-pulse delay-500"></div>
        <div class="absolute bottom-1/4 -left-48 size-[500px] bg-amber-500/10 rounded-full blur-[150px] animate-pulse delay-1000"></div>
        <div class="absolute -bottom-24 right-1/4 size-96 bg-sky-500/10 rounded-full blur-[120px] animate-pulse delay-1500"></div>

        <!-- Header/Navigation -->
        <header class="relative z-50 flex justify-between items-center py-10 mb-20">
            <div class="flex items-center gap-4 group cursor-pointer">
                <div class="size-12 glass-premium rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                    <x-app-logo class="size-7 fill-white drop-shadow-glow" />
                </div>
                <span class="text-2xl font-black tracking-tighter uppercase text-white group-hover:tracking-normal transition-all duration-500">Workshop<span class="text-brand-400">Hub</span></span>
            </div>
            
            <nav class="hidden md:flex items-center gap-10">
                @auth
                    <a href="{{ route('dashboard') }}" class="glass-premium px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] text-white hover:bg-brand-500/20 hover:border-brand-500/30 transition-all duration-300">เข้าสู่ระะบบแดชบอร์ด</a>
                @else
                    <a href="{{ route('login') }}" class="text-white/50 hover:text-white font-bold tracking-wide transition-all duration-300">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}" class="bg-white text-zinc-950 px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all duration-300 shadow-[0_20px_40px_-10px_rgba(255,255,255,0.3)]">เริ่มลงทะเบียน</a>
                @endauth
            </nav>
        </header>

        <!-- Hero Section -->
        <div class="relative z-10 flex flex-col items-center pt-10 pb-32">
            <div class="space-y-12 text-center max-w-5xl">
                <!-- Promo Badge -->
                <div class="inline-flex items-center gap-3 glass-premium px-6 py-2.5 rounded-full border-white/5 animate-in fade-in zoom-in duration-1000">
                    <span class="relative flex size-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full size-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white/50">Registration Open for 2026</span>
                </div>

                <!-- Main Headline -->
                <div class="space-y-8 animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-100">
                    <h1 class="text-7xl md:text-[140px] font-black tracking-tighter leading-[0.8] text-white">
                        <span class="bg-clip-text text-transparent bg-linear-to-r from-rose-400 via-brand-400 to-indigo-400">SENIOR</span> TO<br/>
                        <span class="bg-clip-text text-transparent bg-linear-to-r from-indigo-400 via-sky-400 to-emerald-400 drop-shadow-[0_0_30px_rgba(56,189,248,0.3)]">JUNIOR</span>
                    </h1>
                    <p class="text-2xl md:text-4xl font-medium text-white/40 max-w-3xl mx-auto leading-relaxed font-sans">
                        ส่งต่อความความรู้จากพี่สู่น้อง<br class="hidden md:block"/> 
                        ผ่านประสบการณ์การเรียนรู้ระดับ <span class="bg-clip-text text-transparent bg-linear-to-r from-amber-400 to-rose-400 font-black">Ultra-Premium</span>
                    </p>
                </div>

                <!-- Feature Split Card (Scenario) -->
                <div class="w-full pt-16 animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-300">
                    <div class="glass-premium p-1 md:p-2 rounded-[4rem] hover:shadow-brand-500/20 transition-all duration-700">
                        <div class="bg-zinc-900/40 rounded-[3.5rem] p-10 md:p-20 border border-white/5 overflow-hidden relative">
                            <div class="absolute -top-20 -right-20 size-64 bg-brand-500/10 rounded-full blur-[80px]"></div>
                            <div class="relative z-10 flex flex-col md:flex-row items-center gap-16">
                                <div class="text-left space-y-8 flex-1">
                                    <h2 class="text-4xl md:text-6xl font-black text-white leading-tight"> Senior-to-Junior <br/><span class="text-indigo-400">Workshop</span></h2>
                                    <p class="text-xl md:text-2xl font-medium text-white/60 leading-relaxed italic border-l-4 border-brand-500 pl-8">
                                        แต่ละหัวข้อมีวิทยากรต่างกัน และมีการ <span class="text-white font-bold">"จำกัดจำนวนที่นั่ง"</span> เพื่อความเหมาะสมในการสอนที่มีคุณภาพสูงสุด
                                    </p>
                                </div>
                                <div class="w-full md:w-80 flex flex-col gap-6">
                                    <div class="glass-premium p-8 rounded-3xl text-center hover-3d group">
                                        <flux:icon name="user-group" class="size-12 text-brand-500 mx-auto mb-4 group-hover:scale-110 transition-transform" />
                                        <div class="text-3xl font-black text-white">10+</div>
                                        <div class="text-xs font-black uppercase tracking-widest text-white/30">Experts Speakers</div>
                                    </div>
                                    <div class="glass-premium p-8 rounded-3xl text-center hover-3d group">
                                        <flux:icon name="identification" class="size-12 text-indigo-500 mx-auto mb-4 group-hover:scale-110 transition-transform" />
                                        <div class="text-3xl font-black text-white">20</div>
                                        <div class="text-xs font-black uppercase tracking-widest text-white/30">Seats Per Topic</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-10 pt-12 animate-in fade-in slide-in-from-bottom-12 duration-1000 delay-500">
                    <a href="{{ route('register') }}" class="group relative w-full md:w-auto px-20 py-10 rounded-[3.5rem] bg-brand-600 hover:bg-brand-500 text-white font-black text-3xl transition-all shadow-[0_30px_60px_-15px_rgba(124,58,237,0.5)] hover:scale-105 active:scale-95">
                        ลงทะเบียนตอนนี้
                        <flux:icon name="arrow-right" class="inline-block size-8 ml-4 group-hover:translate-x-3 transition-transform" />
                    </a>
                    <a href="{{ route('login') }}" class="glass-premium w-full md:w-auto px-16 py-10 rounded-[3.5rem] text-white font-black text-3xl transition-all hover:bg-white/5 border-white/5 hover:scale-105">
                        ตารางกิจกรรม
                    </a>
                </div>
            </div>
        </div>

        <!-- Dynamic Grid Section -->
        <section class="py-32 grid grid-cols-1 md:grid-cols-3 gap-12 animate-in fade-in slide-in-from-bottom-24 duration-1000 delay-700">
            <div class="glass-premium p-14 rounded-[4.5rem] hover-3d border-rose-500/10">
                <div class="size-24 bg-rose-500/10 rounded-[2rem] flex items-center justify-center mb-12 shadow-[0_0_30px_rgba(244,63,94,0.2)]">
                    <flux:icon name="cpu-chip" class="size-12 text-rose-500" />
                </div>
                <h4 class="text-3xl font-black mb-6 text-white">นวัตกรรมการสอน</h4>
                <p class="text-white/40 font-medium text-xl leading-relaxed">ใช้เทคนิคการสอนที่ทันสมัย เน้นการลงมือทำจริงเพื่อผลลัพธ์ที่ดีที่สุด</p>
            </div>
            
            <div class="glass-premium p-14 rounded-[4.5rem] hover-3d border-amber-500/10 mt-12 md:-mt-12">
                <div class="size-24 bg-amber-500/10 rounded-[2rem] flex items-center justify-center mb-12 shadow-[0_0_30px_rgba(245,158,11,0.2)]">
                    <flux:icon name="sparkles" class="size-12 text-amber-500" />
                </div>
                <h4 class="text-3xl font-black mb-6 text-white">ประสบการณ์พรีเมียม</h4>
                <p class="text-white/40 font-medium text-xl leading-relaxed">สัมผัสบรรยากาศการเรียนที่ไม่เหมือนใคร ในสังคมแห่งการแบ่งปัน</p>
            </div>

            <div class="glass-premium p-14 rounded-[4.5rem] hover-3d border-sky-500/10">
                <div class="size-24 bg-sky-500/10 rounded-[2rem] flex items-center justify-center mb-12 shadow-[0_0_30px_rgba(14,165,233,0.2)]">
                    <flux:icon name="trophy" class="size-12 text-sky-500" />
                </div>
                <h4 class="text-3xl font-black mb-6 text-white">เกียรติบัตรรับรอง</h4>
                <p class="text-white/40 font-medium text-xl leading-relaxed">รับประกาศนียบัตรเมื่อเรียนจบ เพื่อต่อยอดอนาคตการทำงาน</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-32 pb-24 border-t border-white/5 pt-20 flex flex-col md:flex-row justify-between items-center gap-12">
            <div class="flex items-center gap-4 opacity-30">
                <x-app-logo class="size-6 fill-white" />
                <span class="text-sm font-black tracking-widest uppercase">Workshop Hub</span>
            </div>
            <p class="text-white/20 font-black text-xs uppercase tracking-[0.4em]">&copy; 2026 Designed for Excellence.</p>
            <div class="flex items-center gap-16">
                <a href="#" class="text-white/20 hover:text-white transition-all text-[10px] font-black uppercase tracking-[0.3em]">Privacy</a>
                <a href="#" class="text-white/20 hover:text-white transition-all text-[10px] font-black uppercase tracking-[0.3em]">Terms</a>
                <a href="#" class="text-white/20 hover:text-white transition-all text-[10px] font-black uppercase tracking-[0.3em]">Contact</a>
            </div>
        </footer>
    </div>
</x-layouts::auth.simple>
