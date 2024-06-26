<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'persons' => $this->collection,
            'links' => [
                "first" => "http://127.0.0.1:8000/api/persons?page=1",
                "last" => "http://127.0.0.1:8000/api/persons?page=".$this->lastPage(),
                "prev" => ($this-> currentPage() > 1 ? "http://127.0.0.1:8000/api/persons?page=".$this->currentPage()-1 : null),
                "next" => ($this-> currentPage() < $this->lastPage() ? "http://127.0.0.1:8000/api/persons?page=".$this->currentPage()+1 : null),
            ],
        ];
    }
}
