<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consult') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex pl-6 pt-6 text-gray-900 dark:text-gray-100">
                    Copy Code &nbsp;&nbsp;
                    <button id="code-block-copy-button-29" class="md:block hidden code-block-copy-button"
                            aria-label="Copy to Clipboard" title="Copy to Clipboard"
                            data-clipboard-target="#code-block-text-29" onclick="copyCode()">
                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path>
                            <path
                                d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <textarea id="code" name="code"
                              class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm h-96"></textarea>

                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            function copyCode() {
                // Get the text field
                let textCode = document.querySelector("#code").value;

                // Copy the text inside the text field
                if (window.isSecureContext && navigator.clipboard) {
                    navigator.clipboard.writeText(textCode);
                }

                // toast notification
                toastr.info('The code has been copied!', {timeOut: 3000})

            }
        </script>
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                window.Echo.channel('channel-student')
                    .listen('SendCodeEvent', (event) => {
                        // console.log(event.message)
                        let textCode = document.querySelector("#code");
                        textCode.value = '';
                        textCode.value = event.message
                        toastr.info('A new code was refresh!', {timeOut: 3000})
                    });
            });
        </script>
    @endsection
</x-app-layout>
