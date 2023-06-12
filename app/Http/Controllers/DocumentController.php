<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\File;
use App\Models\User;


class DocumentController extends Controller
{
    //
    function ListDocuments()
{
    // return Correspondence::all();
    return Document::orderByDesc('id')->get();

}

function AddDocuments(Request $req)
{
    $fileName = $req->fileHolder;
    $actorName = $req->actorHolder;

    $file = File::where('FILE_NAME',$fileName)->first();
    $user = User::where('email',$actorName)->first();

    $document = new Document;
    $document->DOCUMENT_NAME=$req->DocumentNameHolder;
    $document->FOLIO_NUMBER=$req->FolioNumberHolder;
    $document->file_id=$file->id;
    $document->user_id=$user->id;

    $Result = $document->save(); 

    if($Result)
      {
        return["status"=>"success","message"=>"Document added successfully"]; Response::HTTP_OK;
      }
      else{
        return["status"=>"error","message"=>"Error adding Document"]; Response::HTTP_INTERNAL_SERVER_ERROR;

      }
    
}

}
