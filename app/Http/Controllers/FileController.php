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
    // return File::orderByDesc('id')->get(); // OG CODE
   
    $file = File::orderByDesc('id');

    return $file->with('correspondence')->get(); 
    

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

function updateFiles(Request $req,$id)
 {
  // return["Zako aise"];
  $correspondenceName = $req->correspondenceHolder;
  $correspondence = Correspondence::where('CORRESPONDENCE_NAME',$correspondenceName)->first();

  $file = File::find($id);
  $file->FILE_NAME = $req->FileNameHolder;
  $file->FILE_DESCRIPTION = $req->FileDescriptionHolder;
  $file->STATUS= $req->StatusHolder;
  // $file->correspondence_id=$req->CorrespondenceHolder;
  $file->correspondence_id=$correspondence->id;


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

    if($file)
    {
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
    else{
      return ["status"=> "error", "message"=> "File Not Found"];
    }
    
  }

function fetchFileDetails($id)
{

    $file = File::find($id);

    if($file)
    {
      $retrivecorrespondencename = $file->correspondence->CORRESPONDENCE_NAME;
      return ["Status"=>"success", "File"=>$file, "updateFileCorrespondanceNameSelect"=>$retrivecorrespondencename];Response:: HTTTP_OK;
    }
    else{
      return ["status"=> "error", "message"=> "File Not Found"];
    }
    
    
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
