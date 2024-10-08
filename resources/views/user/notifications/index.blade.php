<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @php
                        $notifications = $notifications ?? collect();
                        $filters = ['all', 'new', 'offers', 'bookings', 'old'];
                        $selectedFilter = request('filter', 'all');
                    @endphp

                    <div class="mb-4">
                        @foreach ($filters as $filter)
                            <a href="{{ route('user.notifications', ['filter' => $filter]) }}"
                               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded {{ $selectedFilter === $filter ? 'bg-gray-600' : '' }}">
                                {{ ucfirst($filter) }}
                            </a>
                        @endforeach
                    </div>

                    @php
                        $filteredNotifications = $notifications->filter(function($notification) use ($selectedFilter) {
                            if ($selectedFilter === 'new') {
                                return !$notification['is_past'];
                            } elseif ($selectedFilter === 'offers') {
                                return $notification['type'] === 'offer';
                            } elseif ($selectedFilter === 'bookings') {
                                return $notification['type'] === 'booking';
                            } elseif ($selectedFilter === 'old') {
                                return $notification['is_past'];
                            }
                            return true;
                        });
                    @endphp

                    @if ($filteredNotifications->isEmpty())
                        <div style="background-color: #38a169; color: #e2e8f0; border: 1px solid #2f855a; padding: 1rem; border-radius: 0.375rem;">
                            <strong class="font-bold">Good news!</strong>
                            <span class="block sm:inline">You have no notifications matching this filter.</span>
                        </div>
                    @else
                        @foreach ($filteredNotifications as $notification)
                            <div style="background-color: #2d3748; border: 1px solid #4a5568; border-radius: 0.375rem; padding: 1rem; margin-bottom: 1rem;">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas {{ $notification['type'] === 'booking' ? 'fa-bed' : 'fa-gift' }}"
                                           style="color: {{ $notification['type'] === 'booking' ? '#68d391' : '#f6e05e' }}; font-size: 1.2rem;"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold" style="color: #edf2f7;">
                                            {{ $notification['type'] === 'booking' ? $notification['room_name'] : $notification['offer_title'] }}
                                        </h4>
                                        <p style="color: #e2e8f0;">{{ $notification['notification'] }}</p>
                                        @if ($notification['type'] === 'offer')
                                            <p style="color: #e2e8f0;">{{ $notification['offer_description'] }}</p>
                                        @endif
                                        <p style="color: #cbd5e0;">
                                            {{ $notification['type'] === 'booking' ? $notification['check_in_date'] : $notification['end_date'] }}
                                        </p>
                                        @if ($notification['is_past'])
                                            <p style="color: #e53e3e;">(Past Notification)</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
