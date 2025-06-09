<div class="Users">
    <div class="container">
        <div class="header">
            <div class="info">
                <h2>Users</h2>
                <div class="stats">
                    <span>{{ $count_all_users }} total</span>
                    <span>{{ $count_super_admins }} {{ Str::plural('super admin', $count_super_admins) }}</span>
                    <span>{{ $count_admins }} {{ Str::plural('admin', $count_admins) }}</span>
                    <span>{{ $count_users }} {{ Str::plural('user', $count_users) }}</span>
                </div>
            </div>

            <div class="search">
                <input type="text" placeholder="Search...">
                <button>Search</button>
            </div>

            <div class="button">
                <a href="{{ Route::has('users.create') ? route('users.create') : '#' }}" wire:navigate class="btn">Create User</a>
            </div>
        </div>

        <div class="users">
            @forelse ($users as $user)
                <div class="user" wire:key="user-{{ $user->id }}">
                    <div class="image {{ $user->isAdmin() ? 'border border-green-500' : '' }}">
                        <x-user-avatar :user="$user" class="rounded-lg" />
                    </div>

                    <div class="content">
                        <div class="info">
                            <h3 class="names">
                                {{ $user->first_name }} {{ $user->last_name }}
                                @if($user->isAdmin())
                                    <x-svgs.shield-with-checkmark class="inline-block w-4 h-4 ml-1 text-blue-600" />
                                @endif
                            </h3>
                            <p class="{{ $user->email_verified_at === null ? 'text-red-600 text-sm' : 'email' }}">{{ $user->email }}</p>
                            <p class="phone_number">{{ $user->phone_number ?? '-' }}</p>
                        </div>
                        @if(!$user->isSuperAdmin())
                            <div class="actions">
                                <div class="others">
                                    <span wire:click="toggleStatus({{ $user->id }})" wire:loading.attr="disabled" wire:target="toggleStatus" class="{{ $user->isActive() ? 'border border-green-500 bg-green-100 text-green-900 text-xs p-1' : 'border border-red-500 bg-red-100 text-red-900 text-xs p-1' }}">{{ $user->user_status->label() }}</span>
                                </div>
                                <div class="crud">
                                    <a href="{{ Route::has('users.edit') ? route('users.edit', ['uuid' => $user->id]) : '#' }}" wire:navigate>
                                        <x-svgs.edit class="w-4 h-4 mr-1 text-green-600" />
                                    </a>
                                    <button x-data="" x-on:click.prevent="$wire.set('delete_user_id', {{ $user->id }}); $dispatch('open-modal', 'confirm-user-deletion')" class="btn_transparent" >
                                        <x-svgs.trash class="w-4 h-4 text-red-600" />
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="actions">
                                <div class="others">
                                    <span class="text-sm">{{ $user->user_status->label() }}</span>
                                </div>
                                <div class="crud">
                                    <span class="text-sm">{{ $user->user_level->label() }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p>No users found.</p>
            @endforelse
        </div>

        <div class="pagination_links">
            {{ $users->links() }}
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$delete_user_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="deleteUser" @submit="$dispatch('close-modal', 'confirm-user-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">
                    Confirm Deletion
                </h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">
                    Are you sure you want to permanently delete this user?
                </p>

                <div class="buttons_group">
                    <button type="submit" class="btn_danger">
                        Delete User
                    </button>

                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-user-deletion')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
