<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Subjects' }}</x-slot>

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
                            <li class="breadcrumb-item active">Subject List</li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Subjects </h4>
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
                                <a href="{{ url('admin-panel/dashboard/subjects/create') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Subject </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th> SL </th>
                                        <th> Name </th>
                                        <th> Code </th>
                                        <th> Total Mark </th>
                                        <th> Total Credit </th>
                                        <th> Status </th>
                                        <th style="width: 75px;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td> {{ ++$i }} </td>
                                            <td> {{ $subject->name ?? '' }} </td>
                                            <td> {{ $subject->code ?? '' }} </td>
                                            <td> {{ $subject->total_mark ?? '' }} </td>
                                            <td> {{ $subject->total_credit ?? '' }} </td>
                                            <td>
                                                @if ($subject->status == "Active")
                                                    <span class="badge badge-success-lighten">Active</span>
                                                @elseif ($subject->status == "Inactive")
                                                    <span class="badge badge-warning-lighten">Inactive</span>
                                                @elseif ($subject->status == "Closed")
                                                    <span class="badge badge-danger-lighten">Closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('admin-panel/dashboard/subjects', $subject->id) }}" method="POST">
                                                    <a href="{{ url('admin-panel/dashboard/subjects', $subject->id) }}" class="action-icon" id="view_button"> <i class="mdi mdi-eye"></i></a>
                                                    <a href="{{ url('admin-panel/dashboard/subjects/' . $subject->id . '/edit') }}" class="action-icon" id="edit_button"> <i class="mdi mdi-square-edit-outline"></i></a>

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
        <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.checkboxes.min.js') }}"></script>

        <script src="{{ asset('assets/js/pages/demo.subjects.js') }}"></script>

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
