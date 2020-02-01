@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Sipariş
@endsection

@section('icerik')
    <form @submit.prevent="kaydet" @keydown="form.errors.clear($event.target.name)">
        @include('ust_form')
        <div class="card border-warning"  v-if='satislar.length>0'>
            <div class="card-body">
                <table class='table table-condenced'>
                    <thead>
                        <tr>
                            <th>UBB</th>
                            <th>Mal Kod</th>
                            <th>Mal Ad</th>
                            <th>Lot No</th>
                            <th>Son Kullanma Tarihi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='(satis,index) in satislar'>
                            <td>@{{satis.UBB}}</td>
                            <td>@{{satis.MALKOD}}</td>
                            <td>@{{satis.MALAD}}</td>
                            <td>@{{satis.SERINO}}</td>
                            <td>@{{satis.SKT}}</td>
                            <td>
                                <span class="text-danger" style="cursor:pointer;" @click='sil(index, satis.KALEMSN)'>
                                    <i class="fa fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <div class='row mt-3'>
        <div class='col-12'>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id='serino' @blur='bilgiAl' v-model='form.serino' placeholder="Seri No" aria-label="Seri No">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" @click='bilgiAl'><i class="fa fa-search"></i></button>
                </div>
                <small id="serino" class="form-text text-danger" v-if="form.errors.has('serino')">Bu alan bos birakilamaz</small>
            </div>
        </div>
        <div class="col-md-12" v-if='urunler.length>0'>
            <table class="table table-condenced table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>Lot No</th>
                        <th>Mal Kodu</th>
                        <th>Mal Adı</th>
                        <th>Stok Miktar</th>
                        <th>Depo Adı</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='(urun,index) in urunler'>
                        <td>
                            <input type="radio" name='urun' @click='urunSec(index)' />
                        </td>
                        <td>@{{ urun.SERINO }}</td>
                        <td>@{{ urun.MALKOD }}</td>
                        <td>@{{ urun.STKKRT_MALAD }}</td>
                        <td>@{{ urun.KULLANILABILIR }} @{{ urun.BIRIM }}</td>
                        <td>@{{ urun.DEPOAD }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
    <div class='row'>
        <div class='col'>
            <button type="submit" class="btn btn-sm btn-block btn-primary">Kaydet</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>

var vue=new Vue({
    el:'#app',
    data:{
        isLoading:false,
        satislar:[],
        ihaleler:{!! $ihaleler !!},
        satiscilar:{!! $satiscilar !!},
        mal_kodu:null,
        mal_adi:null,
        fiyat:null,
        ubb:null,
        skt:null,
        lot_no:null,
        durum:null,
        urunler:[],
        evrak_no:'{{ $evrak_no }}',
        evrak_baslik:{!! session()->has('evrak_baslik') ? session('evrak_baslik') : "null" !!},
        form : new Form({
            hasta:null,
            protokol:null,
            aciklama:null,
            depokod:null,
            evrak_no:'{{ $evrak_no }}',
            serino:null,
            }),
    },
    methods:{
        kaydet(){ 
            self = this;
            isLoading=true;
            this.form.post('/siparis')
                .then(function(){
                    self.form.evrak_no=self.evrak_no;
                    self.form.serino=null;
                    self.liste();
                    self.isLoading=false;
                   
                })
        },
        urunSec(index){
            this.form.depokod = this.urunler[index].DEPOKOD;
            this.form.serino = this.urunler[index].SERINO;
        },
        liste(){
            this.isLoading=true;
            self=this;
            axios.get('/siparis/'+this.evrak_no)
                    .then(function(response){
                        self.satislar = response.data;
                        self.isLoading=false;
                    });
        },
        bilgiAl(){
            if(this.form.serino){
                self = this;
                this.isLoading=true;
                axios.get('/siparis?serino='+this.form.serino)
                    .then(function(response){
                        self.urunler = response.data;
                        self.isLoading=false;
                    });
            }
        },
        sil(index,kalem){
            self = this;
            var sor=confirm('Silmek istediginize emin misiniz?')
            if(sor){
                this.isLoading=true;
                axios.delete('/siparis/'+kalem)
                    .then(function(){
                        self.liste();
                    });
            }
        },
    },
})

</script>
@endsection
