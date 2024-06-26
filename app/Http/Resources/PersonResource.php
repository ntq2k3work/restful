<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    // protected $table = 'persons';
    protected $models = 'Person';
    public function toArray(Request $request): array
    {
        return [
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'Address' => $this->Address,
            'City' => $this->City,
        ];
    }
}
