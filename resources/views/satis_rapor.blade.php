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
        <table class="table table-hover table-condenced table-striped" v-cloak>
            <thead>
                <tr>
                    <th>Evrak Yıl</th>
                    <th class="text-center">Miktar</th>
                    <th class="text-center">Tutar</th>
                    <th class="text-center">İskonto</th>
                    <th class="text-center">Net Tutar</th>
                    <th class="text-center">KDV</th>
                    <th class="text-center">Toplam</th>
                </tr>
            </thead>
            <tbody>
                <template  v-for='yil in yillik_satislar'>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-sm btn-link icon-only" @click='yilAc(yil.yil)'>
                                <i class="fa fa-plus" v-if='yil_index != yil.yil'></i>
                                <i class="fa fa-minus" v-else></i>
                            </button>
                            @{{ yil.yil}}</td>
                        <td class="text-right" v-text='format(yil.miktar)'></td>
                        <td class="text-right" v-text='format(yil.tutar)'></td>
                        <td class="text-right" v-text='format(yil.iskonto)'></td>
                        <td class="text-right" v-text='format(yil.nettutar)'></td>
                        <td class="text-right" v-text='format(yil.kdv)'></td>
                        <td class="text-right" v-text='format(yil.toplam)'></td>
                    </tr>
                    <template  v-if='aylik_satislar.length > 0 && yil_index == yil.yil' v-for='ay in aylik_satislar'>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-link icon-only" @click='ayAc(ay.ay)'>
                                    <i class="fa fa-plus" v-if='ay_index != ay.ay'></i>
                                    <i class="fa fa-minus" v-else></i>
                                </button>
                                @{{ ay.yil}} - @{{ ay.ay }}
                            </td>
                            <td class="text-right" v-text='format(ay.miktar)'></td>
                            <td class="text-right" v-text='format(ay.tutar)'></td>
                            <td class="text-right" v-text='format(ay.iskonto)'></td>
                            <td class="text-right" v-text='format(ay.nettutar)'></td>
                            <td class="text-right" v-text='format(ay.kdv)'></td>
                            <td class="text-right" v-text='format(ay.toplam)'></td>
                        </tr>
                        <template v-if='musteriler.length > 0 && yil_index == yil.yil && ay_index == ay.ay' v-for='musteri in musteriler'>
                            <tr>
                                <td>@{{ musteri.unvan }} </td>
                                <td class="text-right" v-text='format(ay.miktar)'></td>
                                <td class="text-right" v-text='format(ay.tutar)'></td>
                                <td class="text-right" v-text='format(ay.iskonto)'></td>
                                <td class="text-right" v-text='format(ay.nettutar)'></td>
                                <td class="text-right" v-text='format(ay.kdv)'></td>
                                <td class="text-right" v-text='format(ay.toplam)'></td>
                            </tr>
                            <template  v-if='musteri_detaylar.length >0 && yil_index == yil.yil && ay_index == ay.ay && hesapkod == musteri_detaylar'>
                                <tr>
                                    <td colspan="7">
                                        <table class="table table-hover table-condenced table-striped text-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Ürün Kod</th>
                                                    <th class="text-center">Ürün Ad</th>
                                                    <th class="text-center">Hesap Kodu</th>
                                                    <th class="text-center">Evarak Tarihi</th>
                                                    <th class="text-center">Evrak No</th>
                                                    <th class="text-center">Ana Miktar</th>
                                                    <th class="text-center">Birim Fiyat</th>
                                                    <th class="text-center">Tutar</th>
                                                    <th class="text-center">İskonto</th>
                                                    <th class="text-center">Net Tutar</th>
                                                    <th class="text-center">KDV</th>
                                                    <th class="text-center">Toplam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr  v-for='hesap in ay.hesaplar'>
                                                    <td>@{{ hesap.malkod }}</td>
                                                    <td>@{{ hesap.malad }}</td>
                                                    <td>@{{ hesap.hesapkod }}</td>
                                                    <td>@{{ hesap.evrak_tarih }}</td>
                                                    <td>@{{ hesap.evrakno }}</td>
                                                    <td class="text-right" v-text='format(hesap.miktar)'></td>
                                                    <td class="text-right" v-text='format(hesap.birim_fiyat)'></td>
                                                    <td class="text-right" v-text='format(hesap.tutar)'></td>
                                                    <td class="text-right" v-text='format(hesap.iskonto)'></td>
                                                    <td class="text-right" v-text='format(hesap.net_tutar)'></td>
                                                    <td class="text-right" v-text='format(hesap.kdv)'></td>
                                                    <td class="text-right" v-text='format(hesap.toplam)'></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </template>
                </template>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    var vue = new Vue({
        el:'#app',
        data:{
            isLoading:0,
            yil_index:null,
            ay_index:null,
            hesapkod:null,
            detay:null,
            yillik_satislar:{!! $yillik_satislar !!},
            aylik_satislar:{},
            musteriler:{},
            musteri_detaylar:{},
        },
        methods:{
            format(rakam){
                return  numeral(rakam) . format('0,0.00');
            },
            yilAc(yil){
                if(this.yil_index == null || this.yil_index != yil){
                    this.aylik_satislar = {};
                    this.musteriler = {};
                    this.musteri_detaylar = {};
                    this.yil_index = null;
                    this.ay_index = null;
                    this.hesapkod = null;
                    this.hesap_detay = null;
                    this.yil_index = yil;
                    self = this;
                    axios.get('/satis_rapor_ay?yil='+yil)
                        .then(({data}) => {
                            self.aylik_satislar = data;
                        });
                } else {
                    this.aylik_satislar = {};
                    this.musteriler = {};
                    this.musteri_detaylar = {};
                    this.yil_index = null;
                    this.ay_index = null;
                    this.hesapkod = null;
                    this.hesap_detay = null;
                }
            },
             ayAc(ay){

                if(this.ay_index == null || this.ay_index != ay){
                    this.ay_index = ay;
                    this.musteriler = {};
                    this.musteri_detaylar = {};
                    this.hesapkod = null;
                    this.hesap_detay = null;
                    axios.get('/satis_rapor_musteri?yil='+this.yil_index+'&ay='+ay)
                        .then(({data}) => {
                            self.musteriler = data;
                        });
                } else {
                    this.musteriler = {};
                    this.musteri_detaylar = {};
                    this.ay_index = null;
                    this.hesapkod = null;
                    this.hesap_detay = null;
                }
            },
            hesapAc(hesapkod){
                if(this.hesapkod == null){
                    this.hesapkod = hesapkod;
                } else {
                    this.musteri_detaylar = {};
                    this.hesapkod = null;
                    this.hesap_detay = null;
                }
            },
        }
    })
</script>
@endsection