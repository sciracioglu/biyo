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
        <div class="well mb-4">
            <h4>Kapatma Dışı Borç Hareketleri</h4>
        </div>
        <div class="well">
            <h4>Kapatma Dışı Alacak Hareketleri</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well mb-4">
            <h4>Kapatma Dışı Borç Toplam</h4>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Tutar</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Ort. Vade</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Seç Tutar</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Seç Ort. Vade</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="well mb-4">
            <h4>Kapatma Dışı Alacak Toplam</h4>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Tutar</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Ort. Vade</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Seç Tutar</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">Seç Ort. Vade</div>
                        <div class="col-md-8 text-right"></div>
                    </div>
                </div>
            </div>
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
@endsection