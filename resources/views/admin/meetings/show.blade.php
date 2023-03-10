<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ $meeting->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{route('meetings.loan.create', $meeting)}}"
                    class="bg-green-800 rounded-lg py-2 px-4 text-white"
                >{{ __('Preter')}}</a>
                <a href="{{route('meetings.create')}}"
                    class="bg-green-800 rounded-lg py-2 px-4 text-white"
                >{{ __('Emprunter')}}</a>
            </div>
        </div>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden md:overflow-hidden border-b border-gray-200">
           <table class="min-w-full">
                <thead class="bg-blue-500">
                    <tr>
                        <x-table.head>Nom</x-table.head>
                        <x-table.head>Date de tenue</x-table.head>
                        
                        <x-table.head>Actions</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    {{--
                    @foreach($meetings as $key => $meeting)
                       <tr>
                            <x-table.data>
                                <div>{{ $meeting->name }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $meeting->creation }}</div>
                            </x-table.data>
                            
                            <x-table.data>
                                <div class="px-2 py-1 text-center text-gray-700 bg-green-200 rounded">
                                    <a href="{{ route('meetings.show', $meeting->id)}}">Voir</a>
                                </div>
                            </x-table.data>
                        </tr> 
                    @endforeach
                    --}}
                    
                </tbody>

            </table>
        </div>
    </section>

    
</x-app-layout>
