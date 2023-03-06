<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Ceation d\'une reunion') }}
            </h2>

        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden border-b border-gray-200">
            <x-form action="{{route('meetings.store')}}">
                {{-- Amount --}}
                <div>
                    <x-form.label for="name" value="{{ __('Nom') }}" />
                    <x-form.input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
                    <x-form.error for="name" />
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
