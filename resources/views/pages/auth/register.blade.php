<x-layouts::auth.simple>
    <div class="flex flex-col gap-8">
        <!-- Register Header -->
        <div class="flex flex-col items-center gap-4 animate-in fade-in slide-in-from-bottom-4 duration-1000">
            <x-app-logo class="size-16 fill-white drop-shadow-2xl" />
            <div class="text-center">
                <h1 class="text-4xl font-black text-white tracking-tight">สมัครสมาชิก</h1>
                <p class="text-white/40 mt-2 font-medium">เข้าร่วมชุมชน Workshop พรีเมียมกับเรา</p>
            </div>
        </div>

        <div class="glass-premium p-10 md:p-12 rounded-[3rem] animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-200">
            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-8">
                @csrf

                @if ($errors->any())
                    <div class="p-6 bg-rose-500/10 border border-rose-500/20 rounded-3xl">
                        <ul class="list-disc list-inside text-sm text-rose-500 font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Name -->
                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-medium text-white/70">{{ __('ชื่อ-นามสกุล') }}</label>
                        <input
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            type="text"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="John Doe"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-500/50"
                        />
                    </div>

                    <!-- Email Address -->
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-medium text-white/70">{{ __('อีเมล') }}</label>
                        <input
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="email@example.com"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-500/50"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-sm font-medium text-white/70">{{ __('รหัสผ่าน') }}</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-500/50"
                        />
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="text-sm font-medium text-white/70">{{ __('ยืนยันรหัสผ่าน') }}</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full bg-white/5 border border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-brand-500/50"
                        />
                    </div>
                </div>

                <div class="flex flex-col gap-6 mt-4">
                    <button type="submit" class="w-full h-16 rounded-3xl bg-white text-zinc-950 hover:bg-zinc-100 font-black text-xl transition-all hover:scale-[1.02] active:scale-95 shadow-2xl shadow-white/10 cursor-pointer">
                        {{ __('สร้างบัญชีผู้ใช้ใหม่') }}
                    </button>

                    <div class="text-center">
                        <span class="text-white/40 text-sm font-medium">{{ __('มีบัญชีอยู่แล้ว?') }}</span>
                        <a href="{{ route('login') }}" class="text-sm font-black text-white hover:underline transition-all ml-2">
                            {{ __('เข้าสู่ระบบที่นี่') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::auth.simple>
