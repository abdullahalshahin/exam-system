<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Exam Paper Show' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/exam-papers') }}"> Exam Papers </a></li>
                            <li class="breadcrumb-item active"> Exam Paper Show </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Exam Paper Show </h4>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success" id="notificationAlert">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="row">
                                <div class="col-md-3"></div>
                                
                                <div class="col-md-6">
                                    <p class="text-center h3">{{ $exam_paper->name ?? ""}}</p>
                                </div>
                                
                                <div class="col-md-3"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3"></div>
                                
                                <div class="col-md-6">
                                    <p class="text-center p-0 m-0">{{ $exam_paper->subject->name ?? ""}}</p>
                                </div>
                                
                                <div class="col-md-3"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                            
                                <div class="col-md-8">
                                    <p class="text-center">{{ $exam_paper->description ?? ""}}</p>
                                </div>
                            
                                <div class="col-md-2"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-md-start">
                                        <p class="m-0 p-0"><b>Duration: </b> {{ $exam_paper->duration ?? "0" }} Minutes</p>
                                        <p class="m-0 p-0"><b>Total Mark: </b> {{ $exam_paper->total_mark ?? "0" }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="text-md-end">
                                        <p class="m-0 p-0"><b>Start Date: </b>{{ ($exam_paper->date_and_time) ? date('d-M-Y', strtotime($exam_paper->date_and_time)) : "" }}</p>
                                        <p class="m-0 p-0"><b>Start Time: </b>{{ ($exam_paper->date_and_time) ? date('g:i:s A', strtotime($exam_paper->date_and_time)) : "" }}</p>
                                        <p class="m-0 p-0"><b>End Date: </b>{{ ($exam_paper->end_date_and_time) ? date('d-M-Y g:i:s A', strtotime($exam_paper->end_date_and_time)) : "" }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="text-start mt-3">
                                <div class="row">
                                    @forelse ($exam_paper->exam_paper_assigned_questions as $question)
                                        <div class="col-lg-6 col-xxl-3">
                                            <div class="border p-3 rounded mb-3 mb-md-0">
                                                <h5>{{ $question->title ?? "" }}</h5>
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
                            </div>

                            <div class="modal-footer">
                                <a href="{{ url('admin-panel/dashboard/exam-papers') }}" class="btn btn-primary"> Go Back </a>
                                <a href="{{ url('admin-panel/dashboard/exam-papers/'. $exam_paper->id .'/edit') }}" class="btn btn-success"> <i class="mdi mdi-content-save-edit-outline"></i> <span> Edit </span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
