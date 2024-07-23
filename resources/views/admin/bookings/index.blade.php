<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Bookings') }}
            </h2>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Re-bind event listeners after DataTables has been initialized
        $('#bookings-table').on('draw.dt', function() {
            document.querySelectorAll('.approve-booking').forEach(button => {
                button.addEventListener('click', function() {
                    const bookingId = this.getAttribute('data-id');

                    fetch(`/bookings/${bookingId}/approve`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ _method: 'POST' })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                // Optionally reload the DataTable to reflect changes
                                $('#bookings-table').DataTable().ajax.reload();
                            } else {
                                alert(data.message);
                            }
                        });
                });
            });

            document.querySelectorAll('.reject-booking').forEach(button => {
                button.addEventListener('click', function() {
                    const bookingId = this.getAttribute('data-id');

                    fetch(`/bookings/${bookingId}/reject`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ _method: 'POST' })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                // Optionally reload the DataTable to reflect changes
                                $('#bookings-table').DataTable().ajax.reload();
                            } else {
                                alert(data.message);
                            }
                        });
                });
            });
        });
    });
</script>
