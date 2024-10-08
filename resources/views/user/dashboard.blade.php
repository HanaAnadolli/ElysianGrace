<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Welcome Message -->
    <div class="py-6 text-center">
        <h2 class="text-2xl font-bold text-white">Welcome, {{ Auth::user()->name }}!</h2>
        <p class="text-lg text-white">We hope you're having a great day. Here's your dashboard with all the latest
            information about your bookings and offers.</p>
    </div>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Display Bookings -->
                @if ($bookings->isEmpty())
                    <div class="col-span-3 text-center text-white">
                        <p>You don't have any bookings yet. Start planning your next stay with us!</p>
                    </div>
                @else
                    @foreach ($bookings as $booking)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ $booking->room->title }}</h3>
                            <p class="font-bold text-gray-800 dark:text-gray-200">
                                Check-in Date:
                                {{ Carbon\Carbon::parse($booking->room->selected_in_date)->format('Y-m-d') }}
                            </p>
                            <p class="font-bold text-gray-800 dark:text-gray-200">
                                Check-out Date:
                                {{ Carbon\Carbon::parse($booking->room->selected_out_date)->format('Y-m-d') }}
                            </p>
                        </div>
                    @endforeach
                @endif

                <!-- Display Offers -->
                @if ($offers->isEmpty())
                    <div class="col-span-3 text-center text-white">
                        <p>There are no current offers available. Check back later for amazing deals!</p>
                    </div>
                @else
                    @foreach ($offers as $offer)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ $offer->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Offer valid until: {{ $offer->end_date }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $offer->description }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
