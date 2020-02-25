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
                <div class="card-header" :id="head(index)">
                    <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="hedef(index)" aria-expanded="true" :aria-controls="slugify(index)">
                        @{{ index }} <span class="badge" v-text='toplam_1(index)'><span>
                    </button>
                    </h2>
                </div>
                <div :id="slugify(index)" class="collapse" :aria-labelledby="head(index)" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="accordion" :id="aci(index,'b')">
                            <div class="card" v-for='(depolar,index2) in kodlar'>
                                <div class="card-header" :id="head(index2)">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="hedef(index2)" aria-expanded="true" :aria-controls="slugify(index2)">
                                        @{{ index2 }}
                                        </button>
                                    </h2>
                                </div>
                                <div :id="slugify(index2)" class="collapse" :aria-labelledby="head(index2)" :data-parent="acc(index,'b')">
                                    <div class="card-body">
                                        <div class="accordion" :id="aci(index2,'c')">
                                            <div class="card" v-for='(detaylar,index3) in depolar'>
                                                <div class="card-header" :id="head(index3)">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="hedef(index3)" aria-expanded="true" :aria-controls="slugify(index3)">
                                                        @{{ index3 }}
                                                        </button>
                                                    </h2>
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
                return this.bir.filter(liste => {
                    if(liste.STKKRT_ACIKLAMA3 == ara){
                        return liste;
                    }
                })
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