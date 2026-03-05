<x-layouts::app :title="__('Event Registrations')">
    <div class="max-w-4xl mx-auto h-full w-full flex-1 flex-col gap-4 p-4">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Event Details: {{ $event->title }}</h1>
                <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">&larr; Back to Events</a>
            </div>
            <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                Edit Event
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-lg font-bold mb-4 border-b pb-2 dark:border-neutral-700">Event Information</h2>
                <div class="space-y-2">
                    <p><span class="font-semibold text-neutral-600 dark:text-neutral-400">Speaker:</span> {{ $event->speaker }}</p>
                    <p><span class="font-semibold text-neutral-600 dark:text-neutral-400">Location:</span> {{ $event->location }}</p>
                    <p><span class="font-semibold text-neutral-600 dark:text-neutral-400">Status:</span> 
                        @if($event->registrations->count() >= $event->total_seats)
                            <span class="text-red-500 font-bold">Full ({{ $event->registrations->count() }}/{{ $event->total_seats }})</span>
                        @else
                            <span class="text-green-500 font-bold">Available ({{ $event->total_seats - $event->registrations->count() }} seats left)</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">Registered Users ({{ $event->registrations->count() }})</h2>
            <div class="overflow-x-auto bg-white dark:bg-neutral-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">User Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Registered At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($event->registrations as $index => $registration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $registration->user->name ?? 'Unknown User' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">{{ $registration->user->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500 dark:text-neutral-400">{{ $registration->created_at->format('M d, Y H:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-neutral-500">No users have registered for this event yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
