<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Slider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('slider.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-gray-800 p-5 rounded-lg">
                            <div class="flex mb-4" style="display: flex;">
                                <div class="flex-1 mr-2">
                                    <x-input-label for="title" :value="__('Title')" style="margin-bottom: 7px" />
                                    <x-text-input id="title" name="title" type="text"
                                        class="mt-1 block w-full bg-gray-700 text-white border-gray-600" required
                                        autofocus autocomplete="title" />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div class="flex-1 ml-2">
                                    <x-input-label for="link" :value="__('Link')" style="margin-bottom: 7px" />
                                    <x-text-input id="link" name="link" type="text"
                                        class="mt-1 block w-full bg-gray-700 text-white border-gray-600" required
                                        autofocus autocomplete="link" />
                                    <x-input-error class="mt-2" :messages="$errors->get('link')" />
                                </div>
                            </div>

                            <div class="flex mb-4" style="display: flex;">
                                <div class="flex-1 mr-2">
                                    <x-input-label for="banner" :value="__('Image')" style="margin-bottom: 7px" />
                                    <x-image-uploader />
                                    <x-input-error class="mt-2" :messages="$errors->get('banner')" />
                                </div>

                                <div class="flex-1 ml-2">
                                    <x-input-label for="status" :value="__('Status')" style="margin-bottom: 7px" />
                                    <x-dropdown-status id="status" name="status" />
                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" style="margin-bottom: 7px" />
                                <x-rich-text-editor id="description" name="description"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- <x-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save
                            </x-button> --}}
                            <x-submit-button value="Submit" />

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
