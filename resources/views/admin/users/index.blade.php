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
                {{ __('Utilisateurs') }}
            </h2>

            <a href="{{route('users.create')}}"
                class="bg-green-800 rounded-lg py-2 px-4 text-white"
            >{{ __('Nouveau Membre')}}</a>
        </div>

        
    </x-slot>

    <section class="px-6">
        <div class="overflow-scroll border-b border-gray-200">
            <table class="min-w-full">
                <thead class="bg-blue-500">
                    <tr>
                        <x-table.head>Name</x-table.head>
                        <x-table.head>Username</x-table.head>
                        <x-table.head>Bio</x-table.head>
                        <x-table.head class="text-center">Fonction</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    @foreach($users as $key => $user)
                       <tr>
                            <x-table.data>
                                <div>{{ $user->name()}}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $user->username()}}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $user->bio()}}</div>
                            </x-table.data>
                            <x-table.data>
                                <div class="px-2 py-1 text-center text-gray-700 bg-green-200 rounded">
                                    {{ $fonctions[$user->fonction()]}}
                                </div>
                            </x-table.data>
                        </tr> 
                    @endforeach
                    
                </tbody>

            </table>
        </div>
    </section>

    <script>
    
        

    const projects = {{ \Illuminate\Support\Js::from($labelusers) }};

    </script>
</x-app-layout>
