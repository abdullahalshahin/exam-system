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
                            <li class="breadcrumb-item active"> Exam Paper List </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Exam Papers </h4>
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
                            <div class="col-sm-4">
                                <a href="{{ url('admin-panel/dashboard/exam-papers/create') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Create Exam Paper </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th> SL </th>
                                        <th> Name </th>
                                        <th> Subject </th>
                                        <th> Date </th>
                                        <th> Time </th>
                                        <th> Duration </th>
                                        <th> Total Mark </th>
                                        <th> Status </th>
                                        <th style="width: 75px;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam_papers as $exam_paper)
                                        <tr>
                                            <td> {{ ++$i }} </td>
                                            <td> {{ substr($exam_paper->name, 0, 15) ?? '' }}... </td>
                                            <td> {{ $exam_paper->subject->name ?? '' }} </td>
                                            <td> {{ $exam_paper->date ?? '' }} </td>
                                            <td> {{ $exam_paper->time ?? '' }} </td>
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
                                                <form action="{{ url('admin-panel/dashboard/exam-papers', $exam_paper->id) }}" method="POST">
                                                    <a href="{{ url('admin-panel/dashboard/exam-papers', $exam_paper->id) }}" class="action-icon" id="view_button"> <i class="mdi mdi-eye"></i></a>
                                                    <a href="{{ url('admin-panel/dashboard/exam-papers/' . $exam_paper->id . '/edit') }}" class="action-icon" id="edit_button"> <i class="mdi mdi-square-edit-outline"></i></a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn action-icon show_confirm" data-toggle="tooltip" title='Delete'><i class="mdi mdi-delete"></i></button>
                                                </form>
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
        {{-- <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.checkboxes.min.js') }}"></script> --}}

        <script src="{{ asset('assets/js/pages/demo.exam_papers.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#DataTable').DataTable();

                $('#notificationAlert').delay(3000).fadeOut('slow');

                $('.show_confirm').click(function(event) {
                    var form =  $(this).closest("form");
                    var name = $(this).data("name");

                    event.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete this item ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    })
                    .then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-app-layout>
