@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирования комментария</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <h5 class="text-center text-danger">{{$errors->first()}}</h5>
                        @endif
                        <form method="POST" action="{{ route('admin.update', $userMessage->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <input name="user_name" type="text" value="{{ $userMessage->user_name }}" class="form-control mb-3" id="exampleFormControlTextarea1" placeholder="Имя"/>
                                <input name="user_email" type="text" value="{{ $userMessage->user_email }}" class="form-control mb-3" id="exampleFormControlTextarea1" placeholder="Email"/>
                                <textarea name="message_text" type="text" style="height: 100px" class="form-control overflow-auto" id="exampleFormControlTextarea1" placeholder="Текст">{{ $userMessage->message_text }}</textarea>
                            </div>
                            <input type="submit" value="Изменить" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
