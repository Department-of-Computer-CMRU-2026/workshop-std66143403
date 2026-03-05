<x-layouts::app :title="__('Add Event')">
    <div class="max-w-3xl mx-auto h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">Add New Event</h1>
            <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">&larr; Back to Events</a>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 p-6">
            <form action="{{ route('admin.events.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Event Title</label>
                    <input type="text" name="title" id="title" class="w-full rounded-md border-neutral-300 dark:border-neutral-600 dark:bg-neutral-900 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('title') }}" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="speaker" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Speaker</label>
                    <input type="text" name="speaker" id="speaker" class="w-full rounded-md border-neutral-300 dark:border-neutral-600 dark:bg-neutral-900 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('speaker') }}" required>
                    @error('speaker') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4 text-neutral-900 dark:text-neutral-100">
                    <label for="location" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Location / Room</label>
                    <input type="text" name="location" id="location" class="w-full rounded-md border-neutral-300 dark:border-neutral-600 dark:bg-neutral-900 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('location') }}" required>
                    @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="total_seats" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Total Seats (Capacity)</label>
                    <input type="number" name="total_seats" id="total_seats" class="w-full rounded-md border-neutral-300 dark:border-neutral-600 dark:bg-neutral-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-neutral-900 dark:text-neutral-100" value="{{ old('total_seats') }}" min="1" required>
                    @error('total_seats') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                        Save Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
