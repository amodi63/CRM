<form action="{{ $action }}" method="post" class="forms-sample" enctype="multipart/form-data">
    @csrf
    @isset($contact->id)
        @method('PUT')
    @endisset

    <!-- First Name -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $contact->first_name) }}"
                    class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Name">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Last Name -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $contact->last_name) }}"
                    class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Name">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Job Title -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" name="job_title" value="{{ old('job_title',$contact->job_title) }}"
                    class="form-control @error('job_title') is-invalid @enderror" id="job_title"
                    placeholder="Job Title">
                @error('job_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Email Address -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail3">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $contact->email) }}" id="exampleInputEmail3" placeholder="Email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Mobile Number -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="phone_no">Mobile</label>
                
                <div class="input-group">
                    <input type="number" name="phone_no[]"  class="form-control @error('phone_no') is-invalid @enderror" id="phone_no"
                        placeholder="Mobile Number">
                    @error('phone_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="button" class="btn btn-primary" id="add-phone-btn">Add</button>
                </div>
            </div>
            <div class="additional-phones-container">
              @isset($contact->phone_no)
                  
              @for ($i = 0; $i < count($contact->phone_no); $i++)
              <div class="form-group d-flex align-items-center">
                  <div class="flex-grow-1">
                      <input type="number" name="phone_no[]" value="{{ $contact->phone_no[$i] }}" class="form-control phone-input" placeholder="Mobile Number">
                  </div>
                  <div class="ml-2">
                      <button type="button" class="btn btn-danger remove-phone-btn">
                          Remove
                      </button>
                  </div>
              </div>
          @endfor
              @endisset
            </div>
        </div>

        <!-- Gender -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control form-control-lg selectpicker @error('gender') is-invalid @enderror"
                    data-live-search="true" name="gender" id="gender">
                    @isset($gender)
                        @foreach ($gender as $key => $type)
                            <option value="{{ $key }}"
                                {{ old('gender', $contact->gender) == $key ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    @endisset
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Birthday -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" value="{{ old('birthday', $contact->birthday) }}"
                    class="form-control @error('birthday') is-invalid @enderror" id="birthday" placeholder="Birthday">
                @error('birthday')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Country -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail3">Country</label>
                <select class="form-control form-control-lg selectpicker @error('country') is-invalid @enderror"
                    data-live-search="true" name="country" id="countries">
                    @isset($countries)
                        @foreach ($countries as $key => $country)
                            <option value="{{ $key }}"
                                {{ old('country', $contact->country) == $key ? 'selected' : '' }}>
                                {{ $country }}
                            </option>
                        @endforeach
                    @endisset
                </select>
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Avatar Image -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Avatar Image</label>
                <div class="input-group col-xs-12">
                    <input type="file" name="avatar" class="form-control file-upload-info"
                        placeholder="Upload Image">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if ($contact->avatar)
        <div class="row mb-3">
            <div class="col-md-12">
                <img src="{{ asset('storage/' . $contact->avatar) }}" class="img-thumbnail mt-2" width="150"
                    height="150" alt="contact Image">
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-gradient-primary me-2">{{ $btn_text }}</button>
            <a class="btn btn-light" href="{{ route('contacts.index') }}">Cancel</a>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
            let phoneCount = 1;

            function addPhoneInput() {
                const phoneInputHTML = `
                <div class="form-group d-flex align-items-center">
                    <div class="flex-grow-1">
                        <input type="number" name="phone_no[]" class="form-control phone-input" placeholder="Mobile Number">
                    </div>
                    <div class="ml-2">
                        <button type="button" class="btn btn-danger  remove-phone-btn">
                            Remove
                        </button>
                    </div>
                </div>
            `;
                $('.additional-phones-container').append(phoneInputHTML);
                phoneCount++;
            }

            $('#add-phone-btn').click(function() {
                addPhoneInput();
            });

            $(document).on('click', '.remove-phone-btn', function() {
                $(this).closest('.form-group').remove();
            });
        });
    </script>
@endpush
