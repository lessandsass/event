<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('New Gallery') }}
            </h2>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('galleries.store') }}"
                enctype="multipart/form-data"
                class="px-5 p-2 bg-white dark:bg-slate-800 rounded-md space-y-7"
            >

                @csrf

                <div>

                    <label
                        for="caption"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >
                        Caption
                    </label>
                    <input type="text" id="caption" name="caption" class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0 w-full py-3" placeholder="Laravel Gallery">

                    @error('caption')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror

                </div>

                <div>

                    <label
                        for="file_input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >
                        Upload file
                    </label>

                    <input
                        id="file_input"
                        type="file"
                        name="image"
                        class="block text-sm text-gray-900 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 border-transparent focus:border-transparent focus:ring-0"
                    >

                    @error('image')
                        <div class="text-sm text-red-400">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div>
                    <button type="submit" class="mt-5 block text-white bg-blue-700 hover:bg-blue-800 font-medium rounded px-4 py-2">Create</button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
