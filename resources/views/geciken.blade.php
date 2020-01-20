@extends('layouts.master')


@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
  Geciken Bakiye Bilgileri
@stop


@section('icerik')
    <div class="row">
        <div class="col-md-12">
           @include('geciken_tablo')
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/geciken">
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

@endsection