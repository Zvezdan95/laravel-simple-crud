<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post"
                              action="{{ isset($address) ? route('address.upsert', $address->id) : route('address.upsert') }}"
                              class="mt-6 space-y-6">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$userId}}">
                            {{-- Input for Country --}}
                            <div>
                                <x-input-label for="country_id" :value="__('Country')"/>
                                <select id="country_id" name="country_id"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value=""> --None-- </option>
                                    @foreach ($countries as $country)
                                        <option
                                                value="{{ $country->id }}" {{ old('country_id', $address->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country_id')" class="mt-2"/>
                            </div>

                            {{-- Input for Postal Code --}}
                            <div>
                                <x-input-label for="postal_code" :value="__('Postal Code')"/>
                                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full"
                                              :value="old('postal_code', $address->postal_code ?? '')"/>
                                <x-input-error :messages="$errors->get('postal_code')" class="mt-2"/>
                            </div>

                            {{-- Input for City --}}
                            <div>
                                <x-input-label for="city" :value="__('City')"/>
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"
                                              :value="old('city', $address->city ?? '')"/>
                                <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                            </div>

                            {{-- Input for Address --}}
                            <div>
                                <x-input-label for="address" :value="__('Address')"/>
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                              :value="old('address', $address->address ?? '')"/>
                                <x-input-error :messages="$errors->get('address')" class="mt-2"/>
                            </div>

                            {{-- Input for Contact Name --}}
                            <div>
                                <x-input-label for="contact_name" :value="__('Contact Name')"/>
                                <x-text-input id="contact_name" name="contact_name" type="text"
                                              class="mt-1 block w-full"
                                              :value="old('contact_name', $address->contact_name ?? '')"/>
                                <x-input-error :messages="$errors->get('contact_name')" class="mt-2"/>
                            </div>

                            {{-- Input for Contact Phone --}}
                            <div>
                                <x-input-label for="contact_phone" :value="__('Contact Phone')"/>
                                <x-text-input id="contact_phone" name="contact_phone" type="tel"
                                              class="mt-1 block w-full"
                                              :value="old('contact_phone', $address->contact_phone ?? '')"/>
                                <x-input-error :messages="$errors->get('contact_phone')" class="mt-2"/>
                            </div>

                            {{-- Input for Address Type --}}
                            <div>
                                <x-input-label for="address_type" :value="__('Address Type')"/>
                                <select id="address_type" name="address_type"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option
                                            value="individual" {{ old('address_type', $address->address_type ?? '') === 'individual' ? 'selected' : '' }}>
                                        Individual
                                    </option>
                                    <option
                                            value="legal" {{ old('address_type', $address->address_type ?? '') === 'legal' ? 'selected' : '' }}>
                                        Legal
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('address_type')" class="mt-2"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ isset($address) ? __('Save Changes') : __('Create Address') }}</x-primary-button>

                                @if (session('status') === 'address-updated' || session('status') === 'address-created')
                                    <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ session('status') === 'address-updated' ? __('Address updated.') : __('Address created.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
