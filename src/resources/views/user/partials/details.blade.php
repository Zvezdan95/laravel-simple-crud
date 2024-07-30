<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('user.upsert') }}" class="mt-6 space-y-6"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{$user?->id}}">
        <div>
            @if($user?-> profile_picture)
                <img src="{{$user?->getProfilePicture()}}" alt="profile picture">
            @else
                <span
                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">no pic</span>
            @endif
        </div>

        <div class="block font-medium text-sm text-gray-700 dark:text-gray-300">
            <x-input-label for="profile_picture" :value="__('Profile Picture')"/>
            <input type="file" id="profile_picture" name="profile_picture"
                   class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')"/>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user?->name)"
                          required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')"/>
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                          :value="old('username', $user?->username)" required autofocus
                          autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('username')"/>
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autofocus
                          autocomplete="password"/>
            <x-input-error class="mt-2" :messages="$errors->get('password')"/>
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')"/>
            <x-text-input id="phone_number" name="phone_number" type="text"
                          class="mt-1 block w-full"
                          :value="old('phone_number', $user?->phone_number)" required autofocus
                          autocomplete="phone_number"/>
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user?->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

        </div>
        <div>
            <x-input-label for="status" :value="__('Status')"/>
            <select id="status" name="status"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                @foreach($userStatuses as $status)
                    <option value="{{$status->value}}">{{$status->toLabel()}}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
