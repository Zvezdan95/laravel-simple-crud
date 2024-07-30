<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Addresses') }}
        </h2>

    </header>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if($user->addresses->isEmpty())
                <span>Currently no addresses</span>
                <x-nav-link :href="route('address', ['userId' => $user->id])">
                    {{ __('Create Address') }}
                </x-nav-link>
            @else
                <x-nav-link :href="route('address', ['userId' => $user->id])">
                    {{ __('Create Address') }}
                </x-nav-link>
                <table class="w-full table-fixed">
                    <thead>
                    <tr>
                        <th>City</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->addresses as $address)
                        <tr>
                            <td>{{$address->city ?: "--"}}</td>
                            <td>{{$address->address ?: "--"}}</td>
                            <td class="action-cell">
                                <form action="{{ route('address.delete') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="delete_address" value="{{$address->id}}">
                                    <x-primary-button class="btn" type="submit">Delete</x-primary-button>
                                </form>
                                <x-nav-link :href="route('address', ['id'=> $address->id, 'userId' => $user->id])" >
                                    {{ __('Edit') }}
                                </x-nav-link>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

</section>
