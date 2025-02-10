@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('messages.register_success.title') }}</div>

                    <div class="card-body">
                        <div class="alert alert-success">
                            {{ trans('messages.register_success.message') }}
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $game_url }}" readonly id="gameUrl">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyGameUrl()">
                                {{ trans('messages.register_success.copy_button') }}
                            </button>
                        </div>

                        <div class="mt-3">
                            <a href="{{ $game_url }}" class="btn btn-primary">
                                {{ trans('messages.register_success.play_button') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function copyGameUrl() {
                const urlInput = document.getElementById('gameUrl');
                urlInput.select();
                document.execCommand('copy');
                alert('{{ trans('messages.register_success.copy_success') }}');
            }
        </script>
    @endpush
@endsection
