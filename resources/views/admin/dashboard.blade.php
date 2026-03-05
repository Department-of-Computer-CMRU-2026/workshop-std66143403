<x-layouts::app :title="__('แดชบอร์ดผู้ดูแลระบบ')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">แดชบอร์ดผู้ดูแลระบบ</h1>
            <a href="{{ route('admin.events.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                จัดการกิจกรรม
            </a>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="p-6 bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-neutral-600 dark:text-neutral-400">กิจกรรมทั้งหมด</h3>
                <p class="text-3xl font-bold mt-2">{{ $events->count() }}</p>
            </div>
            <div class="p-6 bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-neutral-600 dark:text-neutral-400">ผู้ลงทะเบียนทั้งหมด</h3>
                <p class="text-3xl font-bold mt-2">{{ $events->sum('registrations_count') }}</p>
            </div>
            <div class="p-6 bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-neutral-600 dark:text-neutral-400">ที่นั่งที่เหลือทั้งหมด</h3>
                <p class="text-3xl font-bold mt-2">{{ $events->sum('total_seats') - $events->sum('registrations_count') }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">ภาพรวมกิจกรรมล่าสุด</h2>
            <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">หัวข้อกิจกรรม</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">วิทยากร</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">ผู้ลงทะเบียน</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @foreach($events->take(5) as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $event->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">{{ $event->speaker }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $event->registrations_count }} / {{ $event->total_seats }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($event->registrations_count >= $event->total_seats)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">เต็มแล้ว</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">ว่าง</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
