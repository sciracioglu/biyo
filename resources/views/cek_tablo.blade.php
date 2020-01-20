@if(count($cek_senet)>0)
    <table class="table table-stripped table-condensed table-hover">
        <thead>
        <tr>
            <th style="text-align: center">İŞLEM TİP</th>
            <th style="text-align: center">TUTAR</th>
            <th style="text-align: center">ADET</th>
            <th style="text-align: center">ORTALAMA VADE TARİHİ</th>
        </thead>
        <tbody>
        @foreach($cek_senet as $b)
            <?php
            $bak_tar = $gec_tar = $g = $g1 = $a = $a1 = $y = $y1 = $tar = $tar1 = '';

            if (isset($b->VADETARIH)) {
                list($tar, $saat) = explode(' ', $b->VADETARIH);
                list($y, $a, $g) = explode('-', $tar);
                $bak_tar = $g . '.' . $a . '.' . $y;
            }
            ?>
            <tr style="cursor:pointer;" onclick="Goster({{$b->ISLEMTIPI}})">
                <td style="text-align: center">{{ $b->ISLEMTIP }}</td>
                <td style="text-align: center">{{ number_format($b->TUTAR,2,',','.') }}</td>
                <td style="text-align: center">{{ $b->ADET }}</td>
                <td style="text-align: center">{{ $bak_tar }}</td>
            </tr>
            <tr id="{{$b->ISLEMTIPI}}" style="display: none; background-color: #bfbfbf;">
                <td colspan="6">
                    <table class="table table-stripped table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>Belge Tipi</th>
                            <th>Belge No</th>
                            <th>Vade Tarihi</th>
                            <th>Tutar</th>
                            <th>Banka</th>
                            <th>Şube</th>
                            <th>Hesap No</th>
                            <th>Banka Belge</th>
                            <th>Borçlu</th>
                            <th>Döviz Cinsi</th>
                        </thead>
                        <tbody>
                        @foreach($detay[$b->ISLEMTIPI] as $dty)
                            <tr>
                                <td style="font-size: 10px;">{{ $dty->BELGETIPI }}</td>
                                <td style="font-size: 10px;">{{ $dty->BELGENO }}</td>
                                <td style="font-size: 10px;">{{ $dty->VADETARIH }}</td>
                                <td style="font-size: 10px;">{{ number_format($dty->BELGETUTAR,2,',','.') }}</td>
                                <td style="font-size: 10px;">{{ $dty->BNKKRT_BANKAAD }}</td>
                                <td style="font-size: 10px;">{{ $dty->SUBKRT_SUBEAD }}</td>
                                <td style="font-size: 10px;">{{ $dty->BANKAHESAPNO }}</td>
                                <td style="font-size: 10px;">{{ $dty->BANKABELGENO }}</td>
                                <td style="font-size: 10px;">{{ $dty->BORCLUTIP }}</td>
                                <td style="font-size: 10px;">{{ $dty->BELGEDOVIZCINS }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    Çek Senet Kaydı Bulunamadı.
@endif