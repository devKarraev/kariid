@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    @endIf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <a href="{{ route('admin.index') }}">Комментарии</a>
                    <form method="post" class="float-right" action="{{ route('admin.search') }}">
                        @csrf
                        <input required type="text" name="search" />
                        <input type="submit" value="поиск" />
                    </form>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!count($userMessages))
                        <div>Пусто</div>
                    @endif
                    @foreach($userMessages as $message)
                        <div class="card mb-3" >
                            <div class="card-body">
                                <h3 class="card-title">{{ $message->user_name }}</h3>
                                <h5>{{ $message->user_email }}</h5>
                                @if($message->image_path)
                                    <img style="width: 320px; height: 240px" class="card-img-top" src="{{ asset('/storage/uploads/'.$message->image_path) }}" alt="Card image cap">
                                @endif
                                <p class="card-text">{{ $message->message_text }}</p>
                                @if($message->status == "pending")
                                    <a href="{{ route('admin.accept', $message->id) }}" class="btn btn-success">Принять</a>
                                    <a href="{{ route('admin.cancel', $message->id) }}" class="btn btn-danger">Отклонить</a>
                                    <a href="{{ route('admin.edit', $message->id) }}" class="btn btn-primary float-sm-right">Редактировать</a>
                                @elseif($message->status == "approved")
                                    <span class="badge badge-pill badge-success">Опубликовано</span>
                                    <a href="{{ route('admin.edit', $message->id) }}" class="btn btn-primary float-sm-right">Редактировать</a>
                                @elseif($message->status == "canceled")
                                    <span class="badge badge-pill badge-danger">Отклонено</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($userMessages->total() > $userMessages->count())
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{ $userMessages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
