<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Events') }}
            </h2>

            <div>
                <a href="{{ route('events.create') }}" class="dark:text-white hover:text-slate-200">New Event</a>
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
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Country
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($events as $event)

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $event->start_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->country->name }}
                                </td>
                                <td class="px-6 py-4">
                                    Edit/Delete
                                </td>
                            </tr>

                        @empty

                            <h1>No Events</h1>

                        @endforelse

                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-app-layout>
