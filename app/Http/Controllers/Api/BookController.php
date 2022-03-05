<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\Repositories\BaseRepository;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Pipeline\Pipeline;
use App\Http\Resources\Book as BookResource;

class BookController extends BaseRepository
{   
    use BaseResponse;

    public function __construct(Book $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Book::query();
        $books = app(Pipeline::class)
                    ->send($query)
                    ->through([
                        \App\QueryFilters\Name::class,
                        \App\QueryFilters\Country::class,
                        \App\QueryFilters\Publisher::class,
                        \App\QueryFilters\Date::class,
                        ])
                    ->thenReturn()->get();
		
        //dd($posts->get());

        if($books->count() > 0) {
            
            return $this->sendResponse(BookResource::collection($books)
                        ,'Record retrieved successfully.');
        }
        else {
            return $this->sendResponse([],
                        'Sorry no record found for this search');
        }
    }

    public function external_books(Request $request)
    {

        $url = 'https://anapioficeandfire.com/api/books';
        if(!empty($request->name)){
            $url = $url.'?name='.$request->name; 
        }
        $response = Http::get($url);
        if(count($response->json()) > 0) {
            $response = $response->json();
            foreach($response as $res) {
                $data = [
                    'name' =>  $res['name'],
                    'isbn' =>  $res['isbn'],
                    'authors' =>  $res['authors'],
                    'number_of_pages' => $res['numberOfPages'],
                    'publisher' => $res['publisher'],
                    'country' => $res['country'],
                    'release_date'=> $res['released'], 

                ];
                $result[] = $data;
            }
            return $this->sendResponse($result,'Record retrieved successfully.');
        }
        else{
            return $this->sendResponse([],'Sorry No Record Found.');  
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreBookRequest $request)
    {
        try {
            $book = $this->save($request->all());

            return $this->sendResponse(new BookResource($book),
                'Record Added successfully.', 201);

        } catch (ModelNotFoundException $e) {

            throw new InvalidArgumentException($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
     
        $response = $this->find($id);
        return $this->sendResponse(new BookResource($response),
            'Record Added successfully.', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = $this->findAndUpdate($request->all(), $id);
        $response = $this->find($id);
        return $this->sendResponse(new BookResource($response),
            'Record Updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $book = $this->find($id);
        $data = $this->delete($id);
        if($data){
            return $this->sendResponse([],'The book '.$book->name.' was deleted successfully.', 204);
        }
        else{
            return $this->sendError('book not found');
        }
    }
}
