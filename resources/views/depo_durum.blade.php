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
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="hedef(index)" aria-expanded="true" aria-controls="collapseOne">
                    @{{ index }}
                  </button>
                </h2>
              </div>
          
              <div :id="index" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
            hedef(i){
                return '#'+i;
            }
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