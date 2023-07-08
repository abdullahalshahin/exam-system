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
                            <li class="breadcrumb-item active"> Give Exam </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Give Exam </h4>
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
                            <form action="{{ url('client-panel/dashboard/exams', $exam->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <div class="col-md-12 mb-1">
                                                <div class="border p-3 rounded mb-3 mb-md-0">
                                                    <h5>{{ ++$key }}. {{ $question->title ?? "" }}</h5>

                                                    <div class="mt-3">
                                                        <div class="form-check">
                                                            <input type="radio" id="question_id_{{ $question->id }}_option_a" name="answers[{{ $question->id }}]" value="A" class="form-check-input">
                                                            <label class="form-check-label" for="question_id_{{ $question->id }}_option_a">A. {{ $question->option_a ?? "" }}</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="radio" id="question_id_{{ $question->id }}_option_b" name="answers[{{ $question->id }}]" value="B" class="form-check-input">
                                                            <label class="form-check-label" for="question_id_{{ $question->id }}_option_b">B. {{ $question->option_b ?? "" }}</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="radio" id="question_id_{{ $question->id }}_option_c" name="answers[{{ $question->id }}]" value="C" class="form-check-input">
                                                            <label class="form-check-label" for="question_id_{{ $question->id }}_option_c">C. {{ $question->option_c ?? "" }}</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="radio" id="question_id_{{ $question->id }}_option_d" name="answers[{{ $question->id }}]" value="D" class="form-check-input">
                                                            <label class="form-check-label" for="question_id_{{ $question->id }}_option_d">D. {{ $question->option_d ?? "" }}</label>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center">Question Not Found !!!</p>
                                        @endforelse
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success"> Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
