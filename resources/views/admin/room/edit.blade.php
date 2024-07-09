<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('rooms.update', $room->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="bg-gray-800 p-5 rounded-lg">

                            <!-- Title -->
                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('title', $room->title) }}" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-rich-text-editor id="description" name="description"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">{{ old('description', $room->description) }}</x-rich-text-editor>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Check-In Information -->
                            <div class="mb-4">
                                <x-input-label for="check_in_info" :value="__('Check-In Information')" />
                                <textarea id="check_in_info" name="check_in_info" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">{{ old('check_in_info', $room->check_in_info) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('check_in_info')" />
                            </div>

                            <!-- Check-Out Information -->
                            <div class="mb-4">
                                <x-input-label for="check_out_info" :value="__('Check-Out Information')" />
                                <textarea id="check_out_info" name="check_out_info" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">{{ old('check_out_info', $room->check_out_info) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('check_out_info')" />
                            </div>

                            <!-- House Rules -->
                            <div class="mb-4">
                                <x-input-label for="house_rules" :value="__('House Rules')" />
                                <textarea id="house_rules" name="house_rules" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">{{ old('house_rules', $room->house_rules) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('house_rules')" />
                            </div>

                            <!-- Children & Extra Beds Information -->
                            <div class="mb-4">
                                <x-input-label for="children_extra_beds_info" :value="__('Children & Extra Beds Information')" />
                                <textarea id="children_extra_beds_info" name="children_extra_beds_info" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">{{ old('children_extra_beds_info', $room->children_extra_beds_info) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('children_extra_beds_info')" />
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                @if ($room->image)
                                    <img src="{{ asset('uploads/room_images/' . $room->image) }}" alt="Room Image"
                                        class="mt-2 w-32 h-32 object-cover">
                                @endif
                            </div>


                            <!-- Price -->
                            <div class="mb-4">
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('price', $room->price) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            <!-- Selected In Date -->
                            <div class="mb-4">
                                <x-input-label for="selected_in_date" :value="__('Selected In Date')" />
                                <input id="selected_in_date" name="selected_in_date" type="date"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('selected_in_date', $room->selected_in_date) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('selected_in_date')" />
                            </div>

                            <!-- Selected Out Date -->
                            <div class="mb-4">
                                <x-input-label for="selected_out_date" :value="__('Selected Out Date')" />
                                <input id="selected_out_date" name="selected_out_date" type="date"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('selected_out_date', $room->selected_out_date) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('selected_out_date')" />
                            </div>

                            <!-- Adults -->
                            <div class="mb-4">
                                <x-input-label for="adults" :value="__('Adults')" />
                                <input id="adults" name="adults" type="number"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('adults', $room->adults) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('adults')" />
                            </div>

                            <!-- Children -->
                            <div class="mb-4">
                                <x-input-label for="children" :value="__('Children')" />
                                <input id="children" name="children" type="number"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('children', $room->children) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('children')" />
                            </div>

                            <!-- Number of Rooms -->
                            <div class="mb-4">
                                <x-input-label for="number_of_rooms" :value="__('Number of Rooms')" />
                                <input id="number_of_rooms" name="number_of_rooms" type="number"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('number_of_rooms', $room->number_of_rooms) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('number_of_rooms')" />
                            </div>

                            <!-- Amenities (multiple selection example) -->
                            <div class="mb-4">
                                <x-input-label for="amenities" :value="__('Amenities')" />
                                <div class="flex flex-wrap">
                                    @php
                                        $amenities = explode(',', $room->amenities);
                                    @endphp
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_wifi" class="inline-flex items-center">
                                            <input id="amenity_wifi" name="amenities[]" type="checkbox"
                                                value="wifi" class="form-checkbox text-gray-700"
                                                {{ in_array('wifi', old('amenities', $amenities)) ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-200">WiFi</span>
                                        </label>
                                    </div>
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_parking" class="inline-flex items-center">
                                            <input id="amenity_parking" name="amenities[]" type="checkbox"
                                                value="parking" class="form-checkbox text-gray-700"
                                                {{ in_array('parking', old('amenities', $amenities)) ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-200">Parking</span>
                                        </label>
                                    </div>
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_pool" class="inline-flex items-center">
                                            <input id="amenity_pool" name="amenities[]" type="checkbox"
                                                value="pool" class="form-checkbox text-gray-700"
                                                {{ in_array('pool', old('amenities', $amenities)) ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-200">Pool</span>
                                        </label>
                                    </div>
                                    <!-- Add more amenities as needed -->
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('amenities')" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
