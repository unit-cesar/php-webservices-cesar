<?php

namespace App\Soap;

use App\Client;
use App\Types\ClientType;
use Illuminate\Contracts\Support\Arrayable;
use phpDocumentor\Reflection\Types\Object_;
use Zend\Config\Config;
use Zend\Config\Writer\Xml;
use Zend\Stdlib\ArrayObject;

//use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Http\Request;

class ClientsSoapController
{
    /**
     * @return string
     */
    public function listAll()
    {
        return $this->getXML(Client::all());
    }

    /*public function show($id)
    {
        if(!($client = Client::find($id))){
            throw new ModelNotFoundException("Client requisitado não existe");
        }
        return son_response()->make($client);
    }*/

//    /**
//     * @param \App\Types\ClientType $type
//     * @return string
//     */

    protected function getXML($data)
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }
        $config = new Config(['result' => $data], true);
        $xmlWriter = new Xml();
        return $xmlWriter->toString($config);
    }

    /*public function update(Request $request,$id)
    {
        if(!($client = Client::find($id))){
            throw new ModelNotFoundException("Client requisitado não existe");
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $client->fill($request->all());
        $client->save();
        return son_response()->make($client,200);
    }

    public function destroy($id)
    {
        if(!($client = Client::find($id))){
            throw new ModelNotFoundException("Client requisitado não existe");
        }
        $client->delete();
        return son_response()->make("",204);
    }*/




    ///**
    // *
    // * @param array $params Array containing the necessary params.
    // *    $params = [
    // *      'hostname'     => (string) DB hostname. Required.
    // *      'databaseName' => (string) DB name. Required.
    // *      'username'     => (string) DB username. Required.
    // *      'password'     => (string) DB password. Required.
    // *      'port'         => (int) DB port. Default: 1433.
    // *      'sublevel'     => [
    // *          'key' => (\stdClass) Value description.
    // *      ]
    // *    ]
    // */





//* @param array $type Array containing the necessary params.
//*    $type = [
//*      'name'        => (string) DB name. Required.
//*      'email'       => (string) DB email. Required.
//*      'phone'       => (string) DB phone. Required.
//*    ]


    /**
     *
     * @param  \App\Types\ClientType $type
     *
     * @return string
     *
     */
    public function create($type)
    {
        $data = new ClientType;
        $data->name  = $type->name;
        $data->email = $type->email;
        $data->phone = $type->phone;

//        return  serialize($type);
//        return  $type->name;
//        return  gettype($type);

        $client = Client::create((array)$data);
        return $this->getXML($client);
    }
}
