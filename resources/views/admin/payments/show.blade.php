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
        <div class="overflow-hidden border-b border-gray-200">
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
                    @foreach($payments as $key => $payment)
                       {{--<tr>
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
                        </tr> --}}
                    @endforeach
                    
                </tbody>

            </table>
        </div>
    </section>

</x-app-layout>