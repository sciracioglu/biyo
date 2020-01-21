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
                                <tr v-for='(siparis,index) in siparisler' @click='detay(siparis.EVRAKSN)'>
                                    <td>@{{siparis.FATURAUNVAN}}</td>
                                    <td>@{{siparis.EVRAKNO}}</td>
                                    <td>@{{siparis.ACIKLAMA6}}</td>
                                    <td>@{{siparis.EVRAKTARIH}}</td>
                                    <td>
                                        <span class="text-danger" style="cursor:pointer;" @click='sil(siparis.EVRAKSN, index)'>
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </td>
                                </tr>
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
            evraklar:null,
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
                           self.isLoading=false,
                        });
                }
            },
            detay(evraksn){
                self=this;
                axios.get('/siparis_liste/'+evraksn)
                        .then(({data})=>{
                            self.evraklar = data;
                        });
            },
        }
    });
</script>
@endsection