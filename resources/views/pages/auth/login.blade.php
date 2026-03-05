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
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-8">
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
                <flux:input
                    :label="__('อีเมล')"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="bg-white/5 border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10"
                />

                <!-- Password -->
                <div class="relative">
                    <flux:input
                        :label="__('รหัสผ่าน')"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="bg-white/5 border-white/10 text-white placeholder:text-white/30 h-14 rounded-2xl px-5 transition-all focus:bg-white/10"
                    />
                    
                    @if (Route::has('password.request'))
                        <flux:link :href="route('password.request')" variant="subtle" class="absolute right-0 top-0 text-xs font-bold text-white/40 hover:text-white transition-colors" wire:navigate>
                            {{ __('ลืมรหัสผ่าน?') }}
                        </flux:link>
                    @endif
                </div>

                <!-- Remember Me -->
                <flux:checkbox name="remember" :label="__('จดจำฉันไว้ในระบบ')" class="text-white/60 font-medium" />

                <div class="flex flex-col gap-4 mt-2">
                    <flux:button type="submit" variant="primary" class="w-full h-16 rounded-3xl bg-white text-zinc-950 hover:bg-zinc-100 font-black text-xl transition-all hover:scale-[1.02] active:scale-95 shadow-2xl shadow-white/10">
                        {{ __('เข้าสู่ระบบตอนนี้') }}
                    </flux:button>

                    @if (Route::has('register'))
                        <div class="text-center mt-6">
                            <span class="text-white/40 text-sm font-medium">{{ __('ยังไม่มีบัญชี?') }}</span>
                            <flux:link :href="route('register')" variant="subtle" class="text-sm font-black text-white hover:underline transition-all ml-2" wire:navigate>
                                {{ __('สมัครสมาชิกใหม่ที่นี่') }}
                            </flux:link>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-layouts::auth.simple>
