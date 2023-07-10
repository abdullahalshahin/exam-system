<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Exam Papers' }}</x-slot>

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
                            <li class="breadcrumb-item active"> Exam Papers </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Exam Paper List </h4>
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
                                        <th> SL </th>
                                        <th> Name </th>
                                        <th> Subject </th>
                                        <th> Start Date </th>
                                        <th> End Date </th>
                                        <th> Duration </th>
                                        <th> Total Mark </th>
                                        <th> Status </th>
                                        <th style="width: 75px;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam_papers as $key => $exam_paper)
                                        <tr>
                                            <td> {{ ++$key }} </td>
                                            <td> {{ substr($exam_paper->name, 0, 15) ?? '' }}... </td>
                                            <td> {{ $exam_paper->subject->name ?? '' }} </td>
                                            <td> {{ ($exam_paper->date_and_time) ? date('d-M-Y, g:i:s A', strtotime($exam_paper->date_and_time)) : "" }} </td>
                                            <td> {{ ($exam_paper->end_date_and_time) ? date('d-M-Y, g:i:s A', strtotime($exam_paper->end_date_and_time)) : "" }} </td>
                                            <td> {{ $exam_paper->duration ?? '' }} </td>
                                            <td> {{ $exam_paper->total_mark ?? '' }} </td>
                                            <td>
                                                @if ($exam_paper->status == "Active")
                                                    <span class="badge badge-success-lighten">Active</span>
                                                @elseif ($exam_paper->status == "Inactive")
                                                    <span class="badge badge-warning-lighten">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin-panel/dashboard/exam-results', $exam_paper->id) }}" class="action-icon" id="view_button"> <i class="mdi mdi-eye"></i></a>
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

        <script src="{{ asset('assets/js/pages/demo.exam_papers.js') }}"></script>
    </x-slot>
</x-app-layout>
