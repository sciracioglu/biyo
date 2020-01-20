@extends('layouts.master')
@section('baslik')
    {{ session('musteri.unvan') }}
@endsection

@section('kucuk_baslik')
    Stok Durum Raporu
@endsection

@section('icerik')
<style>
[v-cloak] > * { display:none; }
[v-cloak]::before { content: "loading..."; }
</style>
<div class="padding-bottom-10 padding-top-10">
			<span class="input-icon">
				<input type="text" class="form-control" v-model="search" placeholder="Arayın...">
			</span>
		</div>
<table class="table table-condenced table-hover" id='app'>
    <thead>
        <tr>
            <th>Mal Kod</th>
            <th>Mal Ad</th>
	   <th>Depo Ad</th>
            <th class="text-right">Stok Miktar</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for='rapor in filtre' v-cloak>
            <td>@{{ rapor.MALKOD }}</td>
            <td>@{{ rapor.STKKRT_MALAD+' '+rapor.STKKRT_MALAD2 }}</td>
	   <td>@{{ rapor.DEPOAD }}</td>
            <td class="text-right">@{{ rapor.STOKMIKTAR }}</td>
        </tr>
    </tbody>
</table>
@endsection

@section('scripts')
<script>
var vue = new Vue({
    el:'#app',
    data:{
	search:'',
        raporlar: {!! $raporlar !!},
    },
   computed: {
        filtre:function() {
                return this.raporlar.filter(liste => {
                    var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
                    malkod = liste.MALKOD != null ? liste.MALKOD.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    malad = liste.STKKRT_MALAD != null ? liste.STKKRT_MALAD.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    depoad = liste.DEPOAD != null ? liste.DEPOAD.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
                    search = this.search.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
                    return malkod.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
				malad.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
                            (depoad.toLowerCase().indexOf(search.toLowerCase()) > -1 && depoad != null)
                })
        },
    },
})

</script>
@endsection
