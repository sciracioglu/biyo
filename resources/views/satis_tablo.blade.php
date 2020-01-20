@if(count($grup)>0)
        <p>Detay hareketleri görmek için satırlara tıklayabilirsiniz.</p>
        <table class="table table-stripped table-condensed table-hover">
            <thead>
                <th style="text-align: center;">Evrak Yil/Ay</th>
                <th style="text-align: center;">Tutar</th>
                <th style="text-align: center;">Iskonto</th>
                <th style="text-align: center;">KDV</th>
                <th style="text-align: center;">Net Tutar</th>
                <th style="text-align: center;">Toplam</th>
            </thead>
            <tbody>

                @foreach($grup as $g)
                    <tr style="cursor:pointer;" onclick="Goster({{$g->EVRAKYIL}}{{$g->EVRAKAY}})">
                        <td style="text-align: center;">{{ $g->EVRAKYIL }} / {{ $g->EVRAKAY }}</td>
                        <td style="text-align:right;">{{ number_format($g->DOVIZTUTAR,2,',','.') }}</td>
                        <td style="text-align:right;">{{ number_format($g->DOVIZISKONTO,2,',','.') }}</td>
                        <td style="text-align:right;">{{ number_format($g->DOVIZKDV,2,',','.') }}</td>
                        <td style="text-align:right;">{{ number_format($g->DOVIZNETTUTAR,2,',','.') }}</td>
                        <td style="text-align:right;">{{ number_format($g->DOVIZTOPLAM,2,',','.') }}</td>
                    </tr>

                    <tr id="{{$g->EVRAKYIL.$g->EVRAKAY}}" style="display: none; background-color: #bfbfbf;">
                        <td colspan="6">
                            <table class="table table-stripped table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>Evrak Tipi</th>
                                    <th>Evrak No</th>
                                    <th>Evrak Tarihi</th>
                                    <th>Mal Kodu</th>
                                    <th>Mal Adı</th>
                                    <th>Miktar</th>
                                    <th>Fiyat</th>
                                    <th>Tutar</th>
                                    <th>İskonto</th>
                                    <th>Net Tutar</th>
                                    <th>KDV</th>
                                    <th>Toplam</th>

                                </thead>
                                <tbody>
                                @foreach($detay[$g->EVRAKYIL][$g->EVRAKAY] as $r)
                                    <?php

                                    list($tar, $saat) = explode(' ', $r->EVRAKTARIH);
                                    list($y, $a, $g) = explode('-', $tar);

                                    ?>
                                    <tr>
                                        <td style="font-size: 10px;">{{ $r->EVRAKTIPI }}</td>
                                        <td style="font-size: 10px;">{{ $r->EVRAKNO }}</td>
                                        <td style="font-size: 10px;">{{ $g }}.{{ $a }}.{{ $y }}</td>
                                        <td style="font-size: 10px;">{{ $r->MALKOD }}</td>
                                        <td style="font-size: 10px;">{{ $r->MALAD }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ $r->MIKTAR }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($r->FIYAT,2,',','.') }}</td>

                                        <td style="text-align: right;font-size: 10px;">{{ number_format($r->DOVIZTUTAR,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($r->DOVIZISKONTO,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($r->_DOVIZNETTUTAR,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($r->DOVIZKDV,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($r->_DOVIZTOPLAM,2,',','.') }}</td>

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
        Satış Raporu kaydı bulunamadı.
    @endif