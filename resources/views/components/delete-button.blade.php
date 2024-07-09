@props(['route'])

<form action="{{ $route }}" method="POST" onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-button">
        <i class="fas fa-trash"></i>
        {{-- {{ $slot }} --}}
    </button>
</form>
<style>
    .delete-button {
        background-color: #dc3545; /* Red */
        color: #fff;
        padding: 0.375rem 0.75rem;
        border: 1px solid #dc3545;
        border-radius: 0.25rem;
        cursor: pointer;
        margin-left: 5px;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .delete-button:hover {
        background-color: #c82333; /* Darker red */
        border-color: #bd2130;
    }
</style>
