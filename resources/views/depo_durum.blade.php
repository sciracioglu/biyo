@extends('layouts.master')


@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Çek Senet Bilgileri
@endsection


@section('icerik')
<div class="row" id="app">
    <div class="col-md-12">
        <div class="list-group">
            <a href='#' @click='scroll(index)' :class='stil1(index,lkodlar)' v-for='(lkodlar,index) in sonuclar'>
                <h3>@{{ index }}</h3>
                <div class="list-group" :ref='index' v-if='seviye1=index1 && alt && alt.length>0'>
                    <a  @click='scroll(index2); seviye2 = index2' :class='stil2(index2,depolar)' class="list-group-item" v-for='(depolar, index2) in alt1'>
                        <h4>@{{ index2 }}</h4>
                        <div class="list-group" :ref='index2' v-if='seviye2=index2 && alt2 && alt2.length>0'>
                            <a @click='scroll(index3); seviye3=index3' :class='stil3(index3)' class="list-group-item" v-for='(detaylar, index3) in alt2'>
                                <h5>@{{ index3 }}</h5>
                                <div :ref='index3' v-if='seviye3=index3 && alt3 && alt3.length>0'>
                                    <table class="table table-hover">
                                        <tr v-for='detay in alt3'>
                                            <td>@{{ detay.malkod }}</td>
                                            <td>@{{ detay.malad }}</td>
                                        </tr>
                                    </table>
                                </div>  
                            </a>
                        </div>
                    </a>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var vue = new Vue({
        el:'#app',
        data:{
            seviye1:null,
            seviye2:null,
            seviye3:null,
            alt1:null,
            alt2:null,
            alt3:null,
            sonuclar:{!! $sonuclar !!},
        },
        methods:{
            scroll(aaa){
                this.seviye1 = aaa;
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