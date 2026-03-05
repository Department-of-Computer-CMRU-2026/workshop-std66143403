<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Senior-to-Junior Workshop') }} - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@300;400;500;600;700&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-zinc-950 text-white font-[Inter] selection:bg-brand-500/30">
        <!-- Background Animation -->
        <div class="fixed inset-0 overflow-hidden -z-10">
            <div class="absolute inset-0 bg-animate-gradient opacity-60"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 contrast-150 brightness-110"></div>
            
            <!-- Floating Orbs -->
            <div class="absolute top-[10%] left-[15%] size-[500px] bg-brand-600/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-[20%] right-[10%] size-[600px] bg-indigo-600/20 rounded-full blur-[150px] animate-pulse delay-1000"></div>
        </div>

        <div class="relative min-h-screen flex flex-col">
            <!-- Header/Navigation -->
            <header class="w-full max-w-7xl mx-auto px-10 py-10 flex justify-between items-center z-50">
                <div class="flex items-center gap-3">
                    <x-app-logo class="size-10 fill-white drop-shadow-lg" />
                    <span class="text-xl font-black tracking-tighter uppercase">Workshop Hub</span>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex items-center gap-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="glass px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-105 transition-all">แดชบอร์ด</a>
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
            <main class="flex-1 flex flex-col items-center justify-center -mt-20 px-6">
                <div class="max-w-5xl w-full text-center space-y-12 animate-in fade-in slide-in-from-bottom-12 duration-1000">
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
                            <span class="text-gradient">WORKSHOP</span>
                        </h1>
                        <p class="text-xl md:text-3xl font-medium text-white/50 max-w-3xl mx-auto font-['IBM_Plex_Sans_Thai'] leading-relaxed">
                            ถ่ายทอดประสบการณ์จากพี่สู่น้อง<br/>
                            พร้อมเวิร์กชอปสุดพรีเมียมที่จะเปลี่ยนคุณเป็นมือโปร
                        </p>
                    </div>

                    <!-- Scenario Card -->
                    <div class="flex justify-center">
                        <div class="glass p-8 md:p-12 rounded-[3.5rem] border-white/5 max-w-3xl relative overflow-hidden group hover:shadow-brand-500/20 transition-all duration-700">
                            <div class="absolute top-0 left-0 w-full h-1 bg-linear-to-r from-brand-500 to-indigo-500"></div>
                            <p class="text-lg md:text-2xl font-medium text-white/80 font-['IBM_Plex_Sans_Thai'] leading-relaxed italic">
                                "มหาวิทยาลัยจะจัดงาน <strong>Senior-to-Junior Workshop</strong> โดยมีหัวข้อแยกย่อยหลายหัวข้อ แต่ละหัวข้อมีวิทยากรต่างกัน และมีการ <strong>จำกัดจำนวนที่นั่ง</strong> เพื่อความเหมาะสมในการสอน"
                            </p>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                        <a href="{{ route('register') }}" class="group relative w-full md:w-auto px-12 py-6 rounded-[2.5rem] bg-brand-600 hover:bg-brand-500 text-white font-black text-2xl transition-all shadow-3xl shadow-brand-600/30 hover:scale-105 active:scale-95">
                            ลงทะเบียนตอนนี้
                            <flux:icon name="arrow-right" class="inline-block size-6 ml-3 group-hover:translate-x-2 transition-transform" />
                        </a>
                        <a href="{{ route('login') }}" class="glass w-full md:w-auto px-12 py-6 rounded-[2.5rem] text-white font-black text-2xl transition-all hover:bg-white/10 border-white/5 hover:scale-105">
                            ดูรายละเอียดกิจกรรม
                        </a>
                    </div>
                </div>

                <!-- Feature Grid -->
                <div class="max-w-7xl w-full grid grid-cols-1 md:grid-cols-3 gap-8 mt-48 mb-32">
                    <div class="glass p-10 rounded-[3rem] border-white/5 hover:-translate-y-4 transition-all duration-500 cursor-default">
                        <div class="size-16 bg-brand-500/10 rounded-2xl flex items-center justify-center mb-8">
                            <flux:icon name="users" class="size-8 text-brand-500" />
                        </div>
                        <h4 class="text-2xl font-black mb-4">โดยวิทยากรผู้เชี่ยวชาญ</h4>
                        <p class="text-white/40 font-medium font-['IBM_Plex_Sans_Thai'] text-lg">หัวข้อที่หลากหลายจากวิทยากรตัวจริงที่พร้อมแชร์ประสบการณ์สุดเอ็กซ์คลูซีฟ</p>
                    </div>
                    
                    <div class="glass p-10 rounded-[3rem] border-white/5 hover:-translate-y-4 transition-all duration-500 cursor-default">
                        <div class="size-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center mb-8">
                            <flux:icon name="armchair" class="size-8 text-indigo-500" />
                        </div>
                        <h4 class="text-2xl font-black mb-4">จำกัดจำนวนที่นั่ง</h4>
                        <p class="text-white/40 font-medium font-['IBM_Plex_Sans_Thai'] text-lg">เพื่อคุณภาพสูงสุดในการเรียนการสอน เราจึงจำกัดสิทธิ์ผู้เข้าร่วมในแต่ละเวิร์กชอป</p>
                    </div>

                    <div class="glass p-10 rounded-[3rem] border-white/5 hover:-translate-y-4 transition-all duration-500 cursor-default">
                        <div class="size-16 bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-8">
                            <flux:icon name="check-circle" class="size-8 text-emerald-500" />
                        </div>
                        <h4 class="text-2xl font-black mb-4">ลงทะเบียนง่าย</h4>
                        <p class="text-white/40 font-medium font-['IBM_Plex_Sans_Thai'] text-lg">ระบบลงทะเบียนที่รวดเร็ว พร้อมจัดการสิทธิ์และคิวผู้เข้าร่วมอย่างเป็นระบบ</p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="w-full max-w-7xl mx-auto px-10 py-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
                <p class="text-white/20 font-black text-sm uppercase tracking-[0.2em]">&copy; 2026 Senior-to-Junior Workshop Hub. All rights reserved.</p>
                <div class="flex items-center gap-10">
                    <a href="#" class="text-white/20 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">Privacy Policy</a>
                    <a href="#" class="text-white/20 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">Terms of Service</a>
                </div>
            </footer>
        </div>
    </body>
</html>
