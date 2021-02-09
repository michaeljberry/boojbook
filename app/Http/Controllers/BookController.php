<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repositories\BookRepositoryEloquent as Book;

class BookController extends Controller
{
    protected $bookRepo;

    function __construct(Book $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $data['books'] = $this->bookRepo->rawAll("user_id = ? ", [$user_id]);
        return view('welcome', $data);
    }

    public function store(BookRequest $request)
    {
        $id = $request['id'];
        if($id){
            $book = $this->bookRepo->find($id);
            $makeRequest = [
                'title' => $request['title'],
                'author' => $request['author'],
                'date_publish' => $request['date_publish']
            ];

            $this->bookRepo->update($makeRequest, $id);
            return redirect()->back()->with('msg', $book->title.' has been updated');
        } else {
            $makeRequest = [
                'title' => $request['title'],
                'author' => $request['author'],
                'date_publish' => $request['date_publish'],
                'user_id' => Auth::user()->id
            ];

            $this->bookRepo->create($makeRequest);
            return redirect()->back()->with('msg', 'New Book has been added');
        }        
    }

    public function show($id)
    {
        $book = $this->bookRepo->find($id);
        $content = '';
        $content .= '<div class="media">';
            $content .= '<img class="mr-3" style="width: 150px;" src="'.url($book->photo).'" alt="'.$book->title.'">';
            $content .= '<div class="media-body">';
                $content .= '<h5 class="mt-0">'.$book->title.'</h5>';
                $content .= '<p class="mb-0"><b>Author: </b>'.$book->author.' <br> <b>Date Publish: </b>'.$book->date_publish_display.'</p>';
            $content .= '</div>';
        $content .= '</div>';
        $data['bookContent'] = $content;
        $data['response'] = 1;
        return response()->json($data);
    }

    public function edit($id)
    {
        $data['book'] = $this->bookRepo->find($id);
        $data['response'] = 1;
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->bookRepo->delete($id);
        $data['response'] = 1;
        return response()->json($data);
    }

    public function sort(Request $request)
    {
        $i = 1;
        foreach ($_POST['item'] as $value) {
            $book = $this->bookRepo->find($value);
            $book->order_id = $i;
            $book->save();
            $i++;
        }
    }
}
