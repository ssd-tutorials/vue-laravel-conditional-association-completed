@extends('app')

@section('body')

    <div class="w-full max-w-sm mx-auto">

        <form-wrapper
            :record="{ needs_categories: {{ (int)$product->has_categories }} }"
            v-slot="{ fields }"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        >

            <div class="mb-4">

                <h2 class="text-blue-600 text-lg font-bold mb-2 border-b-2 pb-2">{{ $product->name }}</h2>

                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="has_categories"
                >
                    Has categories?:
                </label>
                <div class="relative">
                    <select
                        id="has_categories"
                        class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-600"
                        v-model="fields.needs_categories"
                    >
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <group-selection
                    v-if="fields.needs_categories == 1"
                    fetch-action="{{ route('product.category.fetch', $product->id) }}"
                    toggle-action="{{ route('product.category.toggle', $product->id) }}"
                >
                    <label
                        class="block text-gray-700 text-sm font-bold mt-4 mb-2"
                        for="category"
                    >
                        Categories:<br />
                        <small class="font-normal">Select at least one category</small>
                    </label>
                </group-selection>

            </div>

        </form-wrapper>

    </div>

@endsection
