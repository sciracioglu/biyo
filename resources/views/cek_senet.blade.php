@extends('layouts.master')


@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Çek Senet Bilgileri
@endsection


@section('icerik')
    <div class="row">
        <div class="col-md-12">
            @include('cek_tablo')

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/cek_senet">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">E-posta adresi</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="e-posta">
                </div>
                <button type="submit" class="btn btn-default">Mail Gönder</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function Goster(id) {
            $("#" + id).toggle('slow');
        }
    </script>
@endsection