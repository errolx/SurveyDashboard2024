<form action="{{ route('responses.index') }}" method="GET">
    <label>

            Start Date:
            <input type="date" name="datestart" value="{{ $datestart }}" class="form-control" placeholder="" required>
            End Date:
            <input type="date" name="dateend" value="{{ $dateend }}" class="form-control" placeholder="" required>
        <x-primary-button class="ms-3">
            {{ __('search') }}
        </x-primary-button>
</form>
