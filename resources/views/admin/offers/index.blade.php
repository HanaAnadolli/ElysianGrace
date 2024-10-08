<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Offers') }}
            </h2>
            <x-create-button href="{{ route('offers.create') }}" class="bg-green-500 hover:bg-green-700">
                Create
            </x-create-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $offer->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $offer->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $offer->discount_percentage }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $offer->month }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $offer->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $offer->end_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
