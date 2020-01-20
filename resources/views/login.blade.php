@extends('layouts.login')
@section('stil')
<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #fff;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
@endsection
@section('baslik')
    Giriş
@endsection
@section('icerik')
    {!! Form::open(['url'=>'login', 'method'=>'post','class'=>"form-signin"]) !!}
    <form  >
        <img src="/img/biyotem.png" alt="Biyotem" style="height:75px;" />
        <h5 class="h5 mb-3 font-weight-normal">Lütfen Giriş Yapın</h5>
        <label for="user" class="sr-only">Kullanıcı Adı</label>
        <input type="text" id="user" name='kullanici' class="form-control" placeholder="Kullanıcı Adı" required autofocus>
        <label for="sifre" class="sr-only">Şifre</label>
        <input type="password" id="sifre" name='sifre' class="form-control" placeholder="Şifre" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş</button>
    {!! Form::close() !!}
@endsection
