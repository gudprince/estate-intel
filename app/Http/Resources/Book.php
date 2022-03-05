<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\BookAuthor;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => $this->authors,
            'number_of_pages' => $this->number_of_pages,
            'publisher' => $this->publisher,
            'country' => $this->country,
            'release_date' => $this->release_date,
        ];
    }

    private function authors($id){
        $authors =  BookAuthor::where('book_id', $id)->get();
        $response = [];
        foreach($authors as $key => $author){

            $response[$key] = $author->author_name;
        }

        return   $response;
    }
}
