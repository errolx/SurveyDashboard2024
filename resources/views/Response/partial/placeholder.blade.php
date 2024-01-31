<x-app-layout>

    {{-- per page status --}}
    @if (session('status'))
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif

    @if (Auth::user()->role == 'Admin')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-md-0">
                {{-- <h2class="h4">Department:Auth::user()->dept </h2> --}}
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <i class="icon icon-xs me-2 bi bi-plus-lg"></i>
                    Add User
                </a>
            </div>
        </div>
    @endif


    @if (Auth::user()->role == 'viewer')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <h1>Department: {{ Auth::user()->dept }}</h1>
        </div>

        <div class="table-settings mb-4">
            <div class="row align-items-center justify-content-between">
                <div class="col col-md-6 col-lg-3 col-xl-4">
                    <form action="{{ route('responses.index') }}" method="GET">
                        <div class="input-group me-2 me-lg-3 fmxw-400">
                            <input type="date" name="datestart" value="{{ $datestart }}" class="form-control"
                                placeholder="" required>
                            <input type="date" name="dateend" value="{{ $dateend }}" class="form-control"
                                placeholder="" required>
                            <span class="input-group-text">
                                <button type="submit" class="btn btn-xs">
                                    <i class="icon fs-6 bi bi-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($datestart)
            <div class="card card-body border-0 shadow table-wrapper table-responsive mb-5">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200" valign="middle" style="text-align:center;">SCORES</th>
                            <th class="border-gray-200" valign="middle" style="text-align:center;">CHARTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td valign="middle"><span class="fw-normal">


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
                                        @if ($sheets01->dept)
                                            @if (date('Y-m-d', strtotime($sheets01->Date)) >= date('Y-m-d', strtotime($datestart)) &&
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
                                        @endif
                                    @endforeach

                                    @if ($ctr01 > 0)
                                        @php
                                            $ctrpro = ($ctrpro / $ctr01) * 100;
                                            $ctrdet = ($ctrdet / $ctr01) * 100;
                                            $npscore = $ctrpro - $ctrdet;
                                            $csscore = $cs / $ctr01;
                                            echo 'Responses: <h4>' . $ctr01 . '</h4>';
                                            echo 'Customer Satisfaction:  <h4>' . round($csscore, 2) . '</h4>';
                                            echo 'Promoters:  <h4>' . round($ctrpro, 2) . '%</h4>';
                                            echo 'Detractors:  <h4>' . round($ctrdet, 2) . '%</h4>';
                                            echo 'Net Promoter Score:  <h4>' . round($npscore, 2) . '%</h4>';
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
                            <td valign="middle">

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
                </table>
            </div>
        @endif


        <div class="card card-body border-0 shadow table-wrapper table-responsive mb-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="border-gray-200" valign="middle">Date</th>
                        <th class="border-gray-200" valign="middle">Department</th>
                        {{--
                    <th class="border-gray-200" valign="middle">Customer<br>Satisfaction</th>
                    <th class="border-gray-200" valign="middle">Net Promoter<br>Score</th>
                    <th class="border-gray-200" valign="middle">Accuracy</th>
                    <th class="border-gray-200" valign="middle">Speed</th> --}}
                        <th class="border-gray-200" valign="middle">Comments</th>
                        <th class="border-gray-200" valign="middle">Respondent</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($sheets as $sheets)
                        @if ($sheets->dept)
                            @if (date('Y-m-d', strtotime($sheets->Date)) >= date('Y-m-d', strtotime($datestart)) &&
                                    date('Y-m-d', strtotime($sheets->Date)) <= date('Y-m-d', strtotime($dateend)) &&
                                    $sheets->comments)
                                <tr>
                                    <td valign="middle"><span
                                            class="fw-normal">{{ date('Y-m-d', strtotime($sheets->Date)) }}</span></td>
                                    <td valign="middle"><span class="fw-normal">{{ $sheets->dept }}</span></td>
                                    {{--
                                <td valign="middle"><span class="fw-normal">{{ $sheets->cs }}</span></td>
                                <td valign="middle"><span class="fw-normal">{{ $sheets->score }}</span></td>
                                <td valign="middle"><span class="fw-normal">{{ $sheets->ability }}</span></td>
                                <td valign="middle"><span class="fw-normal">{{ $sheets->agility }}</span></td> --}}
                                    <td valign="middle">
                                        <p style="word-break: normal; white-space: normal;"><span
                                                class="fw-normal">{{ $sheets->comments }}</p></span>
                                    </td>
                                    <td valign="middle"><span class="fw-normal">{{ $sheets->respondent }}</span></td>

                                </tr>
                            @endif
                        @endif
                    @empty
                        <tr class="text-center">
                            <td colspan="5">No data.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div
                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">

                {{-- pagination --}}
                {{-- $sheets->links('vendor.pagination.bootstrap-5') --}}

            </div>

        </div>
    @endif

    @if (Auth::user()->role == 'Admin')
        <div class="table-settings mb-4">
            <div class="row align-items-center justify-content-between">
                <div class="col col-md-6 col-lg-3 col-xl-4">
                    <form action="{{ route('responses.index') }}" method="GET">
                        <div class="input-group me-2 me-lg-3 fmxw-400">
                            <input type="text" name="search" value="{{ $searchVal }}" class="form-control"
                                placeholder="Department" required>
                            <input type="date" name="datestart" value="{{ $datestart }}" class="form-control"
                                placeholder="" required>
                            <input type="date" name="dateend" value="{{ $dateend }}" class="form-control"
                                placeholder="" required>
                            <span class="input-group-text">
                                <button type="submit" class="btn btn-xs">
                                    <i class="icon fs-6 bi bi-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($datestart)

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                Department: {{ $searchVal }}
            </div>

            <div class="card card-body border-0 shadow table-wrapper table-responsive mb-5">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200" valign="middle" style="text-align:center;">SCORES</th>
                            <th class="border-gray-200" valign="middle" style="text-align:center;">CHARTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td valign="middle"><span class="fw-normal">


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
                                        @if ($sheets01->dept)
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
                                            echo 'Customer Satisfaction: ' . $csscore;
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
                            <td valign="middle">

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
                </table>
            </div>
        @endif


        <div class="card card-body border-0 shadow table-wrapper table-responsive mb-5">
            <table style="width: 100%; display: table; table-layout: fixed;" class="table-auto">
                <thead>
                    <tr>
                        <th class="border-gray-200" valign="middle">Date</th>
                        <th class="border-gray-200" valign="middle">Department</th>
                        {{--
                    <th class="border-gray-200" valign="middle">Customer<br>Satisfaction</th>
                    <th class="border-gray-200" valign="middle">Net Promoter<br>Score</th>
                    <th class="border-gray-200" valign="middle">Accuracy</th>
                    <th class="border-gray-200" valign="middle">Speed</th> --}}
                        <th class="border-gray-200" valign="middle">Comments</th>
                        <th class="border-gray-200" valign="middle">Respondent</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($sheets as $sheets02)
                        @if ($sheets02->dept)
                            @if (
                                $sheets02->dept == $searchVal &&
                                    date('Y-m-d', strtotime($sheets02->Date)) >= date('Y-m-d', strtotime($datestart)) &&
                                    date('Y-m-d', strtotime($sheets02->Date)) <= date('Y-m-d', strtotime($dateend)) &&
                                    $sheets02->comments)
                                <tr>
                                    <td valign="middle"><span
                                            class="fw-normal">{{ date('Y-m-d', strtotime($sheets02->Date)) }}</span>
                                    </td>
                                    <td valign="middle"><span class="fw-normal">{{ $sheets02->dept }}</span></td>
                                    {{--
                                <td valign="middle"><span class="fw-normal">{{ $sheets->cs }}</span></td>
                                <td valign="middle"><span class="fw-normal">{{ $sheets->score }}</span></td>
                                <td valign="middle"><span class="fw-normal">{{ $sheets->ability }}</span></td>
                                <td valign="middle"><span class="fw-normal">{{ $sheets->agility }}</span></td> --}}
                                    <td valign="middle">
                                        <p style="word-break: normal; white-space: normal;"><span
                                                class="fw-normal">{{ $sheets02->comments }}</p></span>
                                    </td>
                                    <td valign="middle"><span class="fw-normal">{{ $sheets02->respondent }}</span>
                                    </td>

                                </tr>
                            @endif
                        @endif
                    @empty
                        <tr class="text-center">
                            <td colspan="5">No data.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div
                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">

                {{-- pagination --}}
                {{-- $sheets->links('vendor.pagination.bootstrap-5') --}}

            </div>

        </div>
    @endif

</x-app-layout>
