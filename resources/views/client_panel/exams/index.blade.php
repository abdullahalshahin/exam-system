<x-client-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Exams' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item active"> Exams </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Exams List </h4>
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
                <div class="row">
                    @foreach ($exam_papers as $exam_paper)
                        <div class="col-md-3">
                            <div class="card card-body">
                                <h4 class="m-0 p-0">{{ $exam_paper->name ?? "" }}</h4>
    
                                <p class="text-muted font-13 m-0 p-0"><b>Subject: </b> {{ $exam_paper->subject->name ?? "" }} </p>
    
                                <p class="card-text" title="{{ $exam_paper->description ?? "" }}" style="height: 50px;">{!! substr($exam_paper->description, 0, 70) !!}...</p>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-md-start">
                                            <p class="m-0 p-0">{{ $exam_paper->duration ?? "0" }} Minutes</p>
                                            <p class="m-0 p-0">{{ $exam_paper->total_mark ?? "0" }} Mark</p>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="text-md-end">
                                            <p class="m-0 p-0">{{ ($exam_paper->date_and_time) ? date('d-M-Y', strtotime($exam_paper->date_and_time)) : "" }}</p>
                                            <p class="m-0 p-0">{{ ($exam_paper->date_and_time) ? date('g:i:s A', strtotime($exam_paper->date_and_time)) : "" }}</p>
                                        </div>
                                    </div>
                                </div>
    
                                <a href="{{ url('client-panel/dashboard/exams', $exam_paper->id) }}" class="btn btn-primary">Enter Exam</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
