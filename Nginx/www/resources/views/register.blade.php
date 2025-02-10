@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('messages.register.title') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="form-group">
                                <label for="username">{{ trans('messages.register.name_label') }}</label>
                                <input id="username" type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       name="username" value="{{ old('username') }}" required>
                                @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_number">{{ trans('messages.register.phone_number_label') }}</label>
                                <input id="phone_number" type="text"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ trans('messages.register.submit_button') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
