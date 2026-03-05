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
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-8">
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
                    <flux:input
                        name="name"
                        :label="__('ชื่อ-นามสกุล')"
                        :value="old('name')"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                        class="bg-white/5 border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10"
                    />

                    <!-- Email Address -->
                    <flux:input
                        name="email"
                        :label="__('อีเมล')"
                        :value="old('email')"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="bg-white/5 border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Password -->
                    <flux:input
                        name="password"
                        :label="__('รหัสผ่าน')"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="bg-white/5 border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10"
                    />

                    <!-- Confirm Password -->
                    <flux:input
                        name="password_confirmation"
                        :label="__('ยืนยันรหัสผ่าน')"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="bg-white/5 border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10"
                    />
                </div>

                <div class="flex flex-col gap-6 mt-4">
                    <flux:button type="submit" variant="primary" class="w-full h-16 rounded-3xl bg-white text-zinc-950 hover:bg-zinc-100 font-black text-xl transition-all hover:scale-[1.02] active:scale-95 shadow-2xl shadow-white/10">
                        {{ __('สร้างบัญชีผู้ใช้ใหม่') }}
                    </flux:button>

                    <div class="text-center">
                        <span class="text-white/40 text-sm font-medium">{{ __('มีบัญชีอยู่แล้ว?') }}</span>
                        <flux:link :href="route('login')" variant="subtle" class="text-sm font-black text-white hover:underline transition-all ml-2" wire:navigate>
                            {{ __('เข้าสู่ระบบที่นี่') }}
                        </flux:link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts::auth.simple>
