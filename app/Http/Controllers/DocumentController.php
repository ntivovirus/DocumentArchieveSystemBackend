<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\File;
use App\Models\User; 
use App\Models\Correspondence; 


class DocumentController extends Controller  
{
    //
    function ListDocuments()
{
    // return Correspondence::all();
    // return Document::orderByDesc('id')->get(); //OG 

    //CODE FOR DISPLAYING FILE NAME IN TABLE

    // $documents = Document::orderByDesc('id');

    // return $documents->with('file:id,FILE_NAME,STATUS,correspondence_id')->get();

    //END CODE FOR DISPLAYING FILE NAME IN TABLE

    $documents = Document::orderByDesc('id');

    $comments = $user->posts()->with('comments')->get()->pluck('comments')->flatten();
    $comments = $user->posts()->with('comments')->get()->pluck('comments')->flatten();



}

public function AddDocuments(Request $req)
{

          $fileName = $req->FileHolder;
          // $docDoc = $req->DocPathHolder;
          // $actorName = $req->actorHolder;  //TO BE ENABLED WHEN LOGIN IS ADDED
          
          // $filenames =[];
          // if($req->hasFile('DocPathHolder')) {

          //   $files = $req->file('DocPathHolder');

          //   return["status"=>"success","message"=>'has file'];
            
          // }
          // return["status"=>"success","message"=>$filenames];
         

          $file = File::where('FILE_NAME',$fileName)->first();

       

          
  //         console.log($file);

if($req->hasFile('DocPathHolder')) {

    $path = $req->file('DocPathHolder')->store('ArchivedDocuments');


    // console.log($doc);
    // $user = User::where('email',$actorName)->first(); //TO BE ENABLED WHEN LOGIN IS ADDED

    $document = new Document;
    $document->DOCUMENT_NAME=$req->DocumentNameHolder;
    $document->FOLIO_NUMBER=$req->FolioNumberHolder;
    $document->DOC_PATH=$path;
    $document->file_id=$file->id;
    // $document->user_id=$user->id;   //TO BE ENABLED WHEN LOGIN IS ADDED

    $Result = $document->save(); 

    if($Result)
      {
        return["status"=>"success","message"=>"Document added successfully"]; Response::HTTP_OK;
      }
      else{
        return["status"=>"error","message"=>"Error adding Document"]; Response::HTTP_INTERNAL_SERVER_ERROR;

      }

  }
    return response()->json(['message' => 'No file uploaded'], 400);
     
}

function testUpload(Request $reqt)
{

  $doc = $reqt->file('zako')->store('TestingVirus');

  // $tumi = new Document;
  // $tumi ->

  return [$doc];

}

};
