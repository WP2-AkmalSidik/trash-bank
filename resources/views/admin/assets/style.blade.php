<style>
    /* Base styles */
    .dark {
        color-scheme: dark;
    }

    /* Custom ScrollBar */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .dark ::-webkit-scrollbar-track {
        background: #2d3748;
    }

    ::-webkit-scrollbar-thumb {
        background: #0D723B;
        /* Default color for scrollbar in light mode */
        border-radius: 3px;
    }

    .dark ::-webkit-scrollbar-thumb {
        background: #F7B731;
        /* Secondary color for dark mode */
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #0a5a2f;
        /* Default hover color in light mode */
    }

    /* Dark mode specific hover */
    .dark ::-webkit-scrollbar-thumb:hover {
        background: #F39C12;
        /* Hover color for dark mode, matching secondary tone */
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-in-out;
    }

    .dropdown-content {
        display: none;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
