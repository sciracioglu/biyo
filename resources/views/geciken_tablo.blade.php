@if(count($geciken)>0)
<table class="table table-stripped table-condensed table-hover">
    <thead>
    <tr>
        <th style="text-align: center">Borç</th>
        <th style="text-align: center">Alacak</th>
        <th style="text-align: center">Bakiye</th>
        <th style="text-align: center">Bakiye Ort. Vadesi</th>
        <th style="text-align: center">Bakiye Vade Gün Farkı</th>
        <th style="text-align: center">Geciken Bakiye</th>
        <th style="text-align: center">Geciken Bak. Ort. Vade</th>
        <th style="text-align: center">Geciken Bak. Vade Gün Farkı</th>
        <th style="text-align: center">Borç Ort. Vade</th>
        <th style="text-align: center">Alacak Ort. Vade</th>
    </thead>
    <tbody>

    @foreach($geciken as $b)
        <?php
        $bak_tar= $gbak_tar=$borc_tar=$alacak_tar= $g= $g1=$a=$a1=$y=$y1=$tar = $tar1 = '';

        if(isset($b->BAKIYEORTVADE)){
            list($tar, $saat) = explode(' ', $b->BAKIYEORTVADE);
            list($y, $a, $g) = explode('-', $tar);
            $bak_tar = $g.'.'.$a.'.'.$y;
        }
        if(isset($b->GECIKENBAKIYEORTVADE)){
            list($tar, $saat) = explode(' ', $b->GECIKENBAKIYEORTVADE);
            list($y, $a, $g) = explode('-', $tar);
            $gbak_tar = $g.'.'.$a.'.'.$y;
        }
        if(isset($b->BORCORTVADE)){
            list($tar, $saat) = explode(' ', $b->BORCORTVADE);
            list($y, $a, $g) = explode('-', $tar);
            $borc_tar = $g.'.'.$a.'.'.$y;
        }
        if(isset($b->ALACAKORTVADE)){
            list($tar, $saat) = explode(' ', $b->ALACAKORTVADE);
            list($y, $a, $g) = explode('-', $tar);
            $alacak_tar = $g.'.'.$a.'.'.$y;
        }
        
                ?>
        <tr>
            <td style="text-align: center;">{{  number_format($b->BORC,2,',','.') }} </td>
            <td style="text-align: right;">{{ number_format($b->ALACAK,2,',','.') }} </td>
            <td style="text-align: right;">{{ number_format($b->BAKIYE,2,',','.') }} </td>
            <td style="text-align: center;">{{ $bak_tar }} </td>
            <td style="text-align: center;">{{ $b->BAKIYEVADEFARKGUN }} </td>
            <td style="text-align: right; color:red">{{ number_format($b->GECIKENBAKIYE,2,',','.') }} </td>
            <td style="text-align: center;">{{ $gbak_tar }} </td>
            <td style="text-align: center;">{{ $b->GECIKENBAKIYEVADEFARKGUN }} </td>
            <td style="text-align: center;">{{ $borc_tar }} </td>
            <td style="text-align: center;">{{ $alacak_tar }} </td>
        </tr>

    @endforeach


    </tbody>
</table>

@if(count($detay)>0)
    <table class="table table-stripped table-condensed table-hover">
        <thead>
        <tr>
            <th style="text-align: center">Evrak No</th>
            <th style="text-align: center">Evarak Tarihi</th>
            <th style="text-align: center">Vade Tarihi</th>
            <th style="text-align: center">Evrak Tipi</th>
            <th style="text-align: center">Tutar</th>
            <th style="text-align: center">Kullanılan</th>
            <th style="text-align: center">Kalan</th>
            <th style="text-align: center">Bakiye</th>
            <th style="text-align: center">Bekleme Süresi</th>
            <th style="text-align: center">Vade Gün Farkı</th>
            <th style="text-align: center">Opsiyon</th>
        </thead>
        <tbody>
@foreach($detay as $d)
    <?php
    $evr_tar= $vad_tar=$tar = $tar1 = '';

    if(isset($d->EVRAKTARIH)){
        list($tar, $saat) = explode(' ', $d->EVRAKTARIH);
        list($y, $a, $g) = explode('-', $tar);
        $evr_tar = $g.'.'.$a.'.'.$y;
    }
    if(isset($d->VADETARIH)){
        list($tar, $saat) = explode(' ', $d->VADETARIH);
        list($y, $a, $g) = explode('-', $tar);
        $vad_tar = $g.'.'.$a.'.'.$y;
    }
?>

        <tr>
            <td style="text-align: center;">{{ $d->EVRAKNO}} </td>
            <td style="text-align: center;">{{ $evr_tar }} </td>
            <td style="text-align: center;">{{ $vad_tar }} </td>
            
            <td style="text-align: center;">{{ isset($evr_tip[$d->EVRAKTIP]) ? $evr_tip[$d->EVRAKTIP] :'' }} </td>
            <td style="text-align: right;">{{  number_format($d->TUTAR,2,',','.') }} </td>
            <td style="text-align: right;">{{ number_format($d->KULLANILAN,2,',','.') }} </td>
            <td style="text-align: right;">{{ number_format($d->KALAN,2,',','.') }} </td>
            <td style="text-align: right;">{{ number_format($d->BAKIYE,2,',','.') }} </td>
            <td style="text-align: center;">{{ $d->BEKLEMESURE }} </td>
            <td style="text-align: center;">{{ $d->VADEFARKGUN }} </td>
            <td style="text-align: center;">{{ $d->OPSIYON }} </td>
        </tr>

    @endforeach
        </tbody>
    </table>
@endif

@else
Geciken Bakiye kaydı bulunamadı.
@endif