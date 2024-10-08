<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Offer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="title" class="block text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $offer->title) }}" required class="form-input mt-1 block w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                @error('title')
                                    <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="description" class="block text-gray-700 dark:text-gray-300">Description</label>
                                <textarea name="description" id="description" required class="form-textarea mt-1 block w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">{{ old('description', $offer->description) }}</textarea>
                                @error('description')
                                    <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="discount_percentage" class="block text-gray-700 dark:text-gray-300">Discount Percentage</label>
                                <input type="number" name="discount_percentage" id="discount_percentage" value="{{ old('discount_percentage', $offer->discount_percentage) }}" min="0" max="100" required class="form-input mt-1 block w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                @error('discount_percentage')
                                    <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="month" class="block text-gray-700 dark:text-gray-300">Month</label>
                                <input type="text" name="month" id="month" value="{{ old('month', $offer->month) }}" required class="form-input mt-1 block w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                @error('month')
                                    <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="start_date" class="block text-gray-700 dark:text-gray-300">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $offer->start_date) }}" required class="form-input mt-1 block w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                @error('start_date')
                                    <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-gray-700 dark:text-gray-300">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $offer->end_date) }}" required class="form-input mt-1 block w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                                @error('end_date')
                                    <span class="text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-md px-4 py-2">
                                    <i class="fa fa-save"></i> Update Offer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
