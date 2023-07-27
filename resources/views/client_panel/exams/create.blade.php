<x-client-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Exam' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard/exams') }}"> Exams </a></li>
                            <li class="breadcrumb-item active"> Exam Write </li>
                        </ol>
                    </div>

                    <h4 class="page-title"><span id="countdown_time">{{ $exam_property_data["reminder_time"] ?? "00:00:00" }}</span> Minutes</h4>
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
                            <form action="{{ url('client-panel/dashboard/exams', $exam->id) }}" method="POST" enctype="multipart/form-data" id="answer_paper">
                                @csrf

                                <div class="text-center">
                                    <p class="text-center h3">{{ $exam->name ?? ""}}</p>

                                    <p class="text-center p-0 m-0">{{ $exam->subject->name ?? ""}}</p>

                                    <p class="text-center">{{ $exam->description ?? ""}}</p>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-md-start">
                                            <p class="m-0 p-0"><b>Duration: </b> {{ $exam->duration ?? "0" }} Minutes</p>
                                            <p class="m-0 p-0"><b>Total Mark: </b> {{ $exam->total_mark ?? "0" }}</p>
                                            @if ($exam->per_question_negative_mark > 0)
                                                <p class="m-0 p-0 text-danger"><b>Per Question Negative Mark: </b> {{ $exam->per_question_negative_mark ?? "0" }}</p>
                                            @endif
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="text-md-end">
                                            <p class="m-0 p-0"><b>Date: </b>{{ ($exam->date_and_time) ? date('d-M-Y', strtotime($exam->date_and_time)) : "" }}</p>
                                            <p class="m-0 p-0"><b>Time: </b>{{ ($exam->date_and_time) ? date('g:i:s A', strtotime($exam->date_and_time)) : "" }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-start mt-3">
                                    <div class="row mb-3">
                                        @forelse ($exam->exam_paper_assigned_questions as $key => $question)
                                            @if ($question->type == "SAQ")
                                                <div class="col-md-12 mb-1">
                                                    <div class="border p-3 rounded mb-3 mb-md-0">
                                                        <h5>{{ ++$key }}. {{ $question->title ?? "" }}</h5>

                                                        <div class="mt-3">
                                                            <div class="form-check">
                                                                <input type="radio" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_a" name="answers[{{ $question->id }}]" value="A" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_a">A. {{ $question->option_a ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="radio" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_b" name="answers[{{ $question->id }}]" value="B" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_b">B. {{ $question->option_b ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="radio" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_c" name="answers[{{ $question->id }}]" value="C" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_c">C. {{ $question->option_c ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="radio" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_d" name="answers[{{ $question->id }}]" value="D" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_d">D. {{ $question->option_d ?? "" }}</label>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            @elseif($question->type == "MCQ")
                                                <div class="col-md-12 mb-1">
                                                    <div class="border p-3 rounded mb-3 mb-md-0">
                                                        <h5>{{ ++$key }}. {{ $question->title ?? "" }}</h5>

                                                        <div class="mt-3">
                                                            <div class="form-check">
                                                                <input type="checkbox" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_a" name="answers[{{ $question->id }}][]" value="A" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_a">A. {{ $question->option_a ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="checkbox" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_b" name="answers[{{ $question->id }}][]" value="B" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_b">B. {{ $question->option_b ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="checkbox" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_c" name="answers[{{ $question->id }}][]" value="C" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_c">C. {{ $question->option_c ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="checkbox" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_d" name="answers[{{ $question->id }}][]" value="D" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_d">D. {{ $question->option_d ?? "" }}</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="checkbox" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_e" name="answers[{{ $question->id }}][]" value="E" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_e">E. {{ $question->option_e ?? "" }}</label>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            @elseif($question->type == "BOOLEAN")
                                                <div class="col-md-12 mb-1">
                                                    <div class="border p-3 rounded mb-3 mb-md-0">
                                                        <h5>{{ ++$key }}. {{ $question->title ?? "" }}</h5>

                                                        <div class="mt-3">
                                                            <div class="form-check">
                                                                <input type="radio" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_a" name="answers[{{ $question->id }}]" value="true" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_a">True</label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input type="radio" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_b" name="answers[{{ $question->id }}]" value="false" class="form-check-input">
                                                                <label class="form-check-label" for="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}_option_b">False</label>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            @elseif($question->type == "SORT_QUESTION")
                                                <div class="col-md-12 mb-1">
                                                    <div class="border p-3 rounded mb-3 mb-md-0">
                                                        <h5>{{ ++$key }}. {{ $question->title ?? "" }}</h5>

                                                        <div class="mt-0">
                                                            <div class="row">
                                                                <div class="mb-0 col-md-12">
                                                                    <textarea name="answers[{{ $question->id }}]" class="form-control answer_text_area" id="exam_id_{{ $exam->id }}_question_id_{{ $question->id }}" rows="6"></textarea>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            @endif
                                        @empty
                                            <p class="text-center">Question Not Found !!!</p>
                                        @endforelse
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" id="submit_button"> Submit </button>
                                    </div>
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
                var targetTime = `{{ $exam_property_data["reminder_time"] ?? "00:00:03" }}`;
                var targetSeconds = timeToSeconds(targetTime);
                var countdownElement = document.getElementById("countdown_time");

                startCountdown();

                function startCountdown() {
                    var interval = setInterval(function() {
                        var remainingSeconds = targetSeconds--;

                        if (remainingSeconds <= 0) {
                            clearInterval(interval);
                            countdownElement.innerHTML = "Finished!";

                            document.getElementById("answer_paper").submit();
                            return;
                        }

                        var hours = Math.floor(remainingSeconds / 3600);
                        var minutes = Math.floor((remainingSeconds % 3600) / 60);
                        var seconds = remainingSeconds % 60;

                        var formattedTime = padZero(hours) + ":" + padZero(minutes) + ":" + padZero(seconds);

                        countdownElement.innerHTML = formattedTime;
                    }, 1000);
                }

                function timeToSeconds(time) {
                    var parts = time.split(":");
                    var hours = parseInt(parts[0]);
                    var minutes = parseInt(parts[1]);
                    var seconds = parseInt(parts[2]);

                    return hours * 3600 + minutes * 60 + seconds;
                }

                function minutesToSeconds(minutes) {
                    return minutes * 60;
                }

                function padZero(number) {
                    return number < 10 ? "0" + number : number;
                }

                const answerTextAreas = document.querySelectorAll('.answer_text_area');

                answerTextAreas.forEach(textArea => {
                    textArea.addEventListener('copy', (e) => {
                        e.preventDefault();
                    });

                    textArea.addEventListener('cut', (e) => {
                        e.preventDefault();
                    });

                    textArea.addEventListener('paste', (e) => {
                        e.preventDefault();
                    });
                });
            });
        </script>
    </x-slot>
</x-client-layout>
