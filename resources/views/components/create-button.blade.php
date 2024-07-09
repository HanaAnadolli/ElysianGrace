@props(['href'])

<a href="{{ $href }}" class="custom-button">
    {{ $slot }}
</a>
<style>
    .custom-button {
        background-color: #86C232; /* Green */
        color: #fff;
        padding: 5px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .custom-button:hover {
        background-color: #61892F !important; /* Darker green with !important to override any existing hover styles */
    }
</style>
