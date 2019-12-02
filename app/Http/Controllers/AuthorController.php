<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Author;

class AuthorController extends Controller{

    //devolver todos los autores
    public function showAllAuthors(Request $request){

        if($request->isjson()){
            return response()->json(Author::all() );
        }

    }

    //devolver un autor en especifico
    public function showOneAuthor($id){

        return response()->json(Author::find($id));
    }
    
    //crear un nuevo autor
    public function create(Request $request){

        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'location' => 'required'

        ]);

        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    //actualizar un autor en especifico
    public function update($id, Request $request){
        $author = Author::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);

    }

    //Eliminar un autor en especifico
    public function delete($id){
        Author::findOrFail($id)->delete();
        return response('Autor Eliminado Correctamente', 200);

    }



}