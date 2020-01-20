@extends('layouts.master')

@section('baslik')
    
@endsection
@section('kucuk_baslik')
     Ana Sayfa
@endsection

@section('icerik')
<div class="row">
    <div class="col-md-4">
        {!! Form::open(['url'=>'/', 'method'=>'post']) !!}
        <div class="form-group">
            {!! Form::label('musteri','Müşteriler') !!}
            {!! Form::select('musteri',[''=>'Seçin...']+$liste,'',['id'=>'musteri', 'class'=>'select form-control','required']) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-check-square-o"></i> Müşteriyi Seç.
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
<script > 
$('#musteri').select2();
</script>
@endsection