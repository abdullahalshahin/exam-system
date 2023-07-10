<div class="row g-2">
    <div class="mb-2 col-md-8">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" class="form-control" id="name" placeholder="" required>
    </div>

    <div class="mb-2 col-md-4">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="form-select" required>
            <option value="" selected disabled> Choose Gender </option>
            <option value="Male" {{ (old('gender') ?? ($student->gender ?? '')) == "Male" ? 'selected' : '' }}> Male </option>
            <option value="Female" {{ (old('gender') ?? ($student->gender ?? '')) == "Female" ? 'selected' : '' }}> Female </option>
            <option value="Oters" {{ (old('gender') ?? ($student->gender ?? '')) == "Oters" ? 'selected' : '' }}> Oters </option>
        </select>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-6">
        <label for="mobile_number">Mobile Number</label>
        <input class="form-control" type="text" id="mobile_number" placeholder="Enter your contact number" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number ?? '') }}" required autofocus>
    </div>

    <div class="mb-2 col-md-6">
        <label for="email">Email address</label>
        <input class="form-control" type="email" id="email" placeholder="Enter your email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-6">
        <label for="password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" placeholder="Enter your password" type="password" name="password" value="{{ old('password', $student->security ?? '') }}" required autocomplete="new-password" >

            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>

    <div class="mb-2 col-md-6">
        <label for="password_confirmation">Confirm Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password_confirmation" class="form-control" placeholder="Enter your password" type="password" name="password_confirmation" value="{{ old('password_confirmation', $student->security ?? '') }}" required >
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-12">
        <label for="address">Address</label>
        <input type="text" name="address" value="{{ old('address', $student->address ?? '') }}" class="form-control" id="address" placeholder="Village, Upazila, Thana, Division" required>
    </div>
</div>

<div class="row g-2">
    <div class="mb-2 col-md-4">
        <label for="profile_image">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" class="form-control">

        @if ($student->profile_image)
            <img class="rounded-circle" alt="{{ $student->name ?? '' }}" height="80" src="/images/clients/{{ $student->profile_image }}" />
        @endif
    </div>

    <div class="mb-2 col-md-4">
        <label for="inputState">Status</label>
        <select id="inputState" name="inputState" class="form-select" required>
            <option value="" selected disabled> Choose Status </option>
            <option value="active" {{ (old('inputState') ?? ($student->status ?? '')) == "active" ? 'selected' : '' }}> Active </option>
            <option value="inactive" {{ (old('inputState') ?? ($student->status ?? '')) == "inactive" ? 'selected' : '' }}> Inactive </option>
            <option value="blocked" {{ (old('inputState') ?? ($student->status ?? '')) == "blocked" ? 'selected' : '' }}> Blocked </option>
        </select>
    </div>
</div>
