<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Creer Une association avec son moderateur') }}
            </h2>

           
        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden border-b border-gray-200">
            <x-form action="{{route('companies.store')}}">
                {{-- Name --}}
                <div>
                    <x-form.label for="nameass" value="{{ __('Nom  Association') }}" />
                    <x-form.input id="nameass" class="block w-full mt-1" type="text" name="nameass" :value="old('nameass')" required autofocus />
                    <x-form.error for="nameass" />
                </div>

                {{-- Name --}}
                <div>
                    <x-form.label for="nameasssuniq" value="{{ __('Nom  Unique Association') }}" />
                    <x-form.input id="nameasssuniq" class="block w-full mt-1" type="text" name="nameasssuniq" :value="old('nameasssuniq')" required autofocus />
                    <x-form.error for="nameasssuniq" />
                </div>

                {{-- Name --}}
                <div>
                    <x-form.label for="rc" value="{{ __('Registre de commerce') }}" />
                    <x-form.input id="rc" class="block w-full mt-1" type="text" name="rc" :value="old('rc')" required autofocus />
                    <x-form.error for="rc" />
                </div>

                {{-- Name --}}
                <div>
                    <x-form.label for="name" value="{{ __('Nom') }}" />
                    <x-form.input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
                    <x-form.error for="name" />
                </div>

                {{-- Username --}}
                <div class="mt-3">
                    <x-form.label for="username" value="{{ __('Nom Utilisateur') }}" />
                    <x-form.input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')" required />
                    <x-form.error for="username" />
                </div>

                {{-- Fonction --}}
                <div class="mt-3">
                    <x-form.label for="fonction" value="{{ __('Fonction') }}" />
                    <select id="fonction" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="fonction" :value="old('fonction')" required>
                        @foreach($fonctions as $key => $fonction)
                           <option value="{{ $key }}">{{$fonction}}</option> 
                        @endforeach
                        
                    </select>
                    <x-form.error for="fonction" />
                </div>

                {{-- email --}}
                <div class="mt-3">
                    <x-form.label for="email" value="{{ __('Email') }}" />
                    <x-form.input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
                    <x-form.error for="email" />
                </div>

                {{-- Bio --}}
                <div class="mt-3">
                    <x-form.label for="bio" value="{{ __('Biographie') }}" />
                    <textarea name="bio" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" ></textarea>
                    <x-form.error for="bio" />
                </div>

                {{-- Button --}}
                <x-buttons.primary class="mt-3">
                    {{ __('Enregistrer') }}
                </x-buttons.primary>
            </x-form>
        </div>
    </section>

</x-app-layout>
