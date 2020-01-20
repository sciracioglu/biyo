@include('layouts.header')
@include('layouts.menu')
<div class="container-fluid d-flex flex-column justify-content-between">
    <div class='p-2 bd-highlight'>
        <h5>
            @yield('baslik') 
            <small class="text-muted">@yield('kucuk_baslik')</small>
        </h5>
    </div>
    <div class="p-2" id='app'>
    @yield('icerik')
    </div>

@include('layouts.footer')