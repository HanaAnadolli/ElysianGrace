<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Services') }}
            </h2>
            {{-- <a class="btn btn-success" href="{{ route('room.create') }}">Create</a> --}}
            <x-create-button href="{{ route('services.create') }}" class="bg-green-500 hover:bg-green-700">
                Create
            </x-create-button>


        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>
<script>
    $(document).ready(function() {
        // Fetch CSRF token from meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('body').on('click', '.change-status', function() {
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            // Include CSRF token in AJAX request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('services.change-status') }}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
