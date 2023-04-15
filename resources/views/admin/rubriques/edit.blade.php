<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Editer une rubrique') }}
            </h2>

        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden border-b border-gray-200">
            <x-form action="{{route('rubriques.editStore', $rubrique->id)}}">
                {{-- Amount --}}
                <div>
                    <x-form.label for="name" value="{{ __('Nom') }}" />
                    <x-form.input id="name" class="block w-full mt-1" type="text" name="name" value="{{ $rubrique->name }}" required autofocus />
                    <x-form.error for="name" />
                </div>

                {{-- Date de debut--}}
                <div class="mt-3">
                    <x-form.label for="debut" value="{{ __('Date de debut') }}" />
                    
                    <x-form.input id="debut" class="block w-full mt-1" type="date" name="debut" value="{{$rubrique->debut}}" required />
                    <x-form.error for="debut" />
                </div>

                {{-- Date de fin--}}
                <div class="mt-3">
                    <x-form.label for="fin" value="{{ __('Date de fin') }}" />
                    <x-form.input id="fin" class="block w-full mt-1" type="date" name="fin" value="{{$rubrique->fin}}" required />
                    <x-form.error for="fin" />
                </div>

                {{-- Button --}}
                <x-buttons.primary class="mt-3">
                    {{ __('Enregistrer') }}
                </x-buttons.primary>
            </x-form>
        </div>
    </section>

    
</x-app-layout>
