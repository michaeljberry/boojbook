<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\File;
use App\Repositories\BookRepositoryEloquent as Book;

class ApiController extends Controller
{
    protected $bookRepo;

    function __construct(Book $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }
    
    /**
     * @OA\Get(
     *      path="/api/v1/book",
     *      operationId="getBookList",
     *      tags={"Books"},
     *      summary="Get list of books",
     *      description="Returns list of books",
     *	    security={{"bearer_token":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success")
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request")
     * )
     *
     * Returns list of books
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $data['books'] = $this->bookRepo->rawAll("user_id = ? ", [$user_id]);
        $data['message'] = "List of books";
        return response()->json($data);
    }

    /**
	 * @OA\Post(
	 *	path="/api/v1/book",
	 *	operationId="storeBook",
	 *	tags={"Books"},
	 *	summary="Save book details",
	 *	description="",
	 *	security={{"bearer_token":{}}},
	 *	@OA\Parameter(
	 *	   name="title",
	 *	   description="Book title",
	 *	   in="query",
	 *	   required=true,
	 *		 example="Harry Potter"
	 *	),
	 *	@OA\Parameter(
	 *	   name="author",
	 *	   description="Author of the book",
	 *	   in="query",
	 *	   required=true,
	 *		 example="J.K. Rowling"
     *	),
     *  @OA\Parameter(
	 *	   name="date_publish",
	 *	   description="Date the book publish (yyyy-mm-dd)",
	 *	   in="query",
	 *	   required=true,
	 *		 example="1991-02-25"
     *	),
     *	@OA\Response(
	 *	   response="200",
	 *	   description="Success",
	 *     @OA\JsonContent(
	 *        @OA\Property(property="status", type="string", example="success")
	 *     )
     *	),
	 *	@OA\Response(
	 *	   response="401",
	 *	   description="Unauthenticated",
	 *	),
	 * )
	 */
    public function store(BookRequest $request)
    {
        $path = 'uploads/books';
        $field = $request->file('photo');
        $hasfile = $request->hasFile('photo');
        $photo = fileUpload($path, $field, $hasfile);
        $makeRequest = [
            'title' => $request['title'],
            'author' => $request['author'],
            'photo' => $photo,
            'date_publish' => $request['date_publish'],
            'user_id' => $request->user()->id
        ];

        $this->bookRepo->create($makeRequest);
        return response()->json([
            'status' => 200,
            'message' => 'New Book has been added'
        ]);
    }

    /**
	 * @OA\PUT(
	 *	path="/api/v1/book/{id}",
	 *	operationId="updateBook",
	 *	tags={"Books"},
	 *	summary="Update book details",
	 *	description="",
     *	security={{"bearer_token":{}}},
     *  @OA\Parameter(
	 *	   name="id",
	 *	   in="query",
	 *	   required=true
	 *	),
	 *	@OA\Parameter(
	 *	   name="title",
	 *	   description="Book title",
	 *	   in="query",
	 *	   required=true,
	 *		 example="Harry Potter"
	 *	),
	 *	@OA\Parameter(
	 *	   name="author",
	 *	   description="Author of the book",
	 *	   in="query",
	 *	   required=true,
	 *		 example="J.K. Rowling"
     *	),
     *  @OA\Parameter(
	 *	   name="date_publish",
	 *	   description="Date the book publish (yyyy-mm-dd)",
	 *	   in="query",
	 *	   required=true,
	 *		 example="1991-02-25"
     *	),
     *	@OA\Response(
	 *	   response="200",
	 *	   description="Success",
	 *     @OA\JsonContent(
	 *        @OA\Property(property="status", type="string", example="success")
	 *     )
     *	),
	 *	@OA\Response(
	 *	   response="401",
	 *	   description="Unauthenticated",
	 *	),
	 * )
	 */
    public function update(BookRequest $request, $id)
    {
        $id = ($request['id']) ? $request['id'] : $id;
        $book = $this->bookRepo->find($id);
        $makeRequest = [
            'title' => $request['title'],
            'author' => $request['author'],
            'date_publish' => $request['date_publish']
        ];

        $this->bookRepo->update($makeRequest, $id);
        return response()->json([
            'status' => 200,
            'message' => $book->title.' has been updated'
        ]);
    }

    /**
	 * @OA\DELETE(
	 *	path="/api/v1/book/{id}",
	 *	operationId="deleteBook",
	 *	tags={"Books"},
	 *	summary="Delete book",
	 *	description="",
     *	security={{"bearer_token":{}}},
     *  @OA\Parameter(
	 *	   name="id",
	 *	   in="query",
	 *	   required=true
	 *	),
     *	@OA\Response(
	 *	   response="200",
	 *	   description="Success",
	 *     @OA\JsonContent(
	 *        @OA\Property(property="status", type="string", example="success")
	 *     )
     *	),
	 *	@OA\Response(
	 *	   response="401",
	 *	   description="Unauthenticated",
	 *	),
	 * )
	 */
    public function destroy(Request $request, $id)
    {
        $id = ($request['id']) ? $request['id'] : $id;
        $this->bookRepo->delete($id);
        return response()->json([
            'status' => $id,
            'message' => 'Book has been deleted'
        ]);
    }
}
