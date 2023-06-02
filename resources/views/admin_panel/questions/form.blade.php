<div class="row">
    <div class="mb-3 col-md-6">
        <label for="subject_id"> Subject </label>
        <select id="subject_id" name="subject_id" class="form-select" required>
            <option value="" selected disabled> Choose Subject </option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" {{ (old('subject_id') ?? ($question->subject_id ?? '')) == $subject->id ? 'selected' : '' }}>
                    {{ $subject->name ?? "" }} - {{ $subject->code ?? "" }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="type">Type</label>
        <select id="type" name="type" class="form-select">
            <option value="" selected disabled> Choose Type </option>
            <option value="SAQ" {{ (old('type') ?? ($question->type ?? '')) == "SAQ" ? 'selected' : '' }}> SAQ </option>
            <option value="MCQ" {{ (old('type') ?? ($question->type ?? '')) == "MCQ" ? 'selected' : '' }}> MCQ </option>
            <option value="BOOLEAN" {{ (old('type') ?? ($question->type ?? '')) == "BOOLEAN" ? 'selected' : '' }}> True Or False </option>
            <option value="SORT_QUESTION" {{ (old('type') ?? ($question->type ?? '')) == "SORT_QUESTION" ? 'selected' : '' }}> Sort Question </option>
        </select>
    </div>
</div>

<div class="row">
    <div class="mb-2 col-md-12">
        <label for="title"> Title </label>
        <input type="text" name="title" value="{{ old('title', $question->title ?? '') }}" class="form-control" id="title" placeholder="" required>
    </div>
</div>

<div class="row">
    <div class="mb-2 col-md-6">
        <label for="option_a"> Option A </label>
        <input type="text" name="option_a" value="{{ old('option_a', $question->option_a ?? '') }}" class="form-control" id="option_a" placeholder="" required>
    </div>

    <div class="mb-2 col-md-6">
        <label for="option_b"> Option B </label>
        <input type="text" name="option_b" value="{{ old('option_b', $question->option_b ?? '') }}" class="form-control" id="option_b" placeholder="" required>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-6">
        <label for="option_c"> Option C </label>
        <input type="text" name="option_c" value="{{ old('option_c', $question->option_c ?? '') }}" class="form-control" id="option_c" placeholder="" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="option_d"> Option D </label>
        <input type="text" name="option_d" value="{{ old('option_d', $question->option_d ?? '') }}" class="form-control" id="option_d" placeholder="" required>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-3">
        <label for="correct_answer">Correct Answer</label>
        <select id="correct_answer" name="correct_answer" class="form-select" required>
            <option value="" selected disabled> Choose Correct Answer </option>
            <option value="A" {{ (old('correct_answer') ?? ($question->correct_answer ?? '')) == "A" ? 'selected' : '' }}> A </option>
            <option value="B" {{ (old('correct_answer') ?? ($question->correct_answer ?? '')) == "B" ? 'selected' : '' }}> B </option>
            <option value="C" {{ (old('correct_answer') ?? ($question->correct_answer ?? '')) == "C" ? 'selected' : '' }}> C </option>
            <option value="D" {{ (old('correct_answer') ?? ($question->correct_answer ?? '')) == "D" ? 'selected' : '' }}> D </option>
            {{-- <option value="E" {{ (old('correct_answer') ?? ($question->correct_answer ?? '')) == "E" ? 'selected' : '' }}> E </option> --}}
        </select>
    </div>

    <div class="mb-3 col-md-9">
        <label for="reference"> Reference </label>
        <input type="text" name="reference" value="{{ old('reference', $question->reference ?? '') }}" class="form-control" id="reference" placeholder="">
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <label for="description	">Description</label>
        <textarea name="description" class="form-control" id="description" rows="6">{{ old('description', $question->description ?? '') }}</textarea>
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-4">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="" selected disabled> Choose Status </option>
            <option value="Active" {{ (old('inputState') ?? ($question->status ?? '')) == "Active" ? 'selected' : '' }}> Active </option>
            <option value="Inactive" {{ (old('inputState') ?? ($question->status ?? '')) == "Inactive" ? 'selected' : '' }}> Inactive </option>
        </select>
    </div>
</div>
