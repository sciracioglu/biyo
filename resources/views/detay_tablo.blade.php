@if(count($geciken)>0)
    <table class="table table-stripped table-condensed table-hover">
        <thead>
        <tr>
            <th style="text-align: center">Evrak Tarihi</th>
            <th style="text-align: center">Evrak No</th>
            <th style="text-align: center">Vade Tarihi</th>
            <th style="text-align: center">Bekleme Süresi</th>
            <th style="text-align: center">Vade Gün Farkı</th>
            <th style="text-align: center">İşlem Tipi</th>
            <th style="text-align: center">Borç Alacak</th>
            <th style="text-align: center">Tutar</th>
            <th style="text-align: center">Kullanılan</th>
            <th style="text-align: center">Kalan</th>
            <th style="text-align: center">Bakiye</th>
        </thead>
        <tbody>
        @foreach($geciken as $b)
            <?php
            $vade_tar= $evr_tar= $g= $g1=$a=$a1=$y=$y1=$tar = $tar1 = '';
            if(isset($b->EVRAKTARIH)){
                list($tar, $saat) = explode(' ', $b->EVRAKTARIH);
                list($y, $a, $g) = explode('-', $tar);
                $evr_tar = $g.'.'.$a.'.'.$y;
            }
            if(isset($b->VADETARIH)){
                list($tar, $saat) = explode(' ', $b->VADETARIH);
                list($y, $a, $g) = explode('-', $tar);
                $vade_tar = $g.'.'.$a.'.'.$y;
            }
                    ?>
            <tr>
            <td>{{ $evr_tar }} </td>
                <td style="text-align: center;">{{$b->EVRAKNO }} </td>
                <td style="text-align: center;">{{ $vade_tar }} </td>
                <td style="text-align: center;">{{ $b->BEKLEMESURE }} </td>
                <td style="text-align: center;">{{ $b->VADEFARKGUN }} </td>
                <td style="text-align: center;">{{ $evr_tip[$b->ISLEMTIP] }} </td>
                <td style="text-align: right; color:red">{{ ($b->BORCALACAK == 0) ? 'Borç' : 'Alacak' }} </td>
                <td style="text-align: right; color:red">{{ number_format($b->TUTAR,2,',','.') }} </td>
                <td style="text-align: right; color:red">{{ number_format($b->KULLANILAN,2,',','.') }} </td>
                <td style="text-align: right; color:red">{{ number_format($b->KALAN,2,',','.') }} </td>
                <td style="text-align: right; color:red">{{ number_format($b->BAKIYE,2,',','.') }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    Bakiye kaydı bulunamadı.
@endif