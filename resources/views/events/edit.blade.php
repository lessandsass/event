<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Event') }}
            </h2>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('events.update', $event) }}"
                x-data="{
                    country: null,
                    cityId: @js($event->city_id),
                    cities: @js($event->country->cities),
                    onCountryChange(event) {
                        axios.get(`/countries/${event.target.value}`).then(res => {
                            this.cities = res.data
                        })
                    }
                }"
                enctype="multipart/form-data"
                class="p-4 bg-white dark:bg-slate-800 rounded-md"
            >

                @csrf
                @method('PUT')

                <div class="grid gap-6 mb-6 md:grid-cols-2">

                    <div>

                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                        <input type="text" id="title" name="title" class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0 w-full" value="{{ old('title', $event->title) }}">

                        @error('title')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                    </div>

                    <div>

                        <label for="country_id" class="block mb-2 text-sm font-medium text-gray-300">Select an option</label>
                        <select
                            name="country_id"
                            id="country_id"
                            x-on:change="onCountryChange"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0"
                        >
                            <option>Choose a country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @selected($country->id === $event->country_id)>{{ $country->name }}</option>
                            @endforeach
                        </select>

                        @error('country_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror

                    </div>

                    <div>
                        <label
                            for="city_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Select an option
                        </label>

                        <select
                            name="city_id"
                            id="city_id"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg w-full border-transparent focus:border-transparent focus:ring-0"
                        >
                            <template x-for="city in cities" :key="city.id">
                                <option x-bind:value="city.id" x-text="city.name" :selected="city.id === cityId"></option>
                            </template>
                        </select>

                        @error('city_id')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>
                        <label
                            for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Address
                        </label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0"
                            value="{{ old('address', $event->address) }}"
                        >

                        @error('address')
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
                            class="block w-full text-sm text-gray-900 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 border-transparent focus:border-transparent focus:ring-0"
                        >

                        @error('image')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="start_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Start Date
                        </label>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0"
                            value="{{ old('start_date', $event->start_date) }}"
                        >

                        @error('start_date')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="end_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            End Date
                        </label>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0"
                            value="{{ old('end_date', $event->end_date) }}"
                        >

                        @error('end_date')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="start_time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Start Time
                        </label>

                        <input
                            type="time"
                            id="start_time"
                            name="start_time"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg border-transparent focus:border-transparent focus:ring-0"
                            value="{{ old('start_time', $event->start_time) }}"
                        >

                        @error('start_time')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="num_tickets"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Num: Tickets
                        </label>

                        <input
                            type="number"
                            id="num_tickets"
                            name="num_tickets"
                            class="bg-gray-700 text-gray-300 text-sm rounded-lg focus:ring-blue-500 border-transparent focus:border-transparent focus:ring-0"
                            value="{{ old('num_tickets', $event->num_tickets) }}"
                        >

                        @error('num_tickets')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Description
                        </label>

                        <textarea
                            rows="4"
                            id="description"
                            name="description"
                            class="block p-2.5 w-full text-sm bg-gray-700 rounded-lg dark:text-gray-300 border-transparent focus:border-transparent focus:ring-0 resize-none"
                        >{{ $event->description }}</textarea>

                        @error('description')
                            <div class="text-sm text-red-400">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>
                        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Tags</h3>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach ($tags as $tag)
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="vue-checkbox-list" type="checkbox" name="tags[]"
                                            value="{{ $tag->id }}"
                                            @checked($event->hasTag($tag))
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label
                                            class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tag->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

                <div>
                    <button type="submit" class="block text-white bg-green-500 hover:bg-green-600 font-medium rounded px-4 py-2">Update</button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
