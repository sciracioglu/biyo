@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Sipariş Listesi
@endsection

@section('icerik')
<div class="row">
    <div class="col">
        <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
        <div class="card border-warning"  v-if='siparisler.length>0' v-cloak>
            <div class="card-body">
                <div>
                    <ul class="list-group">
                        <li class="list-group-item" v-for='(sprs,index) in siparisler'>
                            <h4>@{{sprs.FATURAUNVAN}}</h4>   
                            <p>                         
                            Evrak No : @{{sprs.EVRAKNO}} 
                            </p>
                            <p>
                            Hasta Adı : @{{sprs.ACIKLAMA6}}
                            </p>
                            <p>
                            Tarih : @{{sprs.EVRAKTARIH}} 
                            </p>
                        
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-sm btn btn-outline-info" type="button" @click='detay(sprs)'>
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-sm btn btn-outline-danger" type="button" @click='sil(sprs, index)'>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div v-if='sprs.EVRAKSN === detaysn'>
                                <hr>
                                <table class='table table-condenced'>
                                    <thead>
                                        <tr>
                                            <th>SeriNo</th>
                                            <th>Mal Kod</th>
                                            <th>Mal Ad</th>
                                            <th>Fiyat</th>
                                            <th>UBB</th>
                                            <th>Lot No</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(kalem,ndx) in kalemler'>
                                            <td>@{{kalem.SERINO}}</td>
                                            <td>@{{kalem.MALKOD}}</td>
                                            <td>@{{kalem.MALAD}}</td>
                                            <td>@{{kalem.FIYAT}}</td>
                                            <td>@{{kalem.UBB}}</td>
                                            <td>@{{kalem.LOT}}</td>
                                            <td>
                                                <span class="text-danger" style="cursor:pointer;" @click='kalemSil(ndx, kalem.KALEMSN)'>
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var vue=new Vue({
        el:'#app',
        data:{
            isLoading:false,
            siparisler:@json($siparisler),
            detaysn:null,
            kalemler:null,
        },
        methods:{
            sil(siparis,index){
                var sor=confirm('Silmek istediginize emin misiniz?');
                if(sor){
                    this.isLoading=true;
                    self=this;
                    axios.delete('/siparis_liste/'+siparis.EVRAKSN)
                        .then(({data})=>{
                           if(response.data == 0){
                               self.siparisler.splice(index,1);
                           }
                           self.isLoading=false;
                        });
                }
            },
            kalemSil(index,kalemsn){
                self = this;
                var sor=confirm('Silmek istediginize emin misiniz?')
                if(sor){
                    this.isLoading=true;
                    axios.delete('/siparis/'+kalemsn)
                        .then(function(){
                           self.detay(self.detaysn)
                        });
                }
            },
            detay(siparis){
                self=this;
                this.detaysn = siparis.EVRAKSN;
                axios.get('/siparis_liste/'+siparis.EVRAKSN)
                        .then(({data})=>{
                            self.kalemler = data;
                        });
            },
        }
    });
</script>
@endsection