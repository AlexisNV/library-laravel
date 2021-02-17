@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top:40px">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    Registrar préstamo
                </div>
                <div class="card-body" style="padding:30px">

                    <form action="{{ route('library.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="users">Usuario</label>
                            <select class="form-control" id="users" name="users">
                                <option selected>Selecciona un usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="books">Libro</label>
                            <select class="form-control" id="books" name="books">
                                <option selected>Selecciona un libro</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }} -- {{ $book->author }} -- {{ $book->editorial }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                                Registrar préstamo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
