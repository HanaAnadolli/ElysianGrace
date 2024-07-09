@props(['route'])

<a href="{{ $route }}" class="edit-button">
    <i class="fas fa-edit"></i>
    {{-- {{ $slot }} --}}
</a>
<style>
    .edit-button {
        background-color: #007bff; /* Blue */
        color: #fff;
        padding: 0.375rem 0.75rem;
        border: 1px solid #007bff;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .edit-button:hover {
        background-color: #0056b3; /* Darker blue */
        border-color: #004085;
    }
</style>
