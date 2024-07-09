@props(['value'])

<button type="submit" class="custom-submit-button">
    {{ $value }}
</button>

<style>
    .custom-submit-button {
    background-color: #2B7A78; /* Green */
    color: white;
    padding: 5px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: inline-flex;
    align-items: center;
    font-size: .875rem; /* 14px */
    font-weight: 600;
    text-transform: uppercase;
}

.custom-submit-button:hover {
    background-color: #3c6b65; /* Darker green */
}

</style>
