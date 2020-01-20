<div class="row">
    <div class="col-md-12">
        @if(count($cari)>0)

            <table class="table table-stripped table-condensed table-hover">
                <thead>
                <tr>
                    <th>Evrak Tipi</th>
                    <th>Evrak Tarihi</th>
                    <th>Vade Tarihi</th>
                    <th>Evrak No</th>
                    <th>Açıklama</th>
                    <th>Borç</th>
                    <th>Alacak</th>
                    <th>Bakiye</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cari as $s)
                    <?php
                    $color = 'red';
                    $tip = 'B';
                    if($s->BAKIYE < 0){
                        $color = 'blue';
                        $tip   = 'A';
                    }
                    if($s->BAKIYE == 0){
                        $color = 'black';
                        $tip   = '';
                    }
                    $dcolor = 'blue';
                    if($s->DOVIZBAKIYE<0){
                        $dcolor = 'red';
                    }

                    list($tar, $saat) = explode(' ', $s->EVRAKTARIH);
                    list($y, $a, $g) = explode('-', $tar);

                    list($tar, $saat) = explode(' ', $s->VADETARIH);
                    list($y1, $a1, $g1) = explode('-', $tar);

                    $evraktip = Session::get('evraktip');
                    $baslik = '';
                    if($s->EVRAKTIP>0)
                        $baslik = $evraktip[$s->EVRAKTIP];
                    if($s->EVRAKTIP == 120)
                        $baslik = 'Kredi Karti Tahsilati';



                    $cins = $s->DOVIZCINS;
                    if($s->DOVIZCINS == ''){
                        $cins = 'TL';
                    }
                    $renk = '';
                    if($cins == 'TL'){
                        $renk = '#000';
                    }
                    if($cins == 'USD'){
                        $renk = '#CF0404';
                    }
                    if($cins == 'EUR'){
                        $renk = '#2187ED';
                    }
                    ?>
                    <tr>
                        <td style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ $baslik }}</td>
                        <td style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ $g.'.'.$a.'.'.$y }}</td>
                        <td style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ $g1.'.'.$a1.'.'.$y1 }}</td>
                        <td style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ $s->EVRAKNO }}</td>
                        <td style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ $s->ACIKLAMA }}</td>
                        {{--<td style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ $cins }}</td>--}}
                        {{--<td class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ number_format($s->DOVIZKUR,4,',','.') }}</td>--}}
                        {{--<td class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ number_format($s->TUTAR,2,',','.') }}</td>--}}
                        <td class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ number_format($s->BORC,2,',','.') }}</td>
                        <td class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ number_format($s->ALACAK,2,',','.') }}</td>
                        <td class="text-right" style="color:{{ $color }}; border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{ number_format($s->BAKIYE,2,',','.') }} {{ $tip }}</td>
                        {{--<td  class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{  number_format($s->DOVIZBORC,2,',','.') }}</td>--}}
                        {{--<td class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px;">{{  number_format($s->DOVIZALACAK,2,',','.') }}</td>--}}
                        {{--<td class="text-right" style="border-bottom:solid 1px {{ $renk }}; font-size: 10px; color:{{ $dcolor }}">{{  number_format($s->DOVIZBAKIYE,2,',','.') }}</td>--}}

                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            Cari kaydı bulunamadı.
        @endif
    </div>

</div>