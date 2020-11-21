@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

@yield('chat', View::make('chat.main'))

<style>
    .chat-message .badge {
        visibility: hidden;
    }
    .chat-message:hover .badge {
        visibility: visible;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card js-chat__container" data-room-id="{{ $room->id }}">
                <div class="card-header">
                    {{ __('Чат') }}
                </div>

                <div class="card-body js-chat__messages" style="height: 400px; overflow: overlay">
                    <div class="container">
                        @foreach ($chat['messages'] as $message)
                            <div class="row chat-message">
                                <div class="col-auto px-1">
                                    <b>{{ $message->user->name }}</b>
                                </div>
                                <div class="col-auto px-1">
                                    <p><?= $message->message ?>
                                        {{--<span class="badge badge-secondary"><a>ответить</a></span>--}}
                                        @if ($message->canBeDeletedByUser($user))
                                            <span class="badge badge-danger"><a>удалить</a></span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <div class="js-chat__scrollToDown"></div>
                    </div>
                </div>

                {{--<input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                <div class="card-footer p-2">
                    <form class="js-chat__form">
                        <div class="input-group">
                            <input type="text"
                                   class="form-control js-chat__messageInput"
                                   placeholder="Сообщение..."
                                   aria-label="Message" />

                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
