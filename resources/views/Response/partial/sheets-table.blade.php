<table style="width: 100%; display: table; table-layout: auto;" class="table-auto">
    <thead>
        <tr>
            <th valign="middle" style="padding: 8px 10px;">Date</th>

            @if (Auth::user()->role == 'Admin')
                <th style="padding: 8px 10px;" valign="middle">Department</th>
            @endif

            <th style="padding: 8px 10px;" valign="middle">Respondent</th>
            <th  width="30%" style="padding: 8px 10px;" valign="middle">Comments</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($sheets as $sheets02)
            @if (
                $sheets02->dept == $searchVal &&
                    date('Y-m-d', strtotime($sheets02->Date)) >= date('Y-m-d', strtotime($datestart)) &&
                    date('Y-m-d', strtotime($sheets02->Date)) <= date('Y-m-d', strtotime($dateend)) &&
                    $sheets02->comments)
                <tr>
                    <td valign="middle" style="text-align:center; padding: 8px 10px;border: 1px solid black;"><span class="fw-normal"> {{ date('Y-m-d', strtotime($sheets02->Date)) }} </span>
                    </td>

                    @if (Auth::user()->role == 'Admin')
                        <td valign="middle" style="text-align:center; padding: 8px 10px;border: 1px solid black;"><span class="fw-normal">{{ $sheets02->dept }}</span></td>
                    @endif
                    
                    <td valign="middle" style="text-align:center; padding: 8px 10px;border: 1px solid black;"><span class="fw-normal">{{ $sheets02->respondent }}</span>
                    </td>

                    <td  width="70%" valign="middle" style="padding: 8px 10px;border: 1px solid black;">
                        <p style="word-break: normal; white-space: normal;"><span
                                class="fw-normal">{{ $sheets02->comments }}</p></span>
                    </td>

                </tr>
            @endif
        @empty
            <tr class="text-center">
                <td colspan="5">No data.</td>
            </tr>
        @endforelse

    </tbody>
</table>
