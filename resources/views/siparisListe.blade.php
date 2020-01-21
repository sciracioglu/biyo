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
                        <table class='table table-condenced'>
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
                                <tr v-for='(siparis,index) in siparisler'>
                                    <td>@{{siparis.FATURAUNVAN}}</td>
                                    <td>@{{siparis.EVRAKNO}}</td>
                                    <td>@{{siparis.ACIKLAMA6}}</td>
                                    <td>@{{siparis.EVRAKTARIH}}</td>
                                    <td>
                                        <span class="text-danger" style="cursor:pointer;" @click='sil(siparis.EVRAKSN)'>
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
        },
        
        methods:{
            sil(hid){
                var sor=confirm('Silmek istediginize emin misiniz?');
                if(sor){
                    this.isLoading=true;
                    axios.delete('/siparis_liste/'+hid)
                        .then(function(){
                            self.liste();
                        });
                }
            },
        }
    });
</script>
@endsection