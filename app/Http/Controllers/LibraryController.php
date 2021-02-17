<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Auth;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    //

    public function index(){
        if(Auth::user()->role === 'ADMIN') {
            $loans = \DB::table('book_user')
                ->join('users', 'book_user.user_id', '=', 'users.id')
                ->join('books', 'book_user.book_id', '=', 'books.id')
                ->select('users.id AS userId', 'users.name', 'users.lastname' , 'books.id AS bookId', 'books.title', 'books.author', 'books.editorial' , 'book_user.loan_date')
                ->paginate(5);
            return view('library.index', ['users' => $loans]);
        } else {
            $userID = Auth::user()->id;
            $user = User::find($userID);
            $loans = $user->books()->paginate(3);
            return view('library.index', ['loans' => $loans]);
        }
    }

    public function getCreate(){
        if(Auth::user()->role !== 'ADMIN'){
            return redirect('/library');
        }
        $users = User::all();
        $books = Book::all();
        return view('library.create', ['users' => $users, 'books' => $books]);
    }

    public function getEdit($userId, $bookId){
        if(Auth::user()->role !== 'ADMIN'){
            return redirect('/library');
        }
        $userToEdit = User::find($userId);
        $bookToEdit = Book::find($bookId);
        $users = User::all();
        $books = Book::all();
        return view('library.edit', ['users' => $users, 'books' => $books, 'userToEdit' => $userToEdit, 'bookToEdit' => $bookToEdit]);
    }

    public function store(Request $request){
        $user = User::find($request->users);
        $bookID = $request->books;
        $now = Date('Y-m-d');
        if(!$user->books->contains($bookID)) {
            $user->books()->attach($bookID, ['loan_date' => $now]);
            session(['message' => 'Datos insertados correctamente.']);
        } else {
            session(['message' => 'ERROR: Ese usuario ya tiene ese libro asignado.']);
        }

        return redirect('/library');
    }

    public function delete($userId, $bookId){
        $user = User::find($userId);
        $user->books()->detach($bookId);
        session(['message' => 'Préstamo eliminado con éxito.']);
        return redirect('/library');
    }

    public function update($userId, $bookId, Request $request){
        $user = User::find($userId);
        if(!$user){
            session(['message' => 'ERROR: Usuario no encontrado.']);
        }
        $now = Date('Y-m-d');
        $user->books()->updateExistingPivot($bookId, ['user_id' => $request->users, 'book_id' => $request->books,'loan_date' => $now]);
        session(['message' => 'Préstamo actualizado con éxito.']);
        return redirect('/library');
    }
}
