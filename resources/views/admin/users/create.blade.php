<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        {{-- Search Topic --}}
        <div class="flex items-center flex-grow mb-5">

            <div class="p-2 text-white bg-blue-200 border rounded-l">
                <x-heroicon-o-search class="w-6 h-6" />
            </div>
            <input type="search" name="" id="search-user" class="w-full border-none rounded-r shadow-inner bg-blue-50 focus:ring-blue-200" placeholder="Search by username">
        </div>
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Creer Utilisateur') }}
            </h2>

            <a href="{{route('users.create')}}"
                class="bg-green-800 rounded-lg py-2 px-4 text-white"
            >{{ __('Nouveau Membre')}}</a>
        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden border-b border-gray-200">
            <x-form action="{{route('users.store')}}">
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

    <script>
        const projects = {{ \Illuminate\Support\Js::from($labelusers) }};
    </script>
</x-app-layout>
