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
                                        <td style="font-size: 10px;">{{ $detay->STKKRT_MALAD }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Ocak_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Subat_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Mart_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Nisan_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Mayis_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Haziran_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Temmuz_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Agustos_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Eylul_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Ekim_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Kasim_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Aralik_Net_Satis,2,',','.') }}</td>
                                        <td style="text-align: right;font-size: 10px;">{{ number_format($detay->Toplam_Net_Satis,2,',','.') }}</td>

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