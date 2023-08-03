<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Exam Results' }}</x-slot>

    <x-slot name="style">
        <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/exam-results') }}"> Exam Papers </a></li>
                            <li class="breadcrumb-item active"> Exam Results </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Exam Results List Of {{ $exam_paper->name ?? "" }} </h4>
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
                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th> Student </th>
                                        <th> Entry Time </th>
                                        <th> Submit Time </th>
                                        <th> Obtained Marks </th>
                                        <th> Negative Marks </th>
                                        <th> Position </th>
                                        <th style="width: 75px;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam_participants as $exam_participant)
                                        <tr>
                                            <td> {{ $exam_participant->student->name ?? '' }} </td>
                                            <td> {{ ($exam_participant->entry_time) ? date('d-M-Y, g:i:s A', strtotime($exam_participant->entry_time)) : "" }} </td>
                                            <td> {{ ($exam_participant->submit_time) ? date('d-M-Y, g:i:s A', strtotime($exam_participant->submit_time)) : "" }} </td>
                                            <td> {{ $exam_participant->obtained_marks ?? '' }} </td>
                                            <td> {{ $exam_participant->negative_marks ?? '' }} </td>

                                            @php
                                                $position = App\Models\ExamParticipant::query()
                                                    ->where('exam_paper_id', $exam_paper->id)
                                                    ->where('obtained_marks', '>', $exam_participant->obtained_marks ?? 0)
                                                    ->count() + 1;
                                            @endphp
                                            <td> {{ $position ?? "" }} </td>
                                            <td>
                                                @if ($exam_participant->obtained_marks)
                                                    <a href="{{ url('admin-panel/dashboard/exam-results/'. $exam_paper->id .'/exam-participants/'. $exam_participant->id .'/') }}" class="action-icon" id="view_button"> <i class="mdi mdi-eye"></i></a>
                                                @else
                                                    <a href="{{ url('admin-panel/dashboard/exam-results/'. $exam_paper->id .'/answer-papers/'. $exam_participant->id .'/') }}" class="" id="view_button"> Make Result</i></a>    
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>

        <script src="{{ asset('assets/js/pages/demo.exam_results.js') }}"></script>
    </x-slot>
</x-app-layout>
