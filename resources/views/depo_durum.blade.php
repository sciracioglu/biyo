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
        <div class="accordion" id="accordionExample">
            <div class="card" v-for='(kodlar,index) in sonuclar'>
              <div class="card-header" :id="head(index)">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="hedef(index)" aria-expanded="true" :aria-controls="slugify(index)">
                    @{{ index }}
                  </button>
                </h2>
              </div>
          
              <div :id="slugify(index)" class="collapse" :aria-labelledby="head(index)" data-parent="#accordionExample">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod  vice lomo.
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
                                dddd
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
                                ddd

                            </div>
                        </div>
                    </div>
                  </div>

                  Leggings occaecat craft beer farm-to-table, raw denim aesthetic 
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
            ndx:null,
            seviye1:null,
            seviye2:null,
            seviye3:null,
            alt1:null,
            alt2:null,
            alt3:null,
            sonuclar:{!! $sonuclar !!},
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
            scroll1(aaa){
                this.seviye1 = aaa;
                this.alt1 = this.sonuclar[aaa];
            },
            scroll2(aaa,bbb){
                this.seviye2 = aaa;
                this.alt2 = bbb;
                var element = this.$refs[aaa];
                var top = element.offsetTop;

                window.scrollTo(0, top);
                console.log(aaa,this.seviye1);
            },
            scroll3(aaa,bbb){
                this.seviye3 = aaa;
                this.alt3 = bbb;
                var element = this.$refs[aaa];
                var top = element.offsetTop;

                window.scrollTo(0, top);
                console.log(aaa,this.seviye1);
            },
            stil1(secim,alt1){
               
                this.alt1 = alt1;
                if(this.seviye1 === secim){
                    return 'list-group-item active';
                }
                return 'list-group-item';
            },
            stil2(secim,alt2){
                this.alt2 = alt2;
                if(this.seviye2 === secim){
                    return 'list-group-item active';
                }
                return 'list-group-item';
            },
            stil3(secim,alt3){
                this.alt3 = alt3;
                if(this.seviye3 === secim){
                    return 'list-group-item active';
                }
                return 'list-group-item';
            },
        }
    })
</script>
@endsection