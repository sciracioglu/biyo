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
        <div class="accordion" id="accordionExample" v-else v-cloak>
            <div class="card" v-for='(yil,index) in yillik_satislar'>
                <div class="card-header" style="cursor:pointer" :id="head(index)" data-toggle="collapse" :data-target="hedef(index)" aria-expanded="true" :aria-controls="slugify(index)">
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
                <!-- <div :id="slugify(index)" class="collapse" :aria-labelledby="head(index)" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="accordion" :id="aci(index,'b')">
                            <div class="card" v-for='(depolar,index2) in kodlar'>
                                <div class="card-header" :id="head(index2)" style="cursor:pointer" data-toggle="collapse" :data-target="hedef(index2)" aria-expanded="true" :aria-controls="slugify(index2)">
                                    <h4 class="mb-0 text-info">
                                        @{{ index2 }} <span class="badge badge-info" v-text='toplam_2(index,index2)'><span>
                                    </h4>
                                </div>
                                <div :id="slugify(index2)" class="collapse" :aria-labelledby="head(index2)" :data-parent="acc(index,'b')">
                                    <div class="card-body">
                                        <div class="accordion" :id="aci(index2,'c')">
                                            <div class="card" v-for='(detaylar,index3) in depolar'>
                                                <div class="card-header" :id="head(index3)" style="cursor:pointer" data-toggle="collapse" :data-target="hedef(index3)" aria-expanded="true" :aria-controls="slugify(index3)">
                                                    <h4 class="mb-0 text-danger">
                                                        @{{ index3 }} <span class="badge badge-danger" v-text='toplam_3(index,index2,index3)'><span>
                                                    </h4>
                                                </div>
                                                <div :id="slugify(index3)" class="collapse" :aria-labelledby="head(index3)" :data-parent="acc(index2,'c')">
                                                    <div class="card-body">
                                                        <table class="table table-hover">
                                                            <tr v-for='detay in detaylar'>
                                                                <td>@{{ detay.malkod }}</td>
                                                                <td>@{{ detay.malad }}</td>
                                                                <td>@{{ detay.ozelkod }}</td>
                                                                <td>@{{ detay.tarih }}</td>
                                                                <td>@{{ detay.miktar }}</td>
                                                                <td>@{{ detay.seri }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
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