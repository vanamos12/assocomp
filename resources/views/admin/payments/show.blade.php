<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">

        <div class="flex flex-row justify-between px-3 items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ $user->name() }}
            </h2>

            <a href="{{route('payments.create', $user)}}"
                class="bg-green-800 rounded-lg py-2 px-4 text-white"
            >{{ __('Nouveau Pret')}}</a>
        </div>

        
    </x-slot>

    <section class="px-6">
        <div class="overflow-scroll border-b border-gray-200">
            <table class="min-w-full">
                <thead class="bg-blue-500">
                    <tr>
                        <x-table.head>Montant</x-table.head>
                        <x-table.head>Date de Contraction</x-table.head>
                        <x-table.head>Date remboursement</x-table.head>
                        <x-table.head class="text-center">Total</x-table.head>
                        <x-table.head>Actions</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    @foreach($payments as $key => $payment)
                       <tr>
                            <x-table.data>
                                <div>{{ $payment->amount }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $payment->creation }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $payment->nextpaymentlimit }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div class="px-2 py-1 text-center text-gray-700 bg-green-200 rounded">
                                    {{ $payment->total }}
                                </div>
                            </x-table.data>
                            <x-table.data>
                                <div class="px-2 py-1 text-center text-gray-700 bg-green-200 rounded">
                                    <a href="{{ route('payments.giveback', [$user->username(), $payment->id])}}">Rembourser</a>
                                </div>
                            </x-table.data>
                        </tr> 
                    @endforeach
                    
                </tbody>

            </table>
            
        </div>
        <div class="flex justify-end mt-2">
            <h2 class="text-black text-4xl">Total : <span class="text-red-600">{{ $sum }}</span></h2>
        </div>
    </section>

</x-app-layout>