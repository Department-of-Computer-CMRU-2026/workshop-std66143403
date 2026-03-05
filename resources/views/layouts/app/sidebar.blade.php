<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 antialiased font-sans flex">
        <flux:sidebar sticky collapsible="mobile" class="h-screen border-e border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm">
            <flux:sidebar.header class="py-8">
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate class="transition-transform hover:scale-105" />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav class="px-2">
                <flux:sidebar.group :heading="__('เมนูหลัก')" class="grid gap-1">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="rounded-2xl font-bold py-3">
                        {{ __('แผงควบคุม') }}
                    </flux:sidebar.item>

                    @if(auth()->user()->role === 'admin')
                        <flux:sidebar.item icon="book-open-text" :href="route('admin.events.index')" :current="request()->routeIs('admin.events.*')" wire:navigate class="rounded-2xl font-bold py-3">
                            {{ __('จัดการกิจกรรม') }}
                        </flux:sidebar.item>
                    @else
                        <flux:sidebar.item icon="book-open-text" :href="route('user.events')" :current="request()->routeIs('user.events')" wire:navigate class="rounded-2xl font-bold py-3">
                            {{ __('กิจกรรมทั้งหมด') }}
                        </flux:sidebar.item>
                    @endif
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav class="px-2 pb-6">
                <flux:sidebar.item icon="cog" :href="route('profile.edit')" :current="request()->routeIs('profile.edit')" wire:navigate class="rounded-2xl font-bold py-3 text-zinc-500 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    {{ __('การตั้งค่า') }}
                </flux:sidebar.item>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:sidebar.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer rounded-2xl font-bold py-3 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all"
                    >
                        {{ __('ออกจากระบบ') }}
                    </flux:sidebar.item>
                </form>
            </flux:sidebar.nav>
        </flux:sidebar>

        <!-- Mobile Header -->
        <flux:header class="lg:hidden bg-white/90 backdrop-blur-md dark:bg-zinc-900/90 border-b border-zinc-200 dark:border-zinc-800 sticky top-0 z-50">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
                <flux:menu class="min-w-48 rounded-2xl shadow-2xl">
                    <div class="px-4 py-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-t-xl mb-1">
                        <flux:heading class="font-bold truncate">{{ auth()->user()->name }}</flux:heading>
                        <flux:text class="text-xs truncate opacity-70">{{ auth()->user()->email }}</flux:text>
                    </div>
                    <flux:menu.separator />
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="font-bold">{{ __('Settings') }}</flux:menu.item>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full font-bold text-red-500">{{ __('Log out') }}</flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <flux:main class="w-full min-h-screen px-4 md:px-8 lg:px-12 py-10 lg:py-12">
            {{ $slot }}
        </flux:main>

        @fluxScripts
    </body>
</html>
