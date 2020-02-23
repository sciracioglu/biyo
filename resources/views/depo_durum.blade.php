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
              <div class="card-header" :id="index">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#index1" aria-expanded="true" :aria-controls="index">
                    @{{ index }}
                  </button>
                </h2>
              </div>
{{--           
              <div id="index" class="collapse" :aria-labelledby="index" data-parent="#sonuc_listesi">
                <div class="card-body">
                    
                    <div class="accordion" id="lkod8_listesi">
                        <div class="card" v-for='(lkod8,index2) in sonuc.detay'>
                          <div class="card-header" :id="index2">
                            <h2 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#index2" aria-expanded="true" :aria-controls="index2">
                                @{{ lkod8.baslik }}
                              </button>
                            </h2>
                          </div>
                      
                          <div id="index2" class="collapse" :aria-labelledby="index2" data-parent="#lkod8_listesi">
                            <div class="card-body">
                                
                                <div class="accordion" id="depoad_listesi">
                                    <div class="card" v-for='(depolar,index3) in lkod8.detay'>
                                      <div class="card-header" :id="index3">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#index3" aria-expanded="true" :aria-controls="index3">
                                            @{{ depolar.baslik }}
                                          </button>
                                        </h2>
                                      </div>
                                  
                                      <div id="index3" class="collapse" :aria-labelledby="index3" data-parent="#depoad_listesi">
                                        <div class="card-body">
                                            <table class="table table-hover table-condenced">
                                                <tr v-for='detay in depolar.detay'>
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
              </div> --}}
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
            sonuclar:{!! $sonuclar !!},
        }
    })
</script>
@endsection