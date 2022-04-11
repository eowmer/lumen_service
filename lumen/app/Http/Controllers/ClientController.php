<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ClientResource;
use App\Traits\ApiResponser;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\DeleteRequest;
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
        $sortby = ($request->has('sortby')) ? $request->sortby : 'created_at';
        $sorting = ($request->has('sorting')) ? $request->sorting : 'desc';

        $client = Client::orderBy( $sortby , $sorting) ;
        $client = $client->paginate($limit)->appends($request->query());

        return $this->dataResponse("Sucessfully retrieved.", $client);
    }
    
    public function show(Client $client )
    {       
        return $this->dataResponse("Sucessfully retrieved.", new ClientResource($client));
    }

    public function update(Client $client  , ClientRequest $request)
    {
        $request = $request->validated();
        $request['password'] = Hash::make($request['password']);
        
        if($client){
            $client->update($request);
            return $this->dataResponse("Sucessfully updated.", new ClientResource($client));
        }
        return $this->errorResponse("Client not found.");
    }
    public function store(ClientRequest $request)
    {
        $request = $request->validated();
        $request['password'] = Hash::make($request['password']);
        $client = Client::create($request);  
        return $this->dataResponse("Sucessfully created.", new ClientResource($client));
    }

    public function destroy(DeleteRequest $request)
    {
        $ids = $request->id;
        $clients = Client::whereIn('_id', $ids)->delete();
        return $this->dataResponse("Sucessfully deleted.",$clients);
    }
    
}
