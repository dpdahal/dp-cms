@extends('auth.auth-layout')
@section('auth-section')
    <div class="container-fluid custom-breadcrumb">
        <div class="container text-center py-3">
            <h1>{{ __('Register') }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="account_type_id">Select Types
                            <span class="text-danger">*
                                        @error('account_type_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </span>
                        </label>
                        <select class="form-control" id="account_type_id" name="account_type_id">
                            <option value="">Select Account Type</option>
                            @foreach($accountTypeData as $accountType)
                                <option value="{{ $accountType->id }}"
                                    {{ old('account_type_id') == $accountType->id ? 'selected' : '' }}
                                >{{ $accountType->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group mb-2">
                        <label for="country_id">Country:
                            <span class="text-danger">*
                                        @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </span>

                        </label>
                        <select class="form-control" id="country_id" name="country_id">
                            <option value="">Select Country</option>
                            @foreach($countryData as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country_id') == $country->id ? 'selected' : '' }}
                                >{{ $country->country_name }}</option>
                            @endforeach
                        </select>

                    </div>


                    <div class="form-group mb-2">
                        <label for="name">{{ __('Name') }}</label>


                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group mb-2">
                        <label for="email">{{ __('Email Address') }}</label>


                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group mb-2">
                        <label for="password">{{ __('Password') }}</label>


                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                        >

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group mb-2">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>


                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation">

                    </div>

                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
