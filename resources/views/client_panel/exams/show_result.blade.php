<x-client-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Result' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard/exams') }}"> Exams </a></li>
                            <li class="breadcrumb-item active"> Result </li>
                        </ol>
                    </div>

                    <h4 class="page-title"><span id="countdown_time">{{ $exam_participant->exam_paper->name ?? "" }} Result</h4>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success" id="notificationAlert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="text-center">
                                <p class="text-center h3">{{ $exam->name ?? ""}}</p>

                                <p class="text-center p-0 m-0">{{ $exam->subject->name ?? ""}}</p>

                                <p class="text-center">{{ $exam->description ?? ""}}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-md-start">
                                        <p class="m-0 p-0"><b>Duration: </b> {{ $exam->duration ?? "0" }} Minutes</p>
                                        <p class="m-0 p-0"><b>Total Marks: </b> {{ $exam->total_mark ?? "0" }}</p>
                                        @if ($exam->per_question_negative_mark > 0)
                                            <p class="m-0 p-0 text-danger"><b>Per Question Negative Mark: </b> {{ $exam->per_question_negative_mark ?? "0" }}</p>
                                        @endif
                                        <p class="m-0 p-0"><b>Obtained Marks: </b> {{ $exam_participant->obtained_marks ?? "0" }}</p>
                                        <p class="m-0 p-0"><b>Negative Marks: </b> {{ $exam_participant->negative_marks ?? "0" }}</p>
                                        <p class="m-0 p-0"><b>Total Participation: </b> {{ $total_participation ?? "_ _" }}</p>
                                        <p class="m-0 p-0"><b>My Position: </b> {{ $my_position ?? "_ _" }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="text-md-end">
                                        <p class="m-0 p-0"><b>Exam Time: </b>{{ ($exam->date_and_time) ? date('d-M-Y g:i:s A', strtotime($exam->date_and_time)) : "" }}</p>
                                        <p class="m-0 p-0"><b>Entry Time: </b>{{ ($exam_participant->entry_time) ? date('d-M-Y, g:i:s A', strtotime($exam_participant->entry_time)) : "" }}</p>
                                        <p class="m-0 p-0"><b>Submit Time: </b>{{ ($exam_participant->submit_time) ? date('d-M-Y, g:i:s A', strtotime($exam_participant->submit_time)) : "" }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="text-start mt-3">
                                <div class="row mb-3">
                                    @forelse ($exam_participant->answer_papers as $key => $answer_paper)
                                        <div class="col-md-12 mb-1">
                                            <div class="border p-3 rounded mb-3 mb-md-0">
                                                <h5>{{ ++$key }}. {{ $answer_paper->question->title ?? "" }}</h5>
                                                
                                                <div class="mt-2">
                                                    <p class="m-0 p-0 {{ ($answer_paper->given_answer) ? (($answer_paper->correct_answer == $answer_paper->given_answer) ? (($answer_paper->given_answer == "A") ? "text-success" : "") : (($answer_paper->given_answer == "A") ? "text-danger" : (($answer_paper->correct_answer == "A") ? "text-success" : ""))) : (($answer_paper->correct_answer == "A") ? "text-primary" : "") }}">A. {{ $answer_paper->question->option_a ?? "" }}</p>
                                                    <p class="m-0 p-0 {{ ($answer_paper->given_answer) ? (($answer_paper->correct_answer == $answer_paper->given_answer) ? (($answer_paper->given_answer == "B") ? "text-success" : "") : (($answer_paper->given_answer == "B") ? "text-danger" : (($answer_paper->correct_answer == "B") ? "text-success" : ""))) : (($answer_paper->correct_answer == "B") ? "text-primary" : "") }}">B. {{ $answer_paper->question->option_b ?? "" }}</p>
                                                    <p class="m-0 p-0 {{ ($answer_paper->given_answer) ? (($answer_paper->correct_answer == $answer_paper->given_answer) ? (($answer_paper->given_answer == "C") ? "text-success" : "") : (($answer_paper->given_answer == "C") ? "text-danger" : (($answer_paper->correct_answer == "C") ? "text-success" : ""))) : (($answer_paper->correct_answer == "C") ? "text-primary" : "") }}">C. {{ $answer_paper->question->option_c ?? "" }}</p>
                                                    <p class="m-0 p-0 {{ ($answer_paper->given_answer) ? (($answer_paper->correct_answer == $answer_paper->given_answer) ? (($answer_paper->given_answer == "D") ? "text-success" : "") : (($answer_paper->given_answer == "D") ? "text-danger" : (($answer_paper->correct_answer == "D") ? "text-success" : ""))) : (($answer_paper->correct_answer == "D") ? "text-primary" : "") }}">D. {{ $answer_paper->question->option_d ?? "" }}</p>
                                                </div> 
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">Question Not Found !!!</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-client-layout>
