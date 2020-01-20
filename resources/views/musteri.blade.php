@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
     {{ session('musteri.hesapkod') }}
@endsection

@section('icerik')
   
@endsection

@section('scripts')

@endsection