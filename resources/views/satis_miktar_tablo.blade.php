@if(count($yillar)>0)
            <p>Detay hareketleri görmek için satırlara tıklayabilirsiniz.</p>
            <table class="table table-stripped table-condensed table-hover">
                <thead>
                <th style="text-align: center;">Evrak Yıl</th>
                </thead>
                <tbody>

                @foreach($yillar as $yil)
                    <tr style="cursor:pointer;" onclick="Goster({{$yil->EVRAKYIL}})">
                        <td style="text-align: center;">{{ $yil->EVRAKYIL }}</td>
                    </tr>

                    <tr id="{{$yil->EVRAKYIL}}" style="display: none; background-color: #bfbfbf;">
                        <td colspan="6">
                            <table class="table table-stripped table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>Mal Kodu</th>
                                    <th>Mal Adı</th>
                                    <th>Ocak</th>
                                    <th>Şubat</th>
                                    <th>Mart</th>
                                    <th>Nisan</th>
                                    <th>Mayıs</th>
                                    <th>Haziran</th>
                                    <th>Temmuz</th>
                                    <th>Ağustos</th>
                                    <th>Eylül</th>
                                    <th>Ekim</th>
                                    <th>Kasım</th>
                                    <th>Aralık</th>
                                    <th>Toplam</th>
                                </thead>
                                <tbody>
                                @foreach($analiz[$yil->EVRAKYIL] as $detay)
                                    <tr>
                                        <td style="font-size: 10px;">{{ $detay->MALKOD }}</td>
                                        <td style="font-size: 10px;">{{ $detay->MALAD }} ({{ $detay->BIRIM }})</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->OCAK_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->SUBAT_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->MART_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->NISAN_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->MAYIS_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->HAZIRAN_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->TEMMUZ_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->AGUSTOS_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->EYLUL_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->EKIM_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->KASIM_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->ARALIK_MIKTAR,0,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->TOPLAM_MIKTAR,0,',','.') }}</td>
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