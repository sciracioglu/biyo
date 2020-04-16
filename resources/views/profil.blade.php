@extends('layouts.master')

@section('baslik')
    Profil
@endsection


@section('icerik')
<div class="row justify-content-md-center">
    <div class="col-md-12">
        <div class="card" style="width: 28rem;">
            @if(isset($info))
                <h3 class='text-info'>{{ $info }}</h3>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ session('username') }}</h5>
                <form method="POST" action="/profil">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="password">Yeni Şifreniz</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Yeni Şifreniz Tekrar</label>
                        <input type="password" name="password_confirmation" class="form-control" id='password_confirmation'>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"> Şifre Değiştir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection