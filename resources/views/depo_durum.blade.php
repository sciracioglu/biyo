@extends('layouts.master')


@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Depo Durum Bilgileri
@endsection


@section('icerik')
<div class="row" id="app">
    <div class="col-md-12">
        <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
        <div class="accordion" id="accordionExample" v-else v-cloak>
            <div class="card" v-for='(kodlar,index) in sonuclar'>
                <div class="card-header" style="cursor:pointer" :id="head(index)" data-toggle="collapse" :data-target="hedef(index)" aria-expanded="true" :aria-controls="slugify(index)">
                    <h4 class="mb-0">
                        @{{ index }} <span class="badge badge-primary" v-text='toplam_1(index)'><span>
                    </h4>
                </div>
                <div :id="slugify(index)" class="collapse" :aria-labelledby="head(index)" data-parent="#accordionExample">
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
            isLoading:1,
            sonuclar:{!! $sonuclar !!},
            bir:{!! $bir !!},
            iki:{!! $iki !!},
            uc:{!! $uc !!},
        },
        created () {
            this.isLoading=0;
        },

        methods:{
            toplam_1:function(ara) {
                var sonuc =  _.find(this.bir, ['STKKRT_ACIKLAMA3', ara]);
                return sonuc.total;
            },
            toplam_2:function(ara,ara2) {
                var strArray = ara2.split(" | ");
                var sonuc2 =  _.find(this.iki, {'STKKRT_ACIKLAMA3': ara,'STKKRT_ACIKLAMA3':strArray[0],'STKKRT_LKOD8':strArray[1],'MALKOD':strArray[2]});
                return sonuc2.total;
            },
            toplam_3:function(ara,ara2,ara3) {
               var strArray2 = ara2.split(" | ");
               var strArray = ara3.split(" | ");
               var sonuc3 =  _.find(this.uc,{'STKKRT_ACIKLAMA3': ara,'STKKRT_ACIKLAMA3':strArray2[0],'STKKRT_LKOD8':strArray2[1],'MALKOD':strArray2[2],'DEPOKOD':strArray[0],'DEPOAD':strArray[1],'MALKOD':strArray[2]});
                return sonuc3.total;
            },
            slugify(text) {
                text = text.toString();
                var trMap = {
                    'çÇ':'c',
                    'ğĞ':'g',
                    'şŞ':'s',
                    'üÜ':'u',
                    'ıİ':'i',
                    'öÖ':'o'
                };
                for(var key in trMap) {
                    text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
                }
                return  text.replace(/[^-a-zA-Z0-9\s]+/ig, '') // remove non-alphanumeric chars
                            .replace(/\s/gi, "-") // convert spaces to dashes
                            .replace(/[-]+/gi, "-") // trim repeated dashes
                            .toLowerCase();

            },
            head(i){
                return 'h_'+this.slugify(i);
            },
            aci(i,harf){
                return harf+'_'+this.slugify(i);
            },
            acc(i,harf){
                return '#'+harf+'_'+this.slugify(i);
            },
            hedef(i){
                return '#'+this.slugify(i);
            },
        }
    })
</script>
@endsection