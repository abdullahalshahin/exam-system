<div class="row">
    <div class="col-md-3"></div>

    <div class="mb-2 col-md-6">
        <input type="text" name="name" value="{{ old('name', $exam_paper->name ?? '') }}" class="form-control form-control-light text-center" id="name" placeholder="Exam Paper Name" required>
    </div>

    <div class="col-md-3"></div>
</div>

<div class="row">
    <div class="col-md-4"></div>

    <div class="mb-2 col-md-4">
        <select id="subject_id" name="subject_id" class="form-select form-control-light text-center" required>
            <option value="" selected disabled> Choose Subject </option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" {{ (old('subject_id') ?? ($exam_paper->subject_id ?? '')) == $subject->id ? 'selected' : '' }}>
                    {{ $subject->name ?? "" }} - {{ $subject->code ?? "" }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-2"></div>

    <div class="mb-2 col-md-8">
        <textarea name="description" id="description" class="form-control form-control-light text-center" rows="3">{{ old('description', $exam_paper->description ?? '') }}</textarea>
    </div>

    <div class="col-md-2"></div>
</div>

<div class="row">
    <div class="mb-2 col-md-4">
        <label for="date_and_time"> Date & Time </label>
        <input type="datetime-local" name="date_and_time" value="{{ old('date_and_time', $exam_paper->date_and_time ?? '') }}" class="form-control form-control-light" id="date_and_time" required>
    </div>
    
    <div class="mb-2 col-md-4">
        <label for="end_date_and_time"> End Date & Time </label>
        <input type="datetime-local" name="end_date_and_time" value="{{ old('end_date_and_time', $exam_paper->end_date_and_time ?? '') }}" class="form-control form-control-light" id="end_date_and_time" required>
    </div>
    
    <div class="mb-2 col-md-2">
        <label for="duration"> Duration (Minute)</label>
        <input type="number" name="duration" value="{{ old('duration', $exam_paper->duration ?? '') }}" class="form-control form-control-light" id="duration" required>
    </div>
    
    <div class="mb-2 col-md-2">
        <label for="total_mark"> Total Mark </label>
        <input type="number" name="total_mark" value="{{ old('total_mark', $exam_paper->total_mark ?? '') }}" class="form-control form-control-light" id="total_mark" required>
    </div>
    
    <div class="mb-2 col-md-2">
        <label for="per_question_mark"> Per Question Mark </label>
        <input type="text" name="per_question_mark" value="{{ old('per_question_mark', $exam_paper->per_question_mark ?? '') }}" class="form-control form-control-light" id="per_question_mark" required>
    </div>
    
    <div class="mb-2 col-md-2">
        <label for="per_question_negative_mark"> Per Question Negative Mark </label>
        <input type="text" name="per_question_negative_mark" value="{{ old('per_question_negative_mark', $exam_paper->per_question_negative_mark ?? '') }}" class="form-control form-control-light" id="per_question_negative_mark" required>
    </div>
</div>

<div class="row">
    <div class="mb-2 col-md-4">
        <label for="result_publish_time"> Result Publish Time </label>
        <input type="datetime-local" name="result_publish_time" value="{{ old('result_publish_time', $exam_paper->result_publish_time ?? '') }}" class="form-control form-control-light" id="result_publish_time" required>
    </div>

    <div class="mb-2 col-md-4">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="" selected disabled> Choose Status </option>
            <option value="Active" {{ (old('inputState') ?? ($exam_paper->status ?? '')) == "Active" ? 'selected' : '' }}> Active </option>
            <option value="Inactive" {{ (old('inputState') ?? ($exam_paper->status ?? '')) == "Inactive" ? 'selected' : '' }}> Inactive </option>
        </select>
    </div>
</div>

<div class="row">
    @forelse ($questions as $question)
        <div class="col-lg-6 col-xxl-3">
            <div class="border p-3 rounded mb-3 mb-md-0">
                <div class="form-check">
                    <input type="checkbox" id="question_id_{{ $question->id }}" name="selected_questions[]" value="{{ $question->id }}" class="form-check-input" {{ in_array($question->id, $assigned_question_ids) ? 'checked' : '' }}>
                    <label class="form-check-label font-16 fw-bold" for="question_id_{{ $question->id }}">{{ $question->title ?? "" }}</label>
                </div>

                <p class="m-0 p-0">A. {{ $question->option_a ?? "" }}</p>
                <p class="m-0 p-0">B. {{ $question->option_b ?? "" }}</p>
                <p class="m-0 p-0">C. {{ $question->option_c ?? "" }}</p>
                <p class="m-0 p-0">D. {{ $question->option_d ?? "" }}</p>
                @if ($question->option_e)
                    <p class="m-0 p-0">E. {{ $question->option_e ?? "" }}</p>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center">Question Not Found !!!</p>
    @endforelse
</div>