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
            <div class="card border-warning"  v-if='siparisler.length>0'>
                    <div class="card-body">
                        <table class='table table-condenced table-hover'>
                            <thead>
                                <tr>
                                    <th>Unvan</th>
                                    <th>Evrak No</th>
                                    <th>Hasta Adı</th>
                                    <th>Tarih</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <div v-for='(siparis,index) in siparisler'>
                                    <tr>
                                        <td style="cursor:pointer;" @click='detay(siparis.EVRAKSN)'>@{{siparis.FATURAUNVAN}}</td>
                                        <td style="cursor:pointer;" @click='detay(siparis.EVRAKSN)'>@{{siparis.EVRAKNO}}</td>
                                        <td style="cursor:pointer;" @click='detay(siparis.EVRAKSN)'>@{{siparis.ACIKLAMA6}}</td>
                                        <td style="cursor:pointer;" @click='detay(siparis.EVRAKSN)'>@{{siparis.EVRAKTARIH}}</td>
                                        <td>
                                            <span class="text-danger" style="cursor:pointer;" @click='sil(siparis.EVRAKSN, index)'>
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" v-if='siparis.EVRAKSN === detaysn'>
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
                                        </td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>
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
            siparisler:{!! $siparisler !!},
            detaysn:null,
            kalemler:null,
        },
        methods:{
            sil(hid,index){
                var sor=confirm('Silmek istediginize emin misiniz?');
                if(sor){
                    this.isLoading=true;
                    self=this;
                    axios.delete('/siparis_liste/'+hid)
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
                    axios.delete('/siparis/'+kalem)
                        .then(function(){
                           self.detay(self.detaysn)
                        });
                }
            },
            detay(evraksn){
                self=this;
                this.detay = evraksn;
                axios.get('/siparis_liste/'+evraksn)
                        .then(({data})=>{
                            self.kalemler = data;
                        });
            },
        }
    });
</script>
@endsection