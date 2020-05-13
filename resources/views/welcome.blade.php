<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            @foreach($paginator as $item)
                <div class="card mb-3">
                    @if($item->is_edited)
                        <p class="text-muted" style="position: absolute; right: 10px; top: 10px;">Изменен администратором</p>
                    @endif
                    @if($item->image_path)
                        <img style="width: 320px; height: 240px" class="card-img-top" src="{{ asset('/storage/uploads/'.$item->image_path) }}" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{ $item->user_name }}</h3>
                        <h5>{{ $item->user_email }}</h5>
                        <p class="card-text">{{ $item->message_text }}</p>
                        @if($item->status == "pending")
                            <a href="#" class="btn btn-success">Принять</a>
                            <a href="#" class="btn btn-danger">Отклонить</a>
                            <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-primary float-sm-right">Редактировать</a>
                        @elseif($item->status == "approved")
                            <span class="badge badge-pill badge-success">Опубликовано</span>
                            <a href="#" class="btn btn-primary float-sm-right">Редактировать</a>
                        @elseif($item->status == "canceled")
                            <span class="badge badge-pill badge-danger">Отклонено</span>
                        @endif
                    </div>
                </div>
            @endforeach
            @if($errors->any())
                <h5 class="text-start text-danger">{{$errors->first()}}</h5>
            @endif
            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    </div>
                </div>
            @endIf
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input name="user_name" type="text" class="form-control mb-3" placeholder="Имя" />
                    <input name="user_email" type="text" class="form-control mb-3" placeholder="Email" />
                    <input class="form-control mb-3" type="file" name="image" />
                    <textarea name="message_text" type="text" style="height: 100px" class="form-control overflow-auto mb-3" id="exampleFormControlTextarea1" placeholder="Текст"></textarea>
                    <input type="submit" value="Оставить отзыв" class="btn btn-outline-success mb-3" />
                </div>
            </form>
            @if($paginator->total() > $paginator->count())
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{ $paginator->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>
