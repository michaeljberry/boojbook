<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepositoryEloquent as Book;

class HomeController extends Controller
{
    protected $bookRepo;

    public function __construct(Book $bookRepo)
    {
        $this->middleware('auth');
        $this->bookRepo = $bookRepo;
    }

    public function index()
    {
        $data['books'] = $this->bookRepo->all();
        return view('home', $data);
    }
}
