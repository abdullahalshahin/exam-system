<x-client-layout>
    <x-slot name="page_title">{{ $page_title ?? 'My Account Show' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item active"> My Account </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> My Account </h4>
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
                        @if ($client->profile_image)
                            <img src="/images/clients/{{ $client->profile_image }}" class="rounded-circle avatar-lg img-thumbnail" alt="image">
                        @else
                            <img src="{{ asset('assets/images/logo_sm.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="image">
                        @endif

                        <div class="row mb-2">
                            <div class="text-start mt-3">
                                <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ms-2">{{ $client->name ?? "" }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Mobile Number :</strong> <span class="ms-2">{{ $client->mobile_number ?? "" }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ms-2">{{ $client->name ?? "" }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{ $client->email ?? "" }}</span></p>
                                <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ms-2">{{ $client->gender ?? "" }}</span></p>
                            </div>

                            <div class="modal-footer">
                                <a href="{{ url('client-panel/dashboard') }}" class="btn btn-primary"> Go Back </a>
                                <a href="{{ url('client-panel/dashboard/my-account-edit') }}" class="btn btn-success"> Edit </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
