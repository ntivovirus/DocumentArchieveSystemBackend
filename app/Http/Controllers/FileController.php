<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Correspondence;


use Illuminate\Http\Response;



class FileController extends Controller
{
    //
       //CORRESPONDENCES
function ListFiles()
{
    // return Correspondence::all();
    return File::orderByDesc('id')->get();

}

function AddFiles(Request $req)
{
    $correspondenceName = $req->correspondenceHolder;
    
    $correspondence = Correspondence::where('CORRESPONDENCE_NAME',$correspondenceName)->first();
    $file = new File;
    $file->FILE_NAME=$req->FileNameHolder;
    $file->FILE_DESCRIPTION = $req->FileDescriptionHolder;
    $file->STATUS=$req->StatusHolder;
    $file->correspondence_id=$correspondence->id;


    $Result = $file->save(); 

    if($Result)
      {
        return["status"=>"success","message"=>"File added successfully"]; Response::HTTP_OK;
      }
      else{
        return["status"=>"error","message"=>"Error inserting File"]; Response::HTTP_INTERNAL_SERVER_ERROR;

      }
    
}

function updateFiles(Request $req)
 {
  // return["Zako aise"];
  $file = File::find($req->id);
  $file->FILE_NAME = $req->FileNameHolder;
  $file->FILE_DESCRIPTION = $req->FileDescriptionHolder;
  $file->STATUS= $req->FileStatusHolder;
  $file->correspondence_id=$req->CorrespondenceHolder;

  $result = $file->save();

    if($result) {
      return ["status"=>"success", "message"=>"File Updated successfully"];
    } 
      else {
        return ["status"=>"error", "message"=>"Error on File update"];
      }
      
  }

function deleteFiles($id) 
  { 
    $file= File::find($id);
    $result = $file->delete();  

      if($result) 
        {
          return ["status"=>"success", "message"=>"File Deleted Successfully"]; Response::HTTP_OK;
        }
        else 
        {
          return ["status"=> "error", "message"=> "Error on Deleting"];Response:: HTTP_INTERNAL_SERVER_ERROR;
        }
  }

function fetchFilesDetails($id)
{

$file = File::find($id);
return ["Status"=>"success", "File"=>$file];Response:: HTTTP_OK;

}


function test($iwe)
{
 
 $child = File::find(2); 

 return ["Status"=>"success", "data"=>$child->correspondence];


  // if($parentCorr)
  // {
  //   return $corrname = $parentCorr->CORRESPONDENCE_NAME;
  //   return $corrid = $parentCorr->id;
  // } else{
  //   alert ('no data available');
  // }
                                          
  
}

}
