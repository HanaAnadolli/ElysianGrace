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

            <!-- Chart Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Monthly User Growth') }}</h3>
                <canvas id="userChart" height="400"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // CountUp animations
            const userCount = new CountUp('userCount', {{ $userCount }});
            if (!userCount.error) {
                userCount.start();
            } else {
                console.error(userCount.error);
            }

            const contactCount = new CountUp('contactCount', {{ $contactCount }});
            if (!contactCount.error) {
                contactCount.start();
            } else {
                console.error(contactCount.error);
            }

            const reservedRoomsCount = new CountUp('reservedRoomsCount', {{ $reservedRoomsCount }});
            if (!reservedRoomsCount.error) {
                reservedRoomsCount.start();
            } else {
                console.error(reservedRoomsCount.error);
            }

            // Chart.js initialization
            const ctx = document.getElementById('userChart').getContext('2d');
            const userChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($months), // Array of month names
                    datasets: [{
                        label: 'Number of Users',
                        data: @json($userCounts), // Array of user counts for each month
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Users'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }
    </style>
</x-app-layout>
