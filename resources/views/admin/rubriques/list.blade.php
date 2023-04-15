<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">

        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Liste des rubriques') }}
            </h2>

            <a href="{{route('rubriques.create')}}"
                class="bg-green-800 rounded-lg py-2 px-4 text-white"
            >{{ __('Nouvelle rubrique')}}</a>
        </div>

        
    </x-slot>

    <section class="px-6">
        <div class="overflow-scroll md:overflow-hidden border-b border-gray-200">
            <table class="min-w-full">
                <thead class="bg-blue-500">
                    <tr>
                        <x-table.head>Nom</x-table.head>
                        <x-table.head>Date de debut</x-table.head>
                        <x-table.head>Date de fin</x-table.head>
                        <x-table.head>Actions</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    @foreach($rubriques as $key => $rub)
                       <tr>
                            <x-table.data>
                                <div>{{ $rub->name }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $rub->debut }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $rub->fin }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div class="px-2 py-1 text-center text-gray-700 bg-green-200 rounded">
                                    <a href="{{ route('rubriques.edit', $rub->id)}}">Editer</a>
                                </div>
                            </x-table.data>
                        </tr> 
                    @endforeach
                    
                </tbody>

            </table>
            
        </div>
        
    </section>

</x-app-layout>