<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form>
                        <x-input-label for="code_id" :value="__('Old codes')"/>
                        <select id="code_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option>--> {{ __('Select') }} <--</option>
                            @foreach($codes as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </form>

                    <hr  class="mt-4 mb-4 border-gray-300 dark:bg-gray-900">

                    <form action="{{ route('code.store') }}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $code?->id }}">
                        <!-- title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                          :value="old('title', $code?->title)" autocomplete="title"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>

                        <!-- code -->
                        <div class="mt-4">
                            <x-input-label for="code" :value="__('Code')"/>
                            <textarea id="code" name="code" autofocus
                                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm h-96">{{ $code?->code }}</textarea>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div class="block mt-4">
                            <x-secondary-button class="ms-3" id="reset">
                                {{ __('Reset') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-3">
                                {{ __('Send') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            let resetButton = document.querySelector('#reset')
            resetButton.addEventListener('click', reset);

            function reset(e) {
                e.preventDefault();
                document.querySelector('#id').value = '';
                document.querySelector('#title').value = '';
                document.querySelector('#code').value = '';
                // console.log('reset')
            }

            let selectCodeId = document.querySelector('#code_id')
            selectCodeId.addEventListener('change', loadCode);

            function loadCode(e) {
                let codeId = e.target.value;
                // console.log('codeId ', codeId);
                window.location.replace(`/codeCreator/${codeId}`)
            }
        </script>
    @endsection
</x-app-layout>
