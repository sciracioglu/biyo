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
        <div class="accordion" id="sonuc_listesi">
            <div class="card" v-for='(sonuc,index) in sonuclar'>
              <div class="card-header" :id="sonuc.STKKRT_ACIKLAMA3">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="#"+index aria-expanded="true" :aria-controls="index">
                    @{{ sonuc.STKKRT_ACIKLAMA3 }}
                  </button>
                </h2>
              </div>
          
              <div :id="index" class="collapse" :aria-labelledby="sonuc.STKKRT_ACIKLAMA3" data-parent="#sonuc_listesi">
                <div class="card-body">
                    
                    <div class="accordion" id="lkod8_listesi">
                        <div class="card" v-for='(lkod8,index2) in sonuc'>
                          <div class="card-header" :id="lkod8.STKKRT_LKOD8">
                            <h2 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="#"+index2 aria-expanded="true" :aria-controls="index2">
                                @{{ lkod8.STKKRT_LKOD8 }}
                              </button>
                            </h2>
                          </div>
                      
                          <div :id="index2" class="collapse" :aria-labelledby="lkod8.STKKRT_LKOD8" data-parent="#lkod8_listesi">
                            <div class="card-body">
                                
                                <div class="accordion" id="depoad_listesi">
                                    <div class="card" v-for='(depoad,index3) in depoad'>
                                      <div class="card-header" :id="depoad.DEPOAD">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="#"+index3 aria-expanded="true" :aria-controls="index3">
                                            @{{ depoad.DEPOAD }}
                                          </button>
                                        </h2>
                                      </div>
                                  
                                      <div :id="index3" class="collapse" :aria-labelledby="depoad.DEPOAD" data-parent="#depoad_listesi">
                                        <div class="card-body">
                                            <table class="table table-hover table-condenced">
                                                <tr v-for='detay in depoad'>
                                                    <td>@{{ detay.malkod }}</td>
                                                    <td>@{{ detay.malad }}</td>
                                                    <td>@{{ detay.ozelkod }}</td>
                                                    <td>@{{ detay.devir }}</td>
                                                    <td>@{{ detay.cikis }}</td>
                                                    <td>@{{ detay.miktar }}</td>
                                                    <td>@{{ detay.seri }}</td>
                                                </tr>
                                            </table>
                                            
                                            
                                        </div>
                                      </div>
                                    </div>
                                </div>      
                                
                            </div>
                          </div>
                        </div>
                    </div>

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
            sonuclar:{!! $sonuclar !!}
        }
    })
</script>
@endsection