@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
  Kapatma Bilgileri
@stop


@section('icerik')
<div class="row" id="app">
    <div class="col-md-9">
        <div class="card border-primary mb-4">
            <div class="card-body">
            <h5  class="card-title">Kapatma Dışı Borç Hareketleri</h5>
            </div>
        </div>
        <div class="card border-secondary">
            <div class="card-body">
                <h5  class="card-title">Kapatma Dışı Alacak Hareketleri</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-4 border-primary">
            <div class="card-body">
                <h5  class="card-title">Kapatma Dışı Borç Toplam</h5>
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
        <div class="card mb-4 border-secondary">
            <div class="card-body">
                <h5  class="card-title">Kapatma Dışı Alacak Toplam</h5>
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
</div>
@endsection

@section('scripts')
<script>
    var vue = new Vue({
        el:'#app',
        data:{
            borclar:{!! $borclar !!},
            alacaklar:{!! $alacaklar !!},
        },
    });
</script>
@endsection