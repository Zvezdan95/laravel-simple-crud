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
                    <form class="action-cell" action="/admin/change-user-status" method="POST" id="change-user-status-form">
                        @csrf
                        <select class="text-gray-900" name="status">
                            @foreach($userStatuses as $status)
                                <option value="{{$status->value}}">{{$status->toLabel()}}</option>
                            @endforeach
                        </select>
                        <button class="btn ml-4" type="submit">Change Status</button>
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
                                    <td class="text-center">{{$user->$key ?: "--"}}</td>
                                @endforeach
                                <td>
                                    <input form="change-user-status-form" name="selected[{{$user->id}}]"
                                           type="checkbox">
                                </td>
                                <td class="action-cell">
                                    <form action="/admin/delete-user" method="POST">
                                        @csrf
                                        <input type="hidden" name="delete_user" value="{{$user->id}}">
                                        <button class="btn" type="submit">Delete</button>
                                    </form>
                                    <a class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                       href="#">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
