@extends('layouts.app')
@section('content')
    <div class="container" id="app-2">
        <div class="row justify-content-center">
            <div class="col-md-12" id="app">
                @if(Auth::user()->role === 'USER')
                <h1>Tus préstamos: </h1>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">Fecha de préstamo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <th scope="row">{{ $loan->title}}</th>
                            <td>{{ $loan->author }}</td>
                            <td>{{ $loan->editorial }}</td>
                            <td>{{ $loan->pivot->loan_date }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">{{ $loans->links() }}</td>
                        </tr>
                    </tfoot>
                </table>
                @elseif(Auth::user()->role === 'ADMIN')
                    @if(session('message'))
                        <script> window.flashMessage = "{{ session('message') ?? '' }}"</script>
                        <snackbar-component></snackbar-component>
                    @endif
                    <h1>Todos los préstamos: </h1>
                    <br>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Editorial</th>
                            <th scope="col">Fecha de préstamo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->name}}</th>
                                    <td >{{ $user->lastname}}</td>
                                    <td>{{ $user->title}}</td>
                                    <td>{{ $user->author }}</td>
                                    <td>{{ $user->editorial }}</td>
                                    <td>{{ $user->loan_date }}</td>
                                    <td>
                                        <form action="{{ url('/library/delete/'. $user->userId . '/' . $user->bookId) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                    <td><a type="button" class="btn btn-warning" href="{{ url('/library/edit/'. $user->userId . '/' . $user->bookId) }}">Modificar</a></td>
                                </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <a type="button" class="btn btn-primary" href="{{ route('library.create') }}">Registrar préstamo</a>
                                    <a type="button" class="btn btn-primary" href="">Añadir libro</a>
                                </td>
                                <td>
                                    {{ $users->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
