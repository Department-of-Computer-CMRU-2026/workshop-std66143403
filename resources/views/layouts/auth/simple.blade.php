<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-zinc-950 font-sans selection:bg-brand-500/30 overflow-x-hidden">
        <div class="relative min-h-screen flex flex-col items-center justify-center p-6 lg:p-12">
            <!-- Animated Background -->
            <div class="fixed inset-0 -z-10 overflow-hidden">
                <div class="absolute inset-0 bg-animate-gradient opacity-60"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 contrast-150 brightness-110"></div>
                
                <div class="absolute top-[-10%] left-[-10%] size-[500px] bg-brand-600/10 rounded-full blur-[100px] animate-pulse"></div>
                <div class="absolute bottom-[-10%] right-[-10%] size-[600px] bg-indigo-600/10 rounded-full blur-[120px] animate-pulse delay-1000"></div>
            </div>
            
            <div class="relative z-10 w-full max-w-7xl">
                {{ $slot }}
            </div>
        </div>
        @fluxScripts
    </body>
</html>
