<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Subject Show' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/subjects') }}"> Subject List </a></li>
                            <li class="breadcrumb-item active"> Subject Show </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Subject Show </h4>
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
                            <div class="text-start mt-3">
                                <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ms-2">{{ $subject->name ?? "" }}</span></p>
    
                                <p class="text-muted mb-2 font-13"><strong>Code :</strong><span class="ms-2">{{ $subject->code ?? "" }}</span></p>
    
                                <p class="text-muted mb-2 font-13"><strong>Total Mark :</strong><span class="ms-2">{{ $subject->total_mark ?? "" }}</span></p>
    
                                <p class="text-muted mb-2 font-13"><strong>Total Credit :</strong> <span class="ms-2 ">{{ $subject->total_credit ?? "" }}</span></p>
    
                                <p class="text-muted mb-1 font-13"><strong>Status :</strong> <span class="ms-2">{{ $subject->status ?? "" }}</span></p>
                            </div>

                            <div class="modal-footer">
                                <a href="{{ url('admin-panel/dashboard/subjects') }}" class="btn btn-primary"> Go Back </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
