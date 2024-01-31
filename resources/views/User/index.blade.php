<x-app-layout>

    @if (Auth::user()->role == 'Admin')

        <x-slot name="header">
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="icon icon-xs me-2 bi bi-plus-lg"></i>
                Add User
            </a>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- per page status --}}
                @if (session('status'))
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="input-group me-2 me-lg-3 fmxw-400">
                                <input type="text" name="search" value="{{ $searchVal }}" class="form-control"
                                    placeholder="Search name">
                                <span class="input-group-text">
                                    <button type="submit" class="btn btn-xs">
                                        <i class="icon fs-6 bi bi-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <table style="width: 100%; display: table; table-layout: fixed;" class="table-auto">
                            <thead>
                                <tr>
                                    <th class="border-gray-200">Name</th>
                                    <th class="border-gray-200">Email</th>
                                    <th class="border-gray-200">Date Added</th>
                                    <th class="border-gray-200">Date Updated</th>
                                    <th class="border-gray-200">Role</th>
                                    <th class="border-gray-200">Department</th>
                                    <th class="border-gray-200">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td valign="middle"><span class="fw-normal">{{ $user->name }}</span></td>
                                        <td valign="middle" style="text-align:center;"><span
                                                class="fw-normal">{{ $user->email }}</span></td>
                                        <td valign="middle" style="text-align:center;"><span
                                                class="fw-normal">{{ date('Y-m-d', strtotime($user->created_at)) }}</span>
                                        </td>
                                        <td valign="middle" style="text-align:center;"><span
                                                class="fw-normal">{{ date('Y-m-d', strtotime($user->updated_at)) }}</span>
                                        </td>
                                        <td valign="middle" style="text-align:center;"><span
                                                class="fw-normal">{{ $user->role }}</span></td>
                                        <td valign="middle" style="text-align:center;"><span
                                                class="fw-normal">{{ $user->dept }}</span></td>
                                        <td valign="middle" style="text-align:center;"><a
                                                href="{{ route('users.show', $user->id) }}"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md 
                                                font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest 
                                                hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white 
                                                active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                                focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Show</a>

                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete') }}</x-danger-button>

                                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                                <form method="post" action="{{ route('users.destroy', $user) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Are you sure you want to delete ' . $user->name . '?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <a href="{{ route('users.index') }}" 
                                                        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 
                                                        border border-gray-300 dark:border-gray-500 rounded-md 
                                                        font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase 
                                                        tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 
                                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 
                                                        disabled:opacity-25 transition ease-in-out duration-150">Back</a>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete Account') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">No data.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                    </div>

                    <div
                        class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">

                        {{-- pagination --}}
                        {{-- {{ $users->links('vendor.pagination.bootstrap-5') }} --}}

                    </div>

                </div>

            </div>
        </div>

    @endif

</x-app-layout>
