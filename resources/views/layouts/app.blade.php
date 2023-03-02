<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body class="font-sans antialiased">

    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">

        <x-dashboard.nav />

        <div class="grid grid-cols-8 mx-auto w-5/6">

            {{-- Sidenav --}}
            <x-dashboard.sidenav />

            <div class="col-span-7">
                <!-- Page Heading -->
                @if (isset($header))
                <header class="mx-6 mt-6 text-gray-600 shadow bg-blue-50">
                    <div class="px-4 py-6 wrapper">
                        {{ $header }}
                    </div>
                </header>
                @endif

                <!-- Page Content -->
                <main class="m-6 bg-white shadow">
                    <div class="py-6">
                        {{ $slot }}
                    </div>
                </main>

            </div>

        </div>



    </div>

    @stack('modals')

    @livewireScripts
   
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> 
  <script>
  $( function() {
    
 
    $( "#search-user" ).autocomplete({
      minLength: 0,
      source: projects,
      focus: function( event, ui ) {
        $( "#search-user" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#search-user" ).val( ui.item.label );
        
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li style='background-color:white;border-bottom:2px solid lightgray;'>" )
        .append( `<a href="/dashboard/payments/${item.label}"><div>${item.label}</div></a>` )
        .appendTo( ul );
    };
  } );
  </script>
</body>
</html>
