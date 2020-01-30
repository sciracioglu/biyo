@extends('layouts.master')

@section('baslik')
    {{ session('musteri.unvan') }}
@endsection
@section('kucuk_baslik')
    Stok Durum Kontrol
@endsection

@section('icerik')
<div id='app'>
	<div class="padding-bottom-10 padding-top-10">
		<span class="input-icon">
			<input type="text" class="form-control" v-model="search" placeholder="Arayın...">
		</span>
	</div>
    <div v-if='isLoading'><i class="fa fa-gear faa-spin animated fa-3x"></i></div>
   <div v-if='stoklar && stoklar.length>0'>
	<table class='table table-condenced table-hover'>
		<thead>
			<tr>
				<th>Mal Kodu</th>
				<th>Açıklama</th>
				<th>Stok Miktar</th>
				<th>Son Kullanma Tarihi</th>
				<th>Lot No</th>
				<th>Depo Adı</th>
				
				
			</tr>
		</thead>
		<tbody>
			<tr v-for='stok in filtre'>
				<td>@{{ stok.MALKOD }}</td>
				<td>@{{ stok.SERKRT_ACIKLAMA1 }}</td>
				<td>@{{ stok.STOKMIKTAR }}</td>
				<td>@{{ stok.SONKULLANMATARIH }}</td>
				<td>@{{ stok.LOTNO }}</td>
				<td>@{{ stok.DEPOAD }}</td>
				
				
				
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
        stoklar:@json($stoklar),
        search:'',
	},
	computed: {
		siralama(){
            return _.orderBy(this.stoklar,function(stok){ return stok.MALKOD},'asc');
        },
        filtre:function() {
                return this.siralama.filter(liste => {
                    var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
                    malkod = liste.MALKOD != null ? liste.MALKOD.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    malad = liste.SERKRT_ACIKLAMA1 != null ? liste.SERKRT_ACIKLAMA1.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    lotno = liste.LOTNO != null ? liste.LOTNO.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    search = this.search.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
                    return malkod.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
				malad.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
                            (lotno.toLowerCase().indexOf(search.toLowerCase()) > -1 && lotno != null)
                })
        },
    },
    methods:{
        
    },
})

</script>
@endsection
