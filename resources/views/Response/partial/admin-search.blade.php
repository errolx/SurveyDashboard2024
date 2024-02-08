<form action="{{ route('responses.index') }}" method="GET">
    <div class="input-group me-2 me-lg-3 fmxw-400">
Department:
            <input type="text" name="search" value="{{ $searchVal }}" class="form-control" placeholder="Department"
                required>

            Start Date:
            <input type="date" name="datestart" value="{{ $datestart }}" class="form-control" placeholder=""
                required>
            End Date:
            <input type="date" name="dateend" value="{{ $dateend }}" class="form-control" placeholder=""
                required>

        <x-primary-button class="ms-3">
            {{ __('search') }}
        </x-primary-button>
    </div>
</form>
