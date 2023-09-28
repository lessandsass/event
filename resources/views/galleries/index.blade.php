<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Galleries') }}
            </h2>

            <div>
                <a href="{{ route('galleries.create') }}" class="dark:text-gray-400 hover:text-slate-200">New Gallery</a>
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Caption
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($galleries as $gallery)

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="gallery image" class="w-20 h-20">
                                </th>
                                <td class="px-6 py-4">
                                    {{ $gallery->caption }}
                                </td>
                                <td class="px-6 py-4">

                                    <div class="flex space-x-2">
                                        <a
                                            href="{{ route('galleries.edit', $gallery) }}"
                                            class="text-green-400 hover:text-green-600"
                                        >
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('galleries.destroy', $gallery) }}">
                                            @csrf
                                            @method('DELETE')

                                            <a
                                                href="{{ route('galleries.destroy', $gallery) }}"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                class="text-red-500 hover:text-red-700"
                                            >
                                                Delete
                                            </a>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-gray-300">
                                    No Gallery found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
