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
        <table class="table table-hover table-condenced table-striped">
            <thead>
                <tr>
                    <th>Evrak Yıl</th>
                    <th>Miktar</th>
                    <th>Tutar</th>
                    <th>İskonto</th>
                    <th>Net Tutar</th>
                    <th>KDV</th>
                    <th>Toplam</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='(yil, index) in yillik_satislar'>
                    <td>@{{ yil.EVRAKYIL}}</td>
                    <td class="text-right" v-text='format(yil.T_MIKTAR)'></td>
                    <td class="text-right" v-text='format(yil.T_TUTAR)'></td>
                    <td class="text-right" v-text='format(yil.T_ISKONTO)'></td>
                    <td class="text-right" v-text='format(yil.T_NETTUTAR)'></td>
                    <td class="text-right" v-text='format(yil.T_KDV)'></td>
                    <td class="text-right" v-text='format(yil.T_TOPLAM)'></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    var numeral = require('numeral');
    var vue = new Vue({
        el:'#app',
        data:{
            isLoading:0,
            yillik_satislar:{!! $yillik_satislar !!},
            aylik_satislar:null,
            cari_satislari:null,
        },
        computed:{
            format(rakam){

                return  numeral(rakam) . format('0,0.00');
            }
        },
        methods:{

        }
    })
</script>
@endsection