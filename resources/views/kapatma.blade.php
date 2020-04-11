@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
  Cari Hesap Kapatma
@stop


@section('icerik')
<div class="row" id="app">
    <div class="col-md-12">
        <div class="card border-primary mb-4">
            <div class="card-body">
                <h5  class="card-title">Kapatma Dışı Borç Hareketleri</h5>
                <table class="table table-hover table-condenced">
                    <thead>
                        <tr>
                            <th>Evrak Tarihi</th>
                            <th>Evrak No</th>
                            <th>Vade Tarihi</th>
                            <th>İşlem Tipi</th>
                            <th>Açıklama</th>
                            <th>Kapama Tutar</th>
                            <th>Kulanılan Tutar</th>
                            <th>Kalan Tutar</th>
                            <th>Döviz Cinsi</th>
                            <th>Döviz Kuru</th>
                            <th>Döviz Tutar</th>
                            <th>Evrak Döviz Cinsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='borc in borclar'>
                            <td>@{{ borc.EVRAKTARIH }}</td>
                            <td>@{{ borc.EVRAKNO }}</td>
                            <td>@{{ borc.VADETARIH }}</td>
                            <td>@{{ borc.EVRAKTIP }}</td>
                            <td>@{{ borc.ACIKLAMA }}</td>
                            <td class='text-right' v-text='format(borc.KAPAMATUTAR)'></td>
                            <td class='text-right' v-text='format(borc.KULLANILANTUTAR)'></td>
                            <td class='text-right' v-text='format(borc.KALANTUTAR)'></td>
                            <td>@{{ borc.DOVIZCINSI }}</td>
                            <td class='text-right' v-text='format(borc.DOVIZKURU)'></td>
                            <td class='text-right' v-text='format(borc.DOVIZTUTAR)'></td>
                            <td>@{{ borc.EVRAKDOVIZCINSI }}</td>
                        </tr>
                        <tr class="table-warning">
                            <td></td>
                            <td class='text-right'>Ortalama Vade :</td>
                            <td>@{{ borc_ortalama[0].ORTALAMAVADE }}</td>
                            <td></td>
                            <td class='text-right'>Toplam Tutar :</td>
                            <td class='text-right' v-text='format(borc_ortalama[0].TUTARTOPLAM)'></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card border-secondary">
            <div class="card-body">
                <h5  class="card-title">Kapatma Dışı Alacak Hareketleri</h5>
                <table class="table table-hover table-condenced">
                    <thead>
                        <tr>
                            <th>Evrak Tarihi</th>
                            <th>Evrak No</th>
                            <th>Vade Tarihi</th>
                            <th>İşlem Tipi</th>
                            <th>Açıklama</th>
                            <th>Kapama Tutar</th>
                            <th>Kulanılan Tutar</th>
                            <th>Kalan Tutar</th>
                            <th>Döviz Cinsi</th>
                            <th>Döviz Kuru</th>
                            <th>Döviz Tutar</th>
                            <th>Evrak Döviz Cinsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='alacak in alacaklar'>
                            <td>@{{ alacak.EVRAKTARIH }}</td>
                            <td>@{{ alacak.EVRAKNO }}</td>
                            <td>@{{ alacak.VADETARIH }}</td>
                            <td>@{{ alacak.EVRAKTIP }}</td>
                            <td>@{{ alacak.ACIKLAMA1 }}</td>
                            <td class='text-right' v-text='format(alacak.KAPAMATUTAR)'></td>
                            <td class='text-right' v-text='format(alacak.KULLANILANTUTAR)'></td>
                            <td class='text-right' v-text='format(alacak.KALANTUTAR)'></td>
                            <td>@{{ alacak.DOVIZCINS }}</td>
                            <td class='text-right' v-text='format(alacak.DOVIZKUR)'></td>
                            <td class='text-right' v-text='format(alacak.DOVIZTUTAR)'></td>
                            <td>@{{ alacak.EVRAKDOVIZCINS }}</td>
                        </tr>
                        <tr class="table-warning">
                            <td></td>
                            <td class='text-right'>Ortalama Vade :</td>
                            <td>@{{ alacak_ortalama[0].ORTALAMAVADE }}</td>
                            <td></td>
                            <td class='text-right'>Toplam Tutar :</td>
                            <td class='text-right' v-text='format(alacak_ortalama[0].TUTARTOPLAM)'></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    var vue = new Vue({
        el:'#app',
        data:{
            borclar:{!! $borclar !!},
            alacaklar:{!! $alacaklar !!},
            borc_ortalama:{!! $borc_ortalama !!},
            alacak_ortalama:{!! $alacak_ortalama !!},
        },
        methods:{
            format(rakam){
                return  numeral(rakam) . format('0,0.00');
            },
        }
    });
</script>
@endsection