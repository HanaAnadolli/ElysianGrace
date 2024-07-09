@props(['selected' => null])

<div class="dropdown-container">
    <select {{ $attributes->merge(['class' => 'form-select']) }}>
        <option value="1" {{ $selected == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $selected == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<style>
    /* Container for the dropdown to position the arrow */
    .dropdown-container {
        position: relative;
        background-color: #1F2937;
        /* Dark background color for dark mode */
        border: 1px solid #43454B;
        /* Subtle border */
        border-radius: 4px;
        /* Rounded corners */
        color: #FFF;
        /* Text color */
    }

    .form-select {
    width: 100%; /* Full width */
    padding: 0.5rem 1rem; /* Padding */
    background-color: rgba(17, 24, 39, 0.5); /* Background color with opacity */
    color: #FFF; /* Text color */
    border-radius: 4px; /* Rounded corners */
    border: none; /* Remove border */
    -webkit-appearance: none; /* Remove default style for WebKit browsers */
    -moz-appearance: none; /* Remove default style for Mozilla Firefox */
    appearance: none; /* Remove default styling */
}


    /* Custom arrow using a pseudo-element */
    .dropdown-container::after {
        content: '\25BC';
        /* Down arrow icon */
        position: absolute;
        right: 1rem;
        /* Distance from the right */
        top: 50%;
        /* Center vertically */
        transform: translateY(-50%);
        /* Center arrow */
        pointer-events: none;
        /* Click through */
        color: #FFF;
        /* Arrow color */
    }

    /* Remove default focus outline and add custom style for focus */
    .form-select:focus {
        outline: none;
        box-shadow: 0 0 0 2px #5C6BC0;
        /* Custom focus style */
    }

    /* Dark mode friendly hover effect for the select field */
    .form-select:hover {
        background-color: #3A3C41;
        /* Slightly lighter than the default state */
    }
</style>
