<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Question Show' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/questions') }}"> Question List </a></li>
                            <li class="breadcrumb-item active"> Question Show </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Question Show </h4>
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
                                <p class="text-muted mb-2 font-13"><strong> Subject : </strong> <span class="ms-2"> {{ $question->subject->name ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> Type : </strong><span class="ms-2"> {{ $question->type ?? "" }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong> Title : </strong><span class="ms-2"> {{ $question->title ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> ption A : </strong> <span class="ms-2 "> {{ $question->option_a ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> Option B : </strong> <span class="ms-2 "> {{ $question->option_b ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> Option C : </strong> <span class="ms-2 "> {{ $question->option_c ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> Option D : </strong> <span class="ms-2 "> {{ $question->option_d ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> Correct Answer : </strong> <span class="ms-2 "> {{ $question->correct_answer ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong> Reference : </strong> <span class="ms-2 "> {{ $question->reference ?? "" }} </span></p>

                                <p class="text-muted mb-2 font-13"><strong >Description : </strong> <span class="ms-2 "> {{ $question->description ?? "" }} </span></p>

                                <p class="text-muted mb-1 font-13"><strong> Status : </strong> <span class="ms-2"> {{ $question->status ?? "" }} </span></p>
                            </div>

                            <div class="modal-footer">
                                <a href="{{ url('admin-panel/dashboard/questions') }}" class="btn btn-primary"> Go Back </a>
                                <a href="{{ url('admin-panel/dashboard/questions/'. $question->id .'/edit') }}" class="btn btn-success"> <i class="mdi mdi-content-save-edit-outline"></i> <span> Edit </span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
