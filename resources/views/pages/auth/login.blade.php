<x-layouts::auth.simple>
    <div class="flex flex-col gap-8">
        <div class="flex flex-col items-center gap-4 animate-in fade-in slide-in-from-bottom-4 duration-1000">
            <x-app-logo class="size-16 fill-white drop-shadow-2xl" />
            <div class="text-center">
                <h1 class="text-4xl font-black text-white tracking-tight">เข้าสู่ระบบ</h1>
                <p class="text-white/70 mt-2 font-medium">ยินดีต้อนรับสู่ระบบจัดการกิจกรรมพรีเมียม</p>
            </div>
        </div>

        <div class="glass-premium p-10 rounded-[2.5rem] animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-200">
            <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-8">
                @csrf
                
                @if ($errors->any())
                    <div class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl">
                        <ul class="list-disc list-inside text-sm text-rose-500 font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Email Address -->
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-sm font-medium text-white/70">{{ __('อีเมล') }}</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="w-full bg-white/5 border border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-500/50"
                    />
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-sm font-medium text-white/70">{{ __('รหัสผ่าน') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-white/40 hover:text-white transition-colors">
                                {{ __('ลืมรหัสผ่าน?') }}
                            </a>
                        @endif
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full bg-white/5 border border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-500/50"
                    />
                </div>

                <!-- Remember Me -->
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="remember" class="size-5 rounded border-white/10 bg-white/5 text-brand-500 focus:ring-brand-500/50 transition-all">
                    <span class="text-white/60 font-medium group-hover:text-white transition-colors">{{ __('จดจำฉันไว้ในระบบ') }}</span>
                </label>

                <div class="flex flex-col gap-4 mt-2">
                    <button type="submit" class="w-full h-16 rounded-3xl bg-white text-zinc-950 hover:bg-zinc-100 font-black text-xl transition-all hover:scale-[1.02] active:scale-95 shadow-2xl shadow-white/10 cursor-pointer">
                        {{ __('เข้าสู่ระบบตอนนี้') }}
                    </button>

                    @if (Route::has('register'))
                        <div class="text-center mt-6">
                            <span class="text-white/40 text-sm font-medium">{{ __('ยังไม่มีบัญชี?') }}</span>
                            <a href="{{ route('register') }}" class="text-sm font-black text-white hover:underline transition-all ml-2">
                                {{ __('สมัครสมาชิกใหม่ที่นี่') }}
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-layouts::auth.simple>
