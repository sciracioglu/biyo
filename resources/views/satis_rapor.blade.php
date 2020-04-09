@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Satış Raporları
@endsection


@section('icerik')
<div class="row" id='app'>
    <div class="col-md-12">
        <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
        <div class="list-group">
            <div class="list-group-item" v-for='(yil, index) in yillik_satislar'>
                <div class="row">
                    <div class="col-md-2">@{{ yil.EVRAKYIL}}</div>
                    <div class="col-md-1">@{{ yil.T_MIKTAR }}</div>
                    <div class="col-md-2">@{{ yil.T_TUTAR }}</div>
                    <div class="col-md-1">@{{ yil.T_ISKONTO }}</div>
                    <div class="col-md-2">@{{ yil.T_NETTUTAR }}</div>
                    <div class="col-md-2">@{{ yil.T_KDV }}</div>
                    <div class="col-md-2">@{{ yil.T_TOPLAM }}</div>
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
            isLoading:0,
            yillik_satislar:{!! $yillik_satislar !!},
            aylik_satislar:null,
            cari_satislari:null,
        },
        methods:{

        }
    })
</script>
@endsection