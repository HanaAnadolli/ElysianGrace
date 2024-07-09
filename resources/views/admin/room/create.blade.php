<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('rooms.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-gray-800 p-5 rounded-lg">

                            <!-- Title -->
                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-rich-text-editor id="description" name="description"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Check-In Information -->
                            <div class="mb-4">
                                <x-input-label for="check_in_info" :value="__('Check-In Information')" />
                                <textarea id="check_in_info" name="check_in_info" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('check_in_info')" />
                            </div>

                            <!-- Check-Out Information -->
                            <div class="mb-4">
                                <x-input-label for="check_out_info" :value="__('Check-Out Information')" />
                                <textarea id="check_out_info" name="check_out_info" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('check_out_info')" />
                            </div>

                            <!-- House Rules -->
                            <div class="mb-4">
                                <x-input-label for="house_rules" :value="__('House Rules')" />
                                <textarea id="house_rules" name="house_rules" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('house_rules')" />
                            </div>

                            <!-- Children & Extra Beds Information -->
                            <div class="mb-4">
                                <x-input-label for="children_extra_beds_info" :value="__('Children & Extra Beds Information')" />
                                <textarea id="children_extra_beds_info" name="children_extra_beds_info" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('children_extra_beds_info')" />
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            <!-- Selected In Date -->
                            <div class="mb-4">
                                <x-input-label for="selected_in_date" :value="__('Selected In Date')" />
                                <input id="selected_in_date" name="selected_in_date" type="date"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('selected_in_date')" />
                            </div>

                            <!-- Selected Out Date -->
                            <div class="mb-4">
                                <x-input-label for="selected_out_date" :value="__('Selected Out Date')" />
                                <input id="selected_out_date" name="selected_out_date" type="date"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('selected_out_date')" />
                            </div>

                            <!-- Adults -->
                            <div class="mb-4">
                                <x-input-label for="adults" :value="__('Adults')" />
                                <input id="adults" name="adults" type="number" min="0"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('adults')" />
                            </div>

                            <!-- Children -->
                            <div class="mb-4">
                                <x-input-label for="children" :value="__('Children')" />
                                <input id="children" name="children" type="number" min="0"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('children')" />
                            </div>

                            <!-- Number of Rooms -->
                            <div class="mb-4">
                                <x-input-label for="number_of_rooms" :value="__('Number of Rooms')" />
                                <input id="number_of_rooms" name="number_of_rooms" type="number" min="1"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('number_of_rooms')" />
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                    <option value="available">Available</option>
                                    <option value="reserved">Reserved</option>
                                    <option value="not_available">Not Available</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <!-- Amenities -->
                            <div class="mb-4">
                                <x-input-label for="amenities" :value="__('Amenities')" />
                                <div class="flex flex-wrap">
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_wifi" class="inline-flex items-center">
                                            <input id="amenity_wifi" name="amenities[]" type="checkbox"
                                                value="wifi" class="form-checkbox text-gray-700" /> <span
                                                class="ml-2 text-gray-200">WiFi</span>
                                        </label>
                                    </div>
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_parking" class="inline-flex items-center">
                                            <input id="amenity_parking" name="amenities[]" type="checkbox"
                                                value="parking" class="form-checkbox text-gray-700" /> <span
                                                class="ml-2 text-gray-200">Parking</span>
                                        </label>
                                    </div>
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_pool" class="inline-flex items-center">
                                            <input id="amenity_pool" name="amenities[]" type="checkbox"
                                                value="pool" class="form-checkbox text-gray-700" /> <span
                                                class="ml-2 text-gray-200">Swimming Pool</span>
                                        </label>
                                    </div>
                                    <div class="mr-4 mb-2">
                                        <label for="amenity_gym" class="inline-flex items-center">
                                            <input id="amenity_gym" name="amenities[]" type="checkbox"
                                                value="gym" class="form-checkbox text-gray-700" /> <span
                                                class="ml-2 text-gray-200">Gym</span>
                                        </label>
                                    </div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('amenities')" />
                            </div>

                            <!-- Submit Button -->
                            <x-submit-button value="Create Room" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
