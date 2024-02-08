<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (Auth::user()->role == 'viewer')
            {{ Auth::user()->dept }}
            @endif
            {{ __('Survey Responses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Viewer View --}}
            @if (Auth::user()->role == 'viewer')
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('Response.partial.viewer-search')
                </div>
            @endif
            {{-- /Viewer View --}}

            {{-- Admin View --}}
            @if (Auth::user()->role == 'Admin')
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('Response.partial.admin-search')
                </div>
            @endif
            {{-- /Admin View --}}

            @if($datestart)

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('Response.partial.charts-table')
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('Response.partial.sheets-table')
            </div>

            {{-- Viewer View --}}
            @if (Auth::user()->role == 'viewer')
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('Response.partial.viewer-search')
                </div>
            @endif
            {{-- /Viewer View --}}

            {{-- Admin View --}}
            @if (Auth::user()->role == 'Admin')
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @include('Response.partial.admin-search')
                </div>
            @endif
            {{-- /Admin View --}}

            @endif

        </div>
    </div>

</x-app-layout>
