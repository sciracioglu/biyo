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
            <a href='#' @click='scroll(index)' :class='stil1(index)' v-for='(lkodlar,index) in sonuclar'>
                <h3>@{{ index }}</h3>
                <div class="list-group" :ref='index' v-if='lkodlar.length>0'>
                    <a  @click='scroll(index2); seviye2 = index2' :class='stil2(index2)' class="list-group-item" v-for='(depolar, index2) in lkodlar'>
                        <h4>@{{ index2 }}</h4>
                        <div class="list-group" :ref='index2' v-if='seviye2=index2 && depolar.length>0'>
                            <a @click='scroll(index3); seviye3=index3' :class='stil3(index3)' class="list-group-item" v-for='(detaylar, index3) in depolar'>
                                <h5>@{{ index3 }}</h5>
                                <div :ref='index3' v-if='seviye3=index3 && detaylar.length>0'>
                                    <table class="table table-hover">
                                        <tr v-for='detay in detaylar'>
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
            alt:null,
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
            stil1(secim){
                if(this.seviye1 === secim){
                    return 'list-group-item active';
                }
                return 'list-group-item';
            },
            stil2(secim){
                if(this.seviye2 === secim){
                    return 'list-group-item active';
                }
                return 'list-group-item';
            },
            stil3(secim){
                if(this.seviye3 === secim){
                    return 'list-group-item active';
                }
                return 'list-group-item';
            },
        }
    })
</script>
@endsection