<form action="{{ route('responses.index') }}" method="GET">
        <input type="date" name="datestart" value="{{ $datestart }}" class="form-control"
            placeholder="" required>
        <input type="date" name="dateend" value="{{ $dateend }}" class="form-control"
            placeholder="" required>
        <span class="input-group-text">
            <button type="submit" class="btn btn-xs">
                <i class="icon fs-6 bi bi-search"></i>
            </button>
        </span>
</form>