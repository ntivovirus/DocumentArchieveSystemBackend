<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\File;
use App\Models\User; 
use App\Models\Correspondence; 
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class DocumentController extends Controller   
{
    //
    function ListDocuments()
{
   
    $documents = Document::orderByDesc('id');
    $documents->with('file:id,FILE_NAME,STATUS,correspondence_id');

    return $documents->with('file.correspondence:id,CORRESPONDENCE_NAME')->get(); 

}

public function AddDocuments(Request $req) // FUNCTION USED IN FILE MODULE
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

    $path = $req->file('DocPathHolder')->store('BTDC-ArchivedDocuments');


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


function fetchDocumentDetails($id)
{

$document = Document::find($id);
$retrivedocname = $document->file->FILE_NAME;

// $retrivecorrespondencename = $file->correspondence->CORRESPONDENCE_NAME;
// return ["Status"=>"success", "File"=>$file, "updateFileCorrespondanceNameSelect"=>$retrivecorrespondencename];Response:: HTTTP_OK;
return ["Status"=>"success", "Document"=>$document, "updateFileCorrespondanceNameSelect"=>$retrivedocname];Response:: HTTTP_OK;


}


function deleteDocuments($id) 
  { 
    $document= Document::find($id);
    $retrievedocpath = $document->DOC_PATH;
    Storage::delete($retrievedocpath);  

    $result = $document->delete();

    

      if($result) 
        {
          return ["status"=>"success", "message"=>"Document Deleted Successfully"]; Response::HTTP_OK;
        }
        else 
        {
          return ["status"=> "error", "message"=> "Error on Deleting"];Response:: HTTP_INTERNAL_SERVER_ERROR;
        }
  }

  function downloadDocuments($id) 
  { 
   
    $document = Document::find($id); 
    
    if ($document) {
        $retrievedocname = $document->DOCUMENT_NAME;
        $retrievedocpath = $document->DOC_PATH;

        if(Storage::exists($retrievedocpath)) {
          $path = Storage::path($retrievedocpath);
          
          return response()->download($path.$retrievedocpath);
            
        }
        return ["status"=> "error", "message"=> "Document not found"];Response:: HTTP_INTERNAL_SERVER_ERROR;
    }
    
    abort(404, 'Document not found');

  }

  function previewDocuments($id) 
  { 
   
    $document = Document::find($id);
    
    if ($document) {
        $retrievedocname = $document->DOCUMENT_NAME;
        $retrievedocpath = $document->DOC_PATH;

        if(Storage::exists($retrievedocpath)) {

          $filePath = storage_path($retrievedocpath);
          $headers= header(['Content-Type','text/plain']);
          
          return response()->file($retrievedocpath);
    
        
        }
        return ["status"=> "error", "message"=> "Document not found"];Response:: HTTP_INTERNAL_SERVER_ERROR;
    }
    
    abort(404, 'Document not found');

  }








function testUpload(Request $reqt)
{

  $doc = $reqt->file('zako')->store('TestingVirus');

  // $tumi = new Document;
  // $tumi ->

  return [$doc];

}

};
