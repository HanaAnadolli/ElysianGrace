<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Service') }}
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

                    <form method="POST" action="{{ route('services.update', $service->id) }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="bg-gray-800 p-6 rounded-lg">

                            <!-- Title -->
                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    value="{{ old('title', $service->title) }}" required autofocus
                                    autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-rich-text-editor id="description" name="description"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                    {!! old('description', $service->description) !!}
                                </x-rich-text-editor>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>


                            <!-- Working Hours -->
                            <div class="mb-4">
                                <x-input-label for="working_hours" :value="__('Working Hours')" />
                                <textarea id="working_hours" name="working_hours" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                    placeholder="e.g., Monday to Friday: 08:00 - 22:00, Saturday: 10:00 - 20:00">{{ old('working_hours', $service->working_hours) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('working_hours')" />
                            </div>

                            <!-- Rules -->
                            <div class="mb-4">
                                <x-input-label for="rules" :value="__('Rules')" />
                                <textarea id="rules" name="rules" rows="4"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">{{ old('rules', $service->rules) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('rules')" />
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <x-input-label for="image" :value="__('Image')" />
                                <input id="image" name="image" type="file"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                @if ($service->image)
                                    <div class="mt-4">
                                        <img src="{{ asset('uploads/services_images/' . $service->image) }}"
                                            alt="Service Image" class="w-32 h-32 object-cover">
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
