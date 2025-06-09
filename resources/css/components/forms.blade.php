.custom_form {
    form {
        .inputs {
            @apply mb-4;

            label {
                @apply block mb-1 font-medium text-gray-800;
            }

            label.required {
                @apply after:content-['*'] after:ml-0.5 after:text-red-500 after:font-bold;
            }

            input,
            textarea {
                @apply w-full border border-gray-500 rounded-sm py-2 px-3;
            }
        }
    }
}
