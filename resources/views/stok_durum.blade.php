@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Stok Durum Kontrol
@endsection

@section('icerik')
<div id='app'>
        <div class="card border-warning">
            <div class="card-body">
		<div class='input-group'>
			<input type='text' v-model='mal_kodu' class='form-control' />
			<button type='button' class='btn  btn-default' @click='liste'><i class='fa fa-search'></i> Ara</button>
            	</div>
	    </div>
        </div>

    <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
   <div v-if='stoklar && stoklar.length>0'>
	<table class='table table-condenced table-hover'>
		<thead>
			<tr>
				<th>Depo Ad</th>
				<th>Lot No</th>
				<th>Son Kullanma Tarihi</th>
				<th>Kullanılabilir</th>
				<th>Stok Giriş</th>
				<th>Stok Çıkış</th>
				<th>Stok Miktar</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for='stok in stoklar'>
				<td>@{{ stok.DEPOAD }}</td>
				<td>@{{ stok.LOTNO }}</td>
				<td>@{{ stok.SONKULLANMATARIH }}</td>
				<td>@{{ stok.KULLANILABILIR }}</td>
				<td>@{{ stok.STOKGIRIS }}</td>
				<td>@{{ stok.STOKCIKIS }}</td>
				<td>@{{ stok.STOKMIKTAR }}</td>
			</tr>
		</tbody>

	</table>
  </div>
</div>
@endsection

@section('scripts')
<script>

var vue=new Vue({
    el:'#app',
    data:{
        isLoading:false,
        stoklar:null,
        mal_kodu:null,
    },
    methods:{
        liste(){
            this.isLoading=true;
            self=this;
            axios.get('/stok_durum/'+this.mal_kodu)
                    .then(function(response){
			console.log(response.data);
                        self.stoklar = response.data;
                        self.isLoading=false;
                    });
        },
    },
})

</script>
@endsection
