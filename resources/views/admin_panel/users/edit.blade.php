<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'User Edit' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/users') }}"> User List </a></li>
                            <li class="breadcrumb-item active"> User Edit </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> User Edit </h4>
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
                            <form action="{{ url('admin-panel/dashboard/users', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
        
                                @include('admin_panel.users.form')
        
                                <div class="modal-footer">
                                    <a href="{{ url('admin-panel/dashboard/users') }}" class="btn btn-primary"> Go Back </a>
                                    <button type="submit" class="btn btn-success"> Save </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
