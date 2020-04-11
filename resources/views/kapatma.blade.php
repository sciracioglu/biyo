@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
  Kapatma Bilgileri
@stop


@section('icerik')
<div class="row" id="app">
    <div class="col-md-8">
        <div class="well">

        </div>
    </div>
    <div class="col-md-4">
        <div class="well">

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var vue = new Vue({
        el:'#app',
        data:{
            alacaklar:{!! $alacaklar !!},
        },
    });
</script>
@endscript