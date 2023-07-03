<x-layout>
    <div class="shadow p-3 bg-body-tertiary logo">
        <img src="{{ asset('/resources/SD_logo.svg') }}" alt="logo" />
    </div>

    {{-- @dd($studiepunten) --}}
    <div class="d-flex justify-content-center align-items-center overflow-hidden" style="height: 100vh">
        <div class="card m-1 studiepuntencard shadow">
            <div class="card-body overflow-auto m-3 p-0">
                <table class=" studiepuntenTable text-center align-middle" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="studiepuntenTablehead celBorder-top celBorder-bottom celBorder-left"
                                style="width: 4%" rowspan="2">Vakken
                            </th>
                            <th class="studiepuntenTablehead celBorder-top celBorder-bottom "style="width: 4%"
                                rowspan="2">F-code</th>
                            <th class="studiepuntenTablehead celBorder-top celBorder-bottom" style="width: 4%"
                                rowspan="2">Week</th>
                            <th class="studiepuntenTablehead celBorder-top celBorder-bottom" style="width: 4%"
                                rowspan="2">Punten</th>
                            <th class="studiepuntenTablehead celBorder-top celBorder-left" style="width: 4%">A</th>
                            <th class="studiepuntenTablehead celBorder-top celBorder-right" style="width: 4%">B</th>
                            <th class="studiepuntenTablehead celBorder-top celBorder-bottom celBorder-right"
                                rowspan="2" style="width: 5%">C</th>
                        </tr>
                        <tr>
                            @php
                                $behaalde_a_punten = $studiepunten->behaalde_a_punten / $studiepunten->totaal_a_punten;
                                $behaalde_b_punten = $studiepunten->behaalde_b_punten / $studiepunten->totaal_b_punten;
                                
                            @endphp
                            <th
                                class="studiepuntenTablehead celBorder-bottom celBorder-left -bottom-3
                                {{ $behaalde_a_punten < 0.79 ? 'redpoint' : '' }}
                                {{ $behaalde_a_punten >= 0.8 && $behaalde_a_punten < 0.98 ? 'orangepoint' : '' }}
                                {{ $behaalde_a_punten >= 0.98 ? 'greenpoint' : '' }}
                            ">
                                {{ $studiepunten->behaalde_a_punten }}/{{ $studiepunten->totaal_a_punten }}</th>
                            <th
                                class="studiepuntenTablehead celBorder-bottom celBorder-right
                                {{ $behaalde_b_punten <= 0.79 ? 'redpoint' : '' }}
                                {{ $behaalde_b_punten >= 0.8 && $behaalde_b_punten <= 0.97 ? 'orangepoint' : '' }}
                                {{ $behaalde_b_punten >= 0.98 ? 'greenpoint' : '' }}">
                                {{ $studiepunten->behaalde_b_punten }}/{{ $studiepunten->totaal_b_punten }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studiepunten->vakken as $key => $vak)
                            @php
                                $even = $loop->even;
                            @endphp
                            @foreach ($vak->fb as $fb)
                                @php
                                    $nietInGevuld = $fb->behaalde_a_punten <= -1;
                                @endphp
                                <tr class="{{ $even ? '' : 'rowcolor' }}">
                                    @if ($loop->index < 1)
                                        <th class="celBorder-top celBorder-left rowvak" scope="col-1"
                                            rowspan="{{ count($vak->fb) }}">
                                            {{ $key }}</th>
                                        <th class="celBorder-top {{ $nietInGevuld ? 'nopoints' : '' }}">
                                            {{ $fb->f_code }}</th>
                                        <th class="celBorder-top {{ $nietInGevuld ? 'nopoints' : '' }}">
                                            {{ $fb->week }}</th>
                                        <th class="celBorder-top {{ $nietInGevuld ? 'nopoints' : '' }}">
                                            {{ $fb->totaal_a_punten }}</th>
                                        <td
                                            class="celBorder-top celBorder-left {{ $fb->behaalde_a_punten <= 0 ? 'zero' : '' }}">
                                            {{ $fb->behaalde_a_punten }}</td>
                                        <td class="celBorder-top celBorder-right" rowspan="{{ count($vak->fb) }}">
                                            {{ $vak->behaalde_b_punten }}</td>
                                        <td class="celBorder-top " rowspan="{{ count($vak->fb) }}">
                                            {{ $studiepunten->behaalde_c_punten }}
                                        </td>
                                    @else
                                        <th class="celBorder {{ $nietInGevuld ? 'nopoints' : '' }}">
                                            {{ $fb->f_code }}</th>
                                        <th class="celBorder {{ $nietInGevuld ? 'nopoints' : '' }}">
                                            {{ $fb->week }}</th>
                                        <th class="celBorder {{ $nietInGevuld ? 'nopoints' : '' }}">
                                            {{ $fb->totaal_a_punten }}</th>
                                        <td
                                            class="celBorder celBorder-left
                                        {{ $fb->behaalde_a_punten <= 0 ? 'zero' : '' }}
                                        ">
                                            {{ $fb->behaalde_a_punten }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-layout>
