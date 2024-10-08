<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-4">
                <!-- Number of Users Card -->
                <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 animate-fade-in">
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 flex flex-col h-full transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="text-gray-900 dark:text-gray-100 flex-grow">
                            <h3 class="text-sm font-semibold">{{ __('Number of Users') }}</h3>
                            <h3 id="userCount" class="mt-2 text-5xl font-bold">{{ $userCount }}</h3>
                        </div>
                    </div>
                </div>

                <!-- People Contacted in Last 24 Hours Card -->
                <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 animate-fade-in delay-100">
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 flex flex-col h-full transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="text-gray-900 dark:text-gray-100 flex-grow">
                            <h3 class="text-sm font-semibold">{{ __('People Contacted in Last 24 Hours') }}</h3>
                            <h3 id="contactCount" class="mt-2 text-5xl font-bold">{{ $contactCount }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Number of Reserved Rooms Card -->
                <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 animate-fade-in delay-200">
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 flex flex-col h-full transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                        <div class="text-gray-900 dark:text-gray-100 flex-grow">
                            <h3 class="text-sm font-semibold">{{ __('Number of Reserved Rooms') }}</h3>
                            <h3 id="reservedRoomsCount" class="mt-2 text-5xl font-bold">{{ $reservedRoomsCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Rooms Table -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Available Rooms') }}</h2>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">{{ __('ID') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Title') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Description') }}</th>
                                    <th scope="col" class="px-6 py-3">{{ __('Price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableRooms as $room)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $room->id }}</td>
                                        <td class="px-6 py-4">{{ $room->title }}</td>
                                        <td class="px-6 py-4">{{ strip_tags($room->description) }}</td>

                                        <td class="px-6 py-4">${{ $room->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
