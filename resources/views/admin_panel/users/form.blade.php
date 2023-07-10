<div class="row g-2">
    <div class="mb-2 col-md-8">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" id="name" placeholder="" required>
    </div>

    <div class="mb-2 col-md-4">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="form-select" required>
            <option value="" selected disabled> Choose Gender </option>
            <option value="Male" {{ (old('gender') ?? ($user->gender ?? '')) == "Male" ? 'selected' : '' }}> Male </option>
            <option value="Female" {{ (old('gender') ?? ($user->gender ?? '')) == "Female" ? 'selected' : '' }}> Female </option>
            <option value="Oters" {{ (old('gender') ?? ($user->gender ?? '')) == "Oters" ? 'selected' : '' }}> Oters </option>
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-6">
        <label for="mobile_number">Mobile Number</label>
        <input class="form-control" type="text" id="mobile_number" placeholder="Enter your contact number" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number ?? '') }}" required autofocus>
    </div>

    <div class="mb-2 col-md-6">
        <label for="email">Email address</label>
        <input class="form-control" type="email" id="email" placeholder="Enter your email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-6">
        <label for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" placeholder="Enter your password" type="password" name="password" value="{{ old('password', $user->security ?? '') }}" required autocomplete="new-password" >

            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>

    <div class="mb-2 col-md-6">
        <label for="password_confirmation">Confirm Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password_confirmation" class="form-control" placeholder="Enter your password" type="password" name="password_confirmation" value="{{ old('password_confirmation', $user->security ?? '') }}" required >
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-12">
        <label for="address">Address</label>
        <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" class="form-control" id="address" placeholder="Village, Upazila, Thana, Division" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-4">
        <label for="profile_image">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" class="form-control">

        @if ($user->profile_image)
            <img class="rounded-circle" alt="{{ $user->name ?? '' }}" height="80" src="/images/users/{{ $user->profile_image }}" />
        @endif
    </div>

    <div class="mb-2 col-md-4">
        <label for="role_ids">Permission</label>
        <select id="role_ids" name="role_ids" class="form-select">
            <option value="" selected disabled>Choose Permission</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name ?? '' }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-2 col-md-4">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="" selected disabled> Choose Status </option>
            <option value="active" {{ (old('inputState') ?? ($user->status ?? '')) == "active" ? 'selected' : '' }}> Active </option>
            <option value="inactive" {{ (old('inputState') ?? ($user->status ?? '')) == "inactive" ? 'selected' : '' }}> Inactive </option>
            <option value="blocked" {{ (old('inputState') ?? ($user->status ?? '')) == "blocked" ? 'selected' : '' }}> Blocked </option>
        </select>
    </div>
</div>
