<table class="table-auto">
    <thead>
        <tr>
            <th class="border-gray-200" valign="middle" style="text-align:center;">SCORES</th>
            <th width="80%" valign="middle" style="padding: 8px 10px;">CHARTS</th>
        </tr>
    </thead>

    @if ($datestart)
        <tbody>
            <tr>
                <td valign="middle" style="padding: 8px 10px;">


                        @php
                            $cs = 0;
                            $ctr01 = 0;
                            $ctrpro = 0;
                            $ctrdet = 0;
                            $npscore = 0;
                            $xsda = 0;
                            $xda = 0;
                            $xn = 0;
                            $xa = 0;
                            $xsa = 0;
                            $ysda = 0;
                            $yda = 0;
                            $yn = 0;
                            $ya = 0;
                            $ysa = 0;
                        @endphp

                        @foreach ($sheets as $sheets01)
                            @if (
                                $sheets01->dept == $searchVal &&
                                    date('Y-m-d', strtotime($sheets01->Date)) >= date('Y-m-d', strtotime($datestart)) &&
                                    date('Y-m-d', strtotime($sheets01->Date)) <= date('Y-m-d', strtotime($dateend)))
                                @if ($sheets01->score >= 9)
                                    @php
                                        $ctrpro = $ctrpro + 1;
                                    @endphp
                                @endif

                                @if ($sheets01->score <= 6)
                                    @php
                                        $ctrdet = $ctrdet + 1;
                                    @endphp
                                @endif

                                @php
                                    $cs = $cs + $sheets01->cs;
                                    $ctr01 = $ctr01 + 1;
                                @endphp

                                @if ($sheets01->ability == 'Awful')
                                    @php
                                        $xsda = $xsda + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->ability == 'Poor')
                                    @php
                                        $xda = $xda + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->ability == 'Ok')
                                    @php
                                        $xn = $xn + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->ability == 'Good')
                                    @php
                                        $xa = $xa + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->ability == 'Awesome')
                                    @php
                                        $xsa = $xsa + 1;
                                    @endphp
                                @endif

                                @if ($sheets01->agility == 'Awful')
                                    @php
                                        $ysda = $ysda + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->agility == 'Poor')
                                    @php
                                        $yda = $yda + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->agility == 'Ok')
                                    @php
                                        $yn = $yn + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->agility == 'Good')
                                    @php
                                        $ya = $ya + 1;
                                    @endphp
                                @endif
                                @if ($sheets01->agility == 'Awesome')
                                    @php
                                        $ysa = $ysa + 1;
                                    @endphp
                                @endif
                            @endif
                        @endforeach

                        @if ($ctr01 > 0)
                            @php
                                $ctrpro = ($ctrpro / $ctr01) * 100;
                                $ctrdet = ($ctrdet / $ctr01) * 100;
                                $npscore = $ctrpro - $ctrdet;
                                $csscore = $cs / $ctr01;
                                echo 'Responses: ' . $ctr01;
                                echo '<br>';
                                echo 'Customer Satisfaction: ' . round($csscore, 2);
                                echo '<br>';
                                echo 'Promoters: ' . round($ctrpro, 2);
                                echo '%<br>';
                                echo 'Detractors: ' . round($ctrdet, 2);
                                echo '%<br>';
                                echo 'Net Promoter Score: ' . round($npscore, 2);
                                echo '% <br><br>';
                                echo '<strong>Problem/Service was properly resolved/provided:</strong>
                    <br>Stongly Disagree: ' .
                                    $xsda .
                                    '
                    <br>Disagree: ' .
                                    $xda .
                                    '
                    <br>Neutral: ' .
                                    $xn .
                                    '<br>Agree: ' .
                                    $xa .
                                    '
                    <br>Strongly Agree: ' .
                                    $xsa .
                                    '<br><br>
                    <strong>Problem/Service was properly resolved/provided:</strong>
                    <br>Stongly Disagree: ' .
                                    $ysda .
                                    '
                    <br>Disagree: ' .
                                    $yda .
                                    '
                    <br>Neutral: ' .
                                    $yn .
                                    '
                    <br>Agree: ' .
                                    $ya .
                                    '
                    <br>Strongly Agree: ' .
                                    $ysa;
                            @endphp
                        @endif
                    </span></td>
                <td>

                    @if ($ctr01 > 0)
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

                        {{-- ACCURACY --}}

                        <canvas id="myChart1" style="width: 900px; height: 200px;"></canvas>

                        <script>
                            const xValues1 = ["Strongly Disagree", "Disagree", "Neutral", "Agree", "Strongly Agree"];
                            const yValues1 = [
                                <?php echo json_encode($xsda); ?>,
                                <?php echo json_encode($xda); ?>,
                                <?php echo json_encode($xn); ?>,
                                <?php echo json_encode($xa); ?>,
                                <?php echo json_encode($xsa); ?>
                            ];
                            const barColors1 = [
                                "#b91d47",
                                "#00aba9",
                                "#2b5797",
                                "#e8c3b9",
                                "#1e7145"
                            ];

                            new Chart("myChart1", {
                                type: "pie",
                                data: {
                                    labels: xValues1,
                                    datasets: [{
                                        backgroundColor: barColors1,
                                        data: yValues1
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Problem/Service was properly resolved/provided."
                                    }
                                }
                            });
                        </script>

                        <br>
                        {{-- SPEED --}}

                        <canvas id="myChart2" style="width: 900px; height: 200px;"></canvas>

                        <script>
                            const xValues2 = ["Strongly Disagree", "Disagree", "Neutral", "Agree", "Strongly Agree"];
                            const yValues2 = [
                                <?php echo json_encode($ysda); ?>,
                                <?php echo json_encode($yda); ?>,
                                <?php echo json_encode($yn); ?>,
                                <?php echo json_encode($ya); ?>,
                                <?php echo json_encode($ysa); ?>
                            ];
                            const barColors2 = [
                                "#b91d47",
                                "#00aba9",
                                "#2b5797",
                                "#e8c3b9",
                                "#1e7145"
                            ];

                            new Chart("myChart2", {
                                type: "pie",
                                data: {
                                    labels: xValues2,
                                    datasets: [{
                                        backgroundColor: barColors2,
                                        data: yValues2
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Problem/Service was properly resolved/provided within expected time. "
                                    }
                                }
                            });
                        </script>
                    @endif
                </td>

            </tr>
        </tbody>
    @endif
</table>
