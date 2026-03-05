<x-layouts::app :title="__('Events Registration')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100">Senior-to-Junior Workshop</h1>
            <p class="text-neutral-600 dark:text-neutral-400 mt-2">Browse and register for the upcoming workshops. You can register for an event if seats are available.</p>
        </div>

        <livewire:event-list />
    </div>
</x-layouts::app>
