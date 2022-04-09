<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Traits\ApiResponser;


class ClientController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index( Request $request ){
        
        $limit = ($request->has('limit')) ? (int) $request->limit : 10;
        $range_by = ($request->has('range_by')) ? $request->range_by : 'release_date';
        $sortby = ($request->has('sortby')) ? $request->sortby : 'created_at';
        $sorting = ($request->has('sorting')) ? $request->sorting : 'desc';

        $client = Client::orderBy( $sortby , $sorting) ;
        $client = $client->paginate($limit)->appends($request->query());

        return $this->dataResponse("Sucessfully retrieved.", $client);
    }
    
    public function show( $id )
    {   
        dump($client);
        // return $this->dataResponse("Sucessfully retrieved.", ClientResource::collection($client));
    }

    public function update(Request $request, $id)
    {
        //
    }
}
