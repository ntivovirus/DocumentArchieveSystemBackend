<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\File;
use App\Models\User; 
use App\Models\Correspondence; 
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Spatie\PdfToText\Pdf;  // ADDED THIS LIBRARY FOR PDF MEDIA USE
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// use Illuminate\Support\Facades\Response;
 

class DocumentController extends Controller   
{
    //
    // use InteractsWithMedia; // added for spatie


    function DashDocumentCount()
{
  return Document::count('id');

}

    function ListDocuments()
{ 

  $documents = Document::orderByDesc('id')->with(['user:id,name','file:id,FILE_NAME,STATUS,correspondence_id', 'file.correspondence:id,CORRESPONDENCE_NAME'])->get();

  return $documents;

   ////////////// A BLOCK OF WORKING CODE ALSO BUT PREFFERED THE SINGLE LINE CODE ////////////////////
                  // $documents = Document::orderByDesc('id'); //OG
                  // $documents->with('file:id,FILE_NAME,STATUS,correspondence_id'); //OG
                  // $documents->with('user:id,name'); //OG

                  //return $documents;

    ////////////// END OF A BLOCK OF WORKING CODE ALSO BUT PREFFERED THE SINGLE LINE CODE ////////////////////

   


}

function AddDocuments(Request $req) // FUNCTION USED IN FILE MODULE
{

          $fileName = $req->FileHolder;
          // $docDoc = $req->DocPathHolder;
          $actorName = $req->actorHolder;  //TO BE ENABLED WHEN LOGIN IS ADDED

          $file = File::where('FILE_NAME',$fileName)->first();
          $CheckFileStatus = $file->STATUS; // checking file status before adding document

          if($CheckFileStatus==='CLOSED'){
        return["status"=>"info","message"=>"File is CLOSED. You cannot add a document in a Closed File, To add a Document in this file please ask the Administrator to change the File state to OPEN"]; 

          }
          else{
          
if($req->hasFile('DocPathHolder')) {

    $path = $req->file('DocPathHolder')->store('BTDC-ArchivedDocuments');

    $user = $actorName; //TO BE ENABLED WHEN LOGIN IS ADDED

    $document = new Document;
    $document->DOCUMENT_NAME=$req->DocumentNameHolder;
    $document->FOLIO_NUMBER=$req->FolioNumberHolder;
    $document->DOC_PATH=$path;
    $document->file_id=$file->id; 
    $document->user_id=$user;   //TO BE ENABLED WHEN LOGIN IS ADDED

    if($document===''){
      return["status"=>"error","message"=>"Please Add particulars for the document"];


    }

    $Result = $document->save(); 

    if($Result){
      
        return["status"=>"success","message"=>"Document added successfully"]; Response::HTTP_OK;
      }
      else {
        return["status"=>"error","message"=>"Error adding Document"]; Response::HTTP_INTERNAL_SERVER_ERROR;

      }

  }
    return response()->json(["status"=>"error", "message" => "Please select a Document to uploaded"]);

}
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
    
    if($document) {
        $retrievedocname = $document->DOCUMENT_NAME;
        $retrievedocpath = $document->DOC_PATH;

        if(Storage::exists($retrievedocpath)) {
          $path = Storage::path($retrievedocpath);
          
          return response()->download($path);
            
        }
        else{
            return ["status"=> "error", "message"=> "Document does not exist in our server"];Response:: HTTP_INTERNAL_SERVER_ERROR;
        }
    }
    else{
    abort(404, 'Document not found');

    }
    

  }

  // function previewDocuments($id)  
  // { 
   
  //   $document = Document::find($id);
    
  //   if ($document) {
  //       $retrievedocname = $document->DOCUMENT_NAME;
  //       $retrievedocpath = $document->DOC_PATH; 

  //       if(Storage::exists($retrievedocpath)) { 

  //         // $filePath = storage_path('app/BTDC-ArchivedDocuments/iFal9c0cNbKZxL4Jul1T9dOidJ73KIlMzI1pUbIi.pdf');

  //          $filePath = storage_path('app/'.$retrievedocpath);
  //          return ["DocPathFromAPI"=>$filePath];Response:: HTTTP_OK;
  //         // return response()->file($filePath);

  //         // return Response::file($filePath, [
  //         //     'Content-Type' => 'application/pdf',
  //         //     'Content-Disposition' => "inline; filename=$retrievedocname"
  //         // ]);

  //         // $fileContents = Storage::get($retrievedocpath);
  //         // $response = Response::make($fileContents, 200);
  //         // $response->header('Content-Type', 'application/pdf');
  
  //         // return $response;

        
  //       }
  //       else{
  //         return ["status"=> "error", "message"=> "Error in accessing Document"];Response:: HTTP_INTERNAL_SERVER_ERROR;
  //       }

  //   }
  //   else{
  //     return ["status"=> "error", "message"=> "It seems Document is not in our space"];Response:: HTTP_INTERNAL_SERVER_ERROR;
    

  //   }
    

  // }


  // function previewDocuments()
  // { 
  //         // $filePath = storage_path($retrievedocpath);
  //         // return response()->file($filePath);
  //         $file = "somanjeAfforestation.pdf";
  //         $path = storage_path('app/BTDC-ArchivedDocuments/'.$file);
  //         return response()->file($path);

  // }

  // function previewDocumentDownload() // TESTING STATIC DOWNLOAD FUNCTION BISHOP CODE
  // {
  //     $fileName = "somanjeAfforestation.pdf";
  //     $filePath = storage_path('app/BTDC-ArchivedDocuments/' . $fileName);
  
  //     if (file_exists($filePath)) {
  //       // Set the appropriate MIME type based on file type
  //       $mime = mime_content_type($filePath);

  //       return response()->file($filePath, [
  //           'Content-Type' => $mime,
  //       ]);
  //   } else {
  //       // File not found, return an error response or perform error handling
  //       return response()->json(['error' => 'File not found'], 404);
  //   }
  // }


  /// OG PREVIEW
  function previewDocuments($id)  
  { 
   
    $document = Document::find($id);
    
    if ($document) {
        $retrievedocname = $document->DOCUMENT_NAME;
        $retrievedocpath = $document->DOC_PATH; 

        if(Storage::exists($retrievedocpath)) { 

          $contents = Storage::disk('local')->get($retrievedocpath);
          
        $text = (new Pdf())->setPdf($contents)->text();

        echo $text;
        // return[$text];
        
        }
        else{
          return ["status"=> "error", "message"=> "Error in accessing Document"];Response:: HTTP_INTERNAL_SERVER_ERROR;
        }

    }
    else{
      return ["status"=> "error", "message"=> "It seems Document is not in our space"];Response:: HTTP_INTERNAL_SERVER_ERROR;
    

    }
    

  }

  ///// END OG PREVIEW







function testUpload(Request $reqt)
{

  $doc = $reqt->file('zako')->store('TestingVirus');

  // $tumi = new Document;
  // $tumi ->

  return [$doc];

}

};
