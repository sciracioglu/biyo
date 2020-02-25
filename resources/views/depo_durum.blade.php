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
        <div sty="pb-3 pt-3">
            <span class="input-icon">
                <input type="text" class="form-control" v-model="search" placeholder="Arayın...">
            </span>
        </div>
        <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
        <div class="accordion" id="accordionExample" v-else v-cloak>
            <div class="card" v-for='(kodlar,index) in filtre'>
                <div class="card-header" :id="head(index)">
                    <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="hedef(index)" aria-expanded="true" :aria-controls="slugify(index)">
                        @{{ index }}
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
                                                                <td>@{{ detay.devir }}</td>
                                                                <td>@{{ detay.cikis }}</td>
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
            search:'',
            sonuclar:{!! $sonuclar !!},
        },
        created () {
            this.isLoading=0;
        },
        computed:{
            filtre:function() {
                return this.sonuclar.filter((key=>liste) => {
                    console.log(key);
                    // var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
                    // malkod = liste != null ? liste.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    // search = this.search.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
                    // return malkod.toLowerCase().indexOf(search.toLowerCase()) > -1)
                })
            },
        },
        methods:{
            slugify(text) {
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