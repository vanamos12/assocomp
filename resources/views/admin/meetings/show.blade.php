<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        
        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ $meeting->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{route('meetings.loan.create', $meeting->id)}}"
                    class="bg-green-800 rounded-lg py-2 px-4 text-white"
                >{{ __('Preter')}}</a>
                <a href="{{route('meetings.borrow.create', $meeting->id)}}"
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
                        <x-table.head>Montant</x-table.head>
                        <x-table.head>Type</x-table.head>
                        
                        <x-table.head>Utilisateur</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    
                    @foreach($loansmeeting as $key => $loan)
                       <tr>
                            <x-table.data>
                                <div>{{ $loan->amount }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ 'Pret' }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $loan->user->username }}</div>
                            </x-table.data>
                            
                        </tr> 
                    @endforeach
                    
                    @foreach($paymentsmeeting as $key => $payment)
                       <tr>
                            <x-table.data>
                                <div>{{ $payment->amount }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ 'Emprunt' }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $payment->user->username }}</div>
                            </x-table.data>
                        </tr> 
                    @endforeach
                    
                </tbody>

            </table>

            
        </div>
        <div class="flex justify-end items-center text-4xl">
                <h2>Argent disponible : <span class="text-red-600">{{ $loantotal }}</span></h2>
            </div>
    </section>

    
</x-app-layout>
