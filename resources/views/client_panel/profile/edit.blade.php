<x-client-layout>
    <x-slot name="page_title">{{ $page_title ?? 'My Account Edit' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('client-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item active"> My Account Edit </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> My Account Edit </h4>
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
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body">
                        @if ($client->profile_image)
                            <img src="/images/clients/{{ $client->profile_image }}" class="rounded-circle avatar-lg img-thumbnail" alt="image">
                        @else
                            <img src="{{ asset('assets/images/avator.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="image">
                        @endif

                        <div class="row mb-2">
                            <div class="text-start mt-3">
                                <form action="{{ url('client-panel/dashboard/my-account-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
        
                                    <div class="row g-2">
                                        <div class="mb-2 col-md-8">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="{{ old('name', $client->name ?? '') }}" class="form-control" id="name" placeholder="" required>
                                        </div>
                                    
                                        <div class="mb-2 col-md-4">
                                            <label for="gender">Gender</label>
                                            <select id="gender" name="gender" class="form-select" required>
                                                <option value="" selected disabled> Choose Gender </option>
                                                <option value="Male" {{ (old('gender') ?? ($client->gender ?? '')) == "Male" ? 'selected' : '' }}> Male </option>
                                                <option value="Female" {{ (old('gender') ?? ($client->gender ?? '')) == "Female" ? 'selected' : '' }}> Female </option>
                                                <option value="Oters" {{ (old('gender') ?? ($client->gender ?? '')) == "Oters" ? 'selected' : '' }}> Oters </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label for="password">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control" placeholder="Enter your password" type="password" name="password" value="{{ old('password', $client->security ?? '') }}" required autocomplete="new-password" >
                                    
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="mb-2 col-md-6">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password_confirmation" class="form-control" placeholder="Enter your password" type="password" name="password_confirmation" value="{{ old('password_confirmation', $client->security ?? '') }}" required >
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2">
                                        <div class="mb-2 col-md-12">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" value="{{ old('address', $client->address ?? '') }}" class="form-control" id="address" placeholder="Village, Upazila, Thana, Division" required>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label for="profile_image">Profile Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                                        </div>
                                    </div>
            
                                    <div class="modal-footer">
                                        <a href="{{ url('client-panel/dashboard/my-account') }}" class="btn btn-primary"> Go Back </a>
                                        <button type="submit" class="btn btn-success"> Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
