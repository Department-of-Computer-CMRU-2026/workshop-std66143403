<x-layouts::app :title="__('ผู้ลงทะเบียนกิจกรรม')">
    <div class="max-w-4xl mx-auto h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">รายละเอียดกิจกรรม: {{ $event->title }}</h1>
                <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:underline text-sm">
                    &larr; กลับไปยังหน้ารวมกิจกรรม
                </a>
            </div>
            <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                แก้ไขกิจกรรม
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 p-6 mb-6">
            <h2 class="text-lg font-semibold border-b border-neutral-200 dark:border-neutral-700 pb-2 mb-4">ข้อมูลกิจกรรม</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div><span class="text-neutral-500">วิทยากร:</span> <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ $event->speaker }}</span></div>
                <div><span class="text-neutral-500">สถานที่:</span> <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ $event->location }}</span></div>
                <div><span class="text-neutral-500">การลงทะเบียน:</span> <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ $event->registrations->count() }} / {{ $event->total_seats }}</span></div>
                
                <div class="md:col-span-2">
                    <span class="text-neutral-500">สถานะ:</span> 
                    @if($event->registrations->count() >= $event->total_seats)
                        <span class="font-bold text-red-600">เต็ม ({{ $event->registrations->count() }}/{{ $event->total_seats }})</span>
                    @else
                        <span class="font-bold text-green-600">ว่าง (เหลือ {{ $event->total_seats - $event->registrations->count() }} ที่นั่ง)</span>
                    @endif
                </div>
            </div>
        </div>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">รายชื่อผู้ลงทะเบียน ({{ $event->registrations->count() }})</h2>
            <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">ลำดับ</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">ชื่อ-นามสกุล</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">อีเมล</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">วันที่ลงทะเบียน</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($event->registrations as $index => $registration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $registration->user->name ?? 'ไม่ระบุชื่อ' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">{{ $registration->user->email ?? 'ไม่มีข้อมูล' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-neutral-500">ยังไม่มีผู้ลงทะเบียนกิจกรรมนี้</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
