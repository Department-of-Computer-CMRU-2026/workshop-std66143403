<x-layouts::app :title="__('แก้ไขกิจกรรม')">
    <div class="max-w-3xl mx-auto h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">แก้ไขกิจกรรม: {{ $event->title }}</h1>
            <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:underline">
                &larr; กลับไปยังหน้ารวมกิจกรรม
            </a>
        </div>
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 p-6">
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">หัวข้อกิจกรรม</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100" value="{{ old('title', $event->title) }}" required>
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="speaker" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">วิทยากร</label>
                    <input type="text" name="speaker" id="speaker" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100" value="{{ old('speaker', $event->speaker) }}" required>
                    @error('speaker') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="location" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">สถานที่ / ห้องจัดกิจกรรม</label>
                        <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100" value="{{ old('location', $event->location) }}" required>
                        @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="total_seats" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">จำนวนที่นั่งทั้งหมด</label>
                        <input type="number" min="1" name="total_seats" id="total_seats" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-100" value="{{ old('total_seats', $event->total_seats) }}" required>
                        @error('total_seats') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        อัปเดตกิจกรรม
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
