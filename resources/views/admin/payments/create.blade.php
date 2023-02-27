<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ $user->name() }}
            </h2>

            <a href="{{route('users.create')}}"
                class="bg-green-800 rounded-lg py-2 px-4 text-white"
            >{{ __('Nouveau Pret')}}</a>
        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden border-b border-gray-200">
            <x-form action="{{route('payments.store', $user)}}">
                {{-- Amount --}}
                <div>
                    <x-form.label for="amount" value="{{ __('Montant') }}" />
                    <x-form.input id="amount" class="block w-full mt-1" type="number" name="amount" step="1000" :value="old('amount')" required autofocus />
                    <x-form.error for="amount" />
                </div>

                {{-- Date --}}
                <div class="mt-3">
                    <x-form.label for="creation" value="{{ __('Date') }}" />
                    <?php
                        $today = old('creation') ? old('creation') : date('Y-m-d'); 

                    ?>
                    <x-form.input id="creation" class="block w-full mt-1" type="date" name="creation" value="{{$today}}" required />
                    <x-form.error for="creation" />
                </div>

                {{-- Button --}}
                <x-buttons.primary class="mt-3">
                    {{ __('Enregistrer') }}
                </x-buttons.primary>
            </x-form>
        </div>
    </section>

    
</x-app-layout>
