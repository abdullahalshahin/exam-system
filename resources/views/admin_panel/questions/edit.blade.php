<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Question Edit' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/questions') }}"> Question List </a></li>
                            <li class="breadcrumb-item active"> Question Edit </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Question Edit </h4>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input. <br><br>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <form action="{{ url('admin-panel/dashboard/questions', $question->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
        
                                @include('admin_panel.questions.form')
        
                                <div class="modal-footer">
                                    <a href="{{ url('admin-panel/dashboard/questions') }}" class="btn btn-primary"> Go Back </a>
                                    <button type="submit" class="btn btn-success"> Save </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function() {
                $('#type').on('change', function() {
                    let type = this.value;
                    let options_container = $('#options')

                    switch (type) {
                        case 'SAQ':
                            options_container.html(`
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
                                        </select>
                                    </div>
                                </div>
                            `);
                            
                            break;

                        case 'MCQ':
                            options_container.html(`
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
                                    <div class="mb-3 col-md-6">
                                        <label for="option_e"> Option E </label>
                                        <input type="text" name="option_e" value="{{ old('option_e', $question->option_e ?? '') }}" class="form-control" id="option_e" placeholder="" required>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="correct_answer"> Correct Answer </label>
                                        <input type="text" name="correct_answer" value="{{ old('correct_answer', $question->correct_answer ?? '') }}" class="form-control" id="correct_answer" placeholder="" required>
                                    </div>
                                </div>
                            `);

                            break;
                    
                        case 'BOOLEAN':
                            options_container.html(`
                                <div class="row">
                                    <div class="mb-3 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="correct_answer_true" name="correct_answer" value="true" class="form-check-input">
                                            <label class="form-check-label" for="correct_answer_true"> True </label>
                                        </div>
                                    </div>
                                
                                    <div class="mb-3 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="correct_answer_false" name="correct_answer" value="false" class="form-check-input">
                                            <label class="form-check-label" for="correct_answer_false"> False </label>
                                        </div>
                                    </div>
                                </div>
                            `);

                            break;

                        case 'SORT_QUESTION':
                            options_container.html(`
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="correct_answer">Correct Answer</label>
                                        <textarea name="correct_answer" class="form-control" id="correct_answer" rows="4">{{ old('correct_answer', $question->correct_answer ?? '') }}</textarea>
                                    </div>
                                </div>
                            `);

                            break;

                        default:
                            options_container.html(``);

                            break;
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
