@props(['route', 'slot'])

<form action="{{ $route }}" method="POST" style="display: inline;">
    @csrf
    @method('PATCH')
    <button type="submit" class="mark-as-read-button">
        {{ $slot }}
    </button>
</form>

<style>
    .mark-as-read-button {
        background-color: #28a745; /* Green */
        color: #fff;
        padding: 0.375rem 0.75rem;
        border: 1px solid #28a745;
        border-radius: 0.25rem;
        cursor: pointer;
        margin-left: 5px;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .mark-as-read-button:hover {
        background-color: #218838; /* Darker green */
        border-color: #1e7e34;
    }
</style>
