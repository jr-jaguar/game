@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('messages.game.title') }}</div>

                    <div class="card-body">
                        <div id="game-container">
                            <div class="mb-4">
                                <button
                                    id="regenerate-button"
                                    class="btn btn-warning me-2"
                                    data-token="{{ $token }}"
                                >
                                    {{ trans('messages.game.regenerate_button') }}
                                </button>
                                <button
                                    id="deactivate-button"
                                    class="btn btn-danger"
                                    data-token="{{ $token }}"
                                >
                                    {{ trans('messages.game.deactivate_button') }}
                                </button>
                            </div>

                            <div class="mb-4">
                                <button
                                    id="lucky-button"
                                    class="btn btn-primary me-2"
                                    data-token="{{ $token }}"
                                >
                                    {{ trans('messages.game.lucky_button') }}
                                </button>
                                <button
                                    id="history-button"
                                    class="btn btn-secondary"
                                    data-token="{{ $token }}"
                                >
                                    {{ trans('messages.game.history_button') }}
                                </button>
                            </div>

                            <div id="result" class="mb-4 d-none">
                                <h4>{{ trans('messages.game.current_result') }}</h4>
                                <p>{{ trans('messages.game.number') }}: <span id="current-number"></span></p>
                                <p>{{ trans('messages.game.result') }}: <span id="current-result"></span></p>
                                <p>{{ trans('messages.game.win_amount') }}: <span id="current-win"></span></p>
                            </div>

                            <div id="history" class="mb-4 d-none">
                                <h4>{{ trans('messages.game.history') }}</h4>
                                <ul id="history-list" class="list-unstyled"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.getElementById('lucky-button').dataset.token;

            document.getElementById('lucky-button').addEventListener('click', async function() {
                try {
                    const response = await fetch(`/game/${token}/play`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        updateCurrentGame(data.current_game);
                        document.getElementById('history').classList.add('d-none');
                    } else {
                        showError(data.error);
                    }
                } catch (error) {
                    showError('{{ trans("messages.errors.game_error") }}');
                }
            });

            document.getElementById('history-button').addEventListener('click', async function() {
                try {
                    const response = await fetch(`/game/${token}/history`);
                    const data = await response.json();

                    if (response.ok) {
                        updateHistory(data);
                        document.getElementById('history').classList.remove('d-none');
                        document.getElementById('result').classList.add('d-none');
                    } else {
                        showError(data.error);
                    }
                } catch (error) {
                    showError('{{ trans("messages.errors.history_error") }}');
                }
            });

            document.getElementById('regenerate-button').addEventListener('click', async function() {
                if (!confirm('{{ trans("messages.game.regenerate_confirm") }}')) {
                    return;
                }

                try {
                    const response = await fetch(`/link/${token}/regenerate`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        window.location.href = data.game_url;
                    } else {
                        showError(data.error);
                    }
                } catch (error) {
                    showError('{{ trans("messages.errors.regenerate_error") }}');
                }
            });

            document.getElementById('deactivate-button').addEventListener('click', async function() {
                if (!confirm('{{ trans("messages.game.deactivate_confirm") }}')) {
                    return;
                }

                try {
                    const response = await fetch(`/link/${token}/deactivate`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        window.location.href = '{{ route("register") }}';
                    } else {
                        const data = await response.json();
                        showError(data.error);
                    }
                } catch (error) {
                    showError('{{ trans("messages.errors.deactivate_error") }}');
                }
            });

            function updateCurrentGame(game) {
                document.getElementById('result').classList.remove('d-none');
                document.getElementById('current-number').textContent = game.random_number;
                document.getElementById('current-result').textContent = game.is_win ? 'Win' : 'Lose';
                document.getElementById('current-win').textContent = game.win_amount;
            }

            function updateHistory(history) {
                const historyList = document.getElementById('history-list');
                historyList.innerHTML = history.map(game => `
            <li class="mb-2">
                {{ trans('messages.game.number') }}: ${game.random_number},
                {{ trans('messages.game.result') }}: ${game.is_win ? 'Win' : 'Lose'},
                {{ trans('messages.game.win_amount') }}: ${game.win_amount}
            </li>
        `).join('');
            }

            function showError(message) {
                alert(message);
            }
        });
    </script>
@endpush
