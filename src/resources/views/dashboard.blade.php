<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div style="margin-top: 3rem;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="action-cell" action="/admin/change-user-status" method="POST"
                          id="change-user-status-form">
                        @csrf
                        <select class="text-gray-900" name="status">
                            @foreach($userStatuses as $status)
                                <option value="{{$status->value}}">{{$status->toLabel()}}</option>
                            @endforeach
                        </select>
                        <x-primary-button class="btn ml-4" type="submit">Change Status</x-primary-button>
                        <x-nav-link :href="route('user')">
                            {{ __('Create a new User') }}
                        </x-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full table-fixed">
                        <thead>
                        <tr>
                            @foreach($userHeaders as $key => $header)
                                <th>{{$header}}</th>
                            @endforeach
                            <th>Select</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                @foreach($userHeaders as $key => $header)
                                    <td class="text-center">
                                        @if($key === "profile_picture" && $user->profile_picture)
                                            <img src="{{$user->getProfilePicture()}}" alt="profile pic" height="64"
                                                 width="64">
                                        @else
                                            {{$user->$key ?: "--"}}
                                        @endif
                                    </td>
                                @endforeach
                                <td>
                                    <input form="change-user-status-form" name="selected[{{$user->id}}]"
                                           type="checkbox">
                                </td>
                                <td class="action-cell">
                                    <form action="{{ route('user.delete') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="delete_user" value="{{$user->id}}">
                                        <x-primary-button class="btn" type="submit">Delete</x-primary-button>
                                    </form>

                                    <x-nav-link :href="route('user', ['id'=>  $user->id])">
                                        {{ __('Edit') }}
                                    </x-nav-link>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
