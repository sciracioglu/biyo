<div class="row">
    <div class="col-md-12">

        @if(count($bakiye_bakiye)>0)

            <table class="table table-stripped table-condensed table-hover">
                <thead>
                <tr>
                    <th style="text-align: center">Güncel Bakiye</th>
                    <th style="text-align: center">Geciken Bakiye</th>
                    <th style="text-align: center">Para Birimi</th>
                    <th style="text-align: center">Bakiye Ort. Vadesi</th>
                    <th style="text-align: center">Bakiye Bekleme Suresi</th>
                    <th style="text-align: center">Geciken Bakiye Ort. Vade</th>
                </thead>
                <tbody>

                @foreach($bakiye_bakiye as $b)
                    <?php
                    $bak_tar= $gec_tar= $g= $g1=$a=$a1=$y=$y1=$tar = $tar1 = '';

                    if(isset($b->BAKIYE_ORTALAMA_VADESI)){
                        list($tar, $saat) = explode(' ', $b->BAKIYE_ORTALAMA_VADESI);
                        list($y, $a, $g) = explode('-', $tar);
                        $bak_tar = $g.'.'.$a.'.'.$y;
                    }

                    if(isset($b->GECIKENBAKIYEORTVADE)){
                        list($tar1, $saat1) = explode(' ', $b->GECIKENBAKIYEORTVADE);
                        list($y1, $a1, $g1) = explode('-', $tar1);
                        $gec_tar = $g1.'.'.$a1.'.'.$y1;
                    }

                    ?>
                    <tr>
                        <td style="text-align: center">{{  number_format($b->GUNCELBAKIYE,2,',','.') }} TL</td>
                        <td style="text-align: right; color:red;">{{ number_format($b->DOVIZGECIKENBAKIYE,2,',','.') }} {{ $b->HESAP_PARA_BIRIMI }}</td>
                        <td style="text-align: center">{{ $b->HESAP_PARA_BIRIMI }}</td>
                        <td style="text-align: center">{{ $bak_tar }}</td>
                        <td style="text-align: center">{{ $b->BAKIYE_BEKLEME_SURESI }}</td>
                        <td style="text-align: center">{{ $gec_tar }}</td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        @else
            Bakiye kaydı bulunamadı.
        @endif
    </div>

</div>

<div class="row">
    <div class="col-md-12">

      

        @if(count($bakiye)>0)


            <table class="table table-stripped table-condensed table-hover">
                <thead>
                <tr>
                    <th>Risk Tipi</th>
                    <th>Borc</th>
                    <th>Alacak</th>

                    <th>Risk Toplam</th>
                </thead>
                <tbody>

                @foreach($bakiye as $b)
                        <tr>
                            <td>{{ $bakiye_tip[$b->RISKTIP] }}</td>
                            <td style="text-align: right;">{{ number_format($b->BORC,2,',','.') }}</td>
                            <td style="text-align: right;">{{ number_format($b->ALACAK,2,',','.') }}</td>

                            <td style="text-align: right;">{{ number_format($b->RISKTOPLAM,2,',','.') }}</td>
                        </tr>

                @endforeach
                </tbody>
            </table>
        @else
            Bakiye kaydı bulunamadı.
        @endif

    </div>

</div>