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
            <a :href="#index" @click='seviye1=index' :class='stil1(index)' v-for='(lkodlar,index) in sonuclar'>
                @{{ index }}
            </a>
            <div class="list-group" v-if="kontrol(index)">
                <a :href='#index2' @click='seviye2=index2' :class='stil2(index2)' class="list-group-item" v-for='(depolar, index2) in lkodlar'>
                    @{{ index2 }}
                </a>
                <div class="list-group" v-if='seviye2==index2'>
                    <a href='#' @click='seviye3=index3' :class='stil3(index3)' class="list-group-item" v-for='(detaylar, index3) in depolar'>
                        @{{ index3 }}
                    </a>
                    <div v-if='seviye3==index3'>
                        <table class="table table-hover">
                            <tr v-for='detay in detaylar'>
                                <td>@{{ detay.malkod }}</td>
                                <td>@{{ detay.malad }}</td>
                            </tr>
                        </table>
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
            seviye1:null,
            seviye2:null,
            seviye3:null,
            alt:null,
            sonuclar:{!! $sonuclar !!},
        },
        methods:{
            kontrol(index){
                console.log(index,this.seviye1);
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