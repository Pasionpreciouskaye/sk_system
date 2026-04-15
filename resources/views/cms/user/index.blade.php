@extends('layouts.dashboard')
@section('content')
    <style>
        .dark .user-table-wrapper {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
        }

        .dark .user-table-wrapper h1 {
            color: #F9FAFB !important;
        }

        .dark .user-table-wrapper tbody tr {
            border-color: #1F2A44 !important;
            color: #F9FAFB !important;
        }

        .dark .user-table-wrapper tbody tr:hover {
            background-color: #24344D !important;
        }

        .dark .user-table-wrapper .btn-edit {
            background-color: #162338 !important;
            color: #60A5FA !important;
            border: 1px solid #2A3B55;
        }

        .dark .user-table-wrapper .btn-edit:hover {
            background-color: #24344D !important;
            color: #93C5FD !important;
        }

        .dark .user-modal {
            background-color: #1B2A41 !important;
            border: 1px solid #2A3B55;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.7);
        }

        .dark .user-modal h2 {
            color: #F9FAFB !important;
        }

        .dark .user-modal p {
            color: #D1D5DB !important;
        }

        .dark .user-modal .modal-divider {
            border-color: #2A3B55 !important;
        }

        .dark .user-modal label {
            color: #D1D5DB !important;
        }

        .dark .user-modal input,
        .dark .user-modal select {
            background-color: #162338 !important;
            border-color: #2A3B55 !important;
            color: #F9FAFB !important;
        }

        .dark .user-modal input:focus,
        .dark .user-modal select:focus {
            border-color: #E91E63 !important;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.25) !important;
        }
    </style>

    <div x-data="{
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
        editData: {},
        deleteId: null
    }"
        class="user-table-wrapper w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200 overflow-auto max-h-[85vh] min-h-[85vh]">

        {{-- Stats cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="rounded-xl p-5 flex items-center gap-4 shadow-sm border" style="background:var(--color-card);border-color:var(--color-border);">
                <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(233,30,99,0.12);">
                    <i class="fas fa-users text-xl" style="color:var(--color-accent)"></i>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide font-semibold" style="color:var(--color-text-muted)">Total Members</p>
                    <p class="text-2xl font-bold" style="color:var(--color-text-primary)">{{ $data->count() }}</p>
                </div>
            </div>
            <div class="rounded-xl p-5 flex items-center gap-4 shadow-sm border" style="background:var(--color-card);border-color:var(--color-border);">
                <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(34,197,94,0.12);">
                    <i class="fas fa-user-check text-xl" style="color:#22C55E"></i>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide font-semibold" style="color:var(--color-text-muted)">Admin Roles</p>
                    <p class="text-2xl font-bold" style="color:var(--color-text-primary)">{{ $data->whereIn('role', ['super_admin','treasurer','secretary','councilor'])->count() }}</p>
                </div>
            </div>
            <div class="rounded-xl p-5 flex items-center gap-4 shadow-sm border" style="background:var(--color-card);border-color:var(--color-border);">
                <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(59,130,246,0.12);">
                    <i class="fas fa-user text-xl" style="color:#3B82F6"></i>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide font-semibold" style="color:var(--color-text-muted)">Regular Members</p>
                    <p class="text-2xl font-bold" style="color:var(--color-text-primary)">{{ $data->where('role', 'member')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>
            <button @click="showCreateModal = true"
                class="px-5 py-2 text-white bg-[#E91E63] rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
            </button>
        </div>

        @include('components.alert')

        <table class="min-w-full border border-gray-200 shadow-lg rounded-lg" id="{{ $resource }}-table">
            <thead class="bg-pink-600 text-white uppercase text-md">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach ($data as $user)
                    <tr class="border hover:bg-pink-50 transition">
                        <td class="py-2 px-4">{{ $user->id }}</td>
                        <td class="py-2 px-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">
                            <div class="flex space-x-2">
                                <button @click="showEditModal = true; editData = {{ json_encode($user) }}"
                                    class="btn-edit p-2 bg-blue-100 text-blue-500 hover:bg-blue-200 rounded transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button @click="showDeleteModal = true; deleteId = {{ $user->id }}"
                                    class="btn-delete p-2 bg-red-100 text-red-500 hover:bg-red-200 rounded transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- CREATE MODAL -->
        <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-60" @click="showCreateModal = false"></div>
            <div class="user-modal bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-3xl relative">
                <div class="flex justify-between items-center modal-divider border-b pb-3 mb-4">
                    <h2 class="text-xl font-bold text-pink-600">Add New User</h2>
                    <button @click="showCreateModal = false"
                        class="text-2xl text-gray-400 hover:text-pink-500 transition-colors">&times;</button>
                </div>
                <form action="{{ route($resource . '.store') }}" method="POST">
                    @csrf
                    @php $record = null; @endphp
                    @include('cms.user._form', ['record' => $record])
                    <div class="flex justify-end mt-6 gap-2">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                            Save User
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DataTable Script -->
        <script>
            $(document).ready(function() {
                $('#{{ $resource }}-table').DataTable({
                    pageLength: 10,
                    order: [
                        [0, 'desc']
                    ],
                    dom: '<"flex justify-between items-center mb-2"lf>rt<"flex justify-between items-center mt-4"ip>',
                    initComplete: function() {
                        const $fi = $('div.dataTables_filter input');
                        $fi.addClass('sk-search-input').attr('id', 'dt-search-user').attr('placeholder', 'Search...');
                        $('div.dataTables_filter').append(
                            '<button id="mic-btn" title="Search by voice" class="dt-mic-btn"><i id="mic-icon" class="fas fa-microphone"></i></button>'
                        );
                        $('div.dataTables_length select').addClass(
                            'px-3 py-1 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500'
                        );
                    },
                    drawCallback: function() {
                        $('div.dataTables_paginate .paginate_button').addClass(
                            'px-4 py-2 text-black rounded-lg hover:bg-pink-100');
                        $('div.dataTables_paginate .paginate_button.current').removeClass('bg-gray-700')
                            .addClass('bg-pink-600 text-white px-4 py-2 rounded-lg');
                    }
                });
            });
        </script>

        <!-- EDIT MODAL -->
        <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-60" @click="showEditModal = false"></div>
            <div class="user-modal bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-3xl relative">
                <div class="flex justify-between items-center modal-divider border-b pb-3 mb-4">
                    <h2 class="text-xl font-bold text-pink-600">Edit User</h2>
                    <button @click="showEditModal = false"
                        class="text-2xl text-gray-400 hover:text-pink-500 transition-colors">&times;</button>
                </div>
                <form :action="`/{{ $resource }}/${editData.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template
                            x-for="field in ['first_name', 'middle_name', 'last_name', 'email', 'contact_number', 'date_of_birth', 'gender', 'address']"
                            :key="field">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 capitalize"
                                    x-text="field.replace('_', ' ')"></label>
                                <input :type="field == 'date_of_birth' ? 'date' : 'text'" :name="field"
                                    :value="editData[field]"
                                    class="w-full border border-gray-300 dark:border-[#2A3B55] px-4 py-2 rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
                            </div>
                        </template>
                        {{-- Role field --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <select name="role"
                                class="w-full border border-gray-300 dark:border-[#2A3B55] px-4 py-2 rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200">
                                @foreach(\App\Models\User::ROLE_PERMISSIONS as $role => $perms)
                                    <option value="{{ $role }}" :selected="editData.role === '{{ $role }}'">
                                        {{ ucwords(str_replace('_', ' ', $role)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 gap-2">
                        <button type="button" @click="showEditModal = false"
                            class="px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE MODAL -->
        <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-60" @click="showDeleteModal = false"></div>
            <div class="user-modal bg-white rounded-xl shadow-lg z-50 p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Confirm Deletion</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this user?</p>
                <div class="flex justify-end gap-2">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-[#2A3B55] rounded-lg bg-transparent dark:bg-[#1B2A41] hover:bg-pink-50 dark:hover:bg-[#24344D] hover:text-pink-600 dark:hover:text-pink-400 transition-all duration-200">
                        Cancel
                    </button>
                    <form :action="`/{{ $resource }}/${deleteId}`" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-[#E91E63] text-white rounded-lg hover:bg-[#F472B6] active:bg-[#BE185D] hover:shadow-[0_0_12px_rgba(233,30,99,0.4)] transition-all duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.speech-search', ['inputId' => 'dt-search-user'])
@endsection
