<x-layouts::app :title="__('ลงทะเบียนกิจกรรม')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100">กิจกรรม Senior-to-Junior Workshop</h1>
            <p class="text-neutral-600 dark:text-neutral-400 mt-2">ดูและลงทะเบียนสำหรับเวิร์กชอปที่กำลังจะมาถึง คุณสามารถลงทะเบียนได้หากยังมีที่นั่งว่าง</p>
        </div>

        <livewire:event-list />
    </div>
</x-layouts::app>
