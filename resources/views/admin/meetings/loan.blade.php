<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Preter') }} : {{ $meeting->name }} 
            </h2>

        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-scroll md:overflow-hidden border-b border-gray-200">
            <x-form action="{{route('meetings.loan.store', $meeting->id)}}">
                {{-- Preteur --}}
                <div>
                    <x-form.label for="user" value="{{ __('Preteur') }}" />
                    <x-form.input id="user" class="block w-full mt-1" type="text" name="user" :value="old('user')" required autofocus />
                    <x-form.input id="user_id" class="block w-full mt-1" type="hidden" name="user_id"  required  />
                    <x-form.error for="user" />
                </div>

                {{-- Rubrique --}}
                <div class="mt-3">
                    <x-form.label for="rubrique" value="{{ __('Rubrique') }}" />
                    <select id="rubrique" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="rubrique" :value="old('rubrique')" required>
                        @foreach($rubriques as $key => $rub)
                           <option value="{{ $rub->id }}">{{$rub->name}}</option> 
                        @endforeach
                        
                    </select>
                    <x-form.error for="fonction" />
                </div>
                
                {{-- Amount --}}
                <div class="mt-3">
                    <x-form.label for="amount" value="{{ __('Montant') }}" />
                    <x-form.input id="amount" class="block w-full mt-1" type="number" step="1000" name="amount" :value="old('amount')" required  />
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
    <script>
    
        

    const users = {{ \Illuminate\Support\Js::from($labelusers) }};

    </script>
    
</x-app-layout>
