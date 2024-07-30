<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Legal Entity') }}
        </h2>


    </header>
    {{-- Legal Entity Information --}}
    <div>
        <x-input-label for="company_name" :value="__('Company Name')"/>
        <x-text-input form="address-form" id="company_name" name="legal_entity[company_name]" type="text" class="mt-1 block w-full"
                      :value="old('company_name', $address?->legalEntity->company_name ?? '')" required autofocus/>
        <x-input-error :messages="$errors->get('company_name')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="tax_number" :value="__('Tax Number')"/>
        <x-text-input form="address-form" id="tax_number" name="legal_entity[tax_number]" type="text" class="mt-1 block w-full"
                      :value="old('tax_number', $address?->legalEntity->tax_number ?? '')"/>
        <x-input-error :messages="$errors->get('tax_number')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="registration_number" :value="__('Registration Number')"/>
        <x-text-input form="address-form" id="registration_number" name="legal_entity[registration_number]" type="text" class="mt-1 block w-full"
                      :value="old('registration_number', $address?->legalEntity->registration_number ?? '')"/>
        <x-input-error :messages="$errors->get('registration_number')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="bank_account_number" :value="__('Bank Account Number')"/>
        <x-text-input form="address-form" id="bank_account_number" name="legal_entity[bank_account_number]" type="text" class="mt-1 block w-full"
                      :value="old('bank_account_number', $address?->legalEntity->bank_account_number ?? '')"/>
        <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2"/>
    </div>

</section>
