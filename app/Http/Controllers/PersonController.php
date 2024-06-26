<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    public function index()
    {
        $person  = Person::paginate(5) ;
        $rs = PersonResource::collection($person) -> response() -> getData(true);
        // $rs =  new PersonCollection($person);
        return response() -> json([
            'status' =>  Response::HTTP_OK,
            'data' => $rs
        ],Response::HTTP_OK);
    }
    public function store(CreatePersonRequest $request)
    {
        $person = Person::create($request -> validated());
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Thêm thành công !',
            'data' => $person
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $person = Person::findOrFail($request->id);
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $person
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, string $id)
    {
        $person = Person::find($id);
        if($person){
            $person -> update($request -> all());
            return response()->json([
                'status' =>  Response::HTTP_OK,
                'data' => $person
            ], Response::HTTP_OK);
        }else{
            return response()->json([
               'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = Person::find($id);
        if($person){
            $person -> delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success'
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status' => 404,
               'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
    public function search(Request $request)
    {
        $person = Person::where('FirstName','LIKE','%'.$request-> keyword.'%')->orWhere('LastName','LIKE','%'.$request-> keyword.'%') -> get();
        if($person){
            return response()->json([
                'status' => 200,
                'data' => $person,
            ],Response::HTTP_OK);
        }else{
            return response()->json([
               'status' => Response::HTTP_NOT_FOUND,
               'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
