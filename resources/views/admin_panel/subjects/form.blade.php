<div class="row g-2">
    <div class="mb-3 col-md-8">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $subject->name ?? '') }}" class="form-control" id="name" placeholder="" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="code">Code</label>
        <input type="text" name="code" value="{{ old('code', $subject->code ?? '') }}" class="form-control" id="code" placeholder="" required {{ Request::segment(5) == "edit" ? "disabled" : "" }}>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-8">
        <label for="total_mark">Total Mark</label>
        <input type="text" name="total_mark" value="{{ old('total_mark', $subject->total_mark ?? '') }}" class="form-control" id="total_mark" placeholder="" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="total_credit">Total Credit</label>
        <input type="text" name="total_credit" value="{{ old('total_credit', $subject->total_credit ?? '') }}" class="form-control" id="total_credit" placeholder="" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-3 col-md-4">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="" selected disabled> Choose Status </option>
            <option value="Active" {{ (old('inputState') ?? ($subject->status ?? '')) == "Active" ? 'selected' : '' }}> Active </option>
            <option value="Inactive" {{ (old('inputState') ?? ($subject->status ?? '')) == "Inactive" ? 'selected' : '' }}> Inactive </option>
        </select>
    </div>
</div>
