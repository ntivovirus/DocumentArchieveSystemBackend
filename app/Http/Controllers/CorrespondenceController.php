<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Correspondence;
use Illuminate\Http\Response;


class CorrespondenceController extends Controller
{
    //
    //CORRESPONDENCES
function ListCorrespondences()
{
    // return Correspondence::all();
    return Correspondence::orderByDesc('id')->get();

}

function AddCorrespondences(Request $req)
{
    $correspondence = new Correspondence;
    $correspondence->CORRESPONDENCE_NAME=$req->CorrespondenceNameHolder;
    $correspondence->CORRESPONDENCE_CODENAME = $req->CorrespondenceCodeNameHolder;
    $correspondence->CORRESPONDENCE_DESCRIPTION=$req->CorrespondenceDescriptionHolder;

    $Result = $correspondence->save(); 

    if($Result)
      {
        return["status"=>"success","message"=>"Correspondence added successfully"]; Response::HTTP_OK;
      }
      else{
        return["status"=>"error","message"=>"Error inserting Correspondence"]; Response::HTTP_INTERNAL_SERVER_ERROR;

      }
    
}

function updateCorrespondences(Request $req)
 {
  // return["Zako aise"];
  $correspondence = Correspondence::find($req->id);
  $correspondence->CORRESPONDENCE_NAME = $req->CorrespondenceNameHolder;
  $correspondence->CORRESPONDENCE_CODENAME = $req->CorrespondenceCodeNameHolder;
  $correspondence->CORRESPONDENCE_DESCRIPTION = $req->CorrespondenceDescriptionHolder;

  $result = $correspondence->save();

    if($result) {
      return ["status"=>"success", "message"=>"Correspondence Updated successfully"];
    } 
      else {
        return ["status"=>"error", "message"=>"Error on Correspondence update"];
      }
      
  }

function deleteCorrespondences($id) 
  { 
    $correspondence= Correspondence::find($id);
    $result = $correspondence->delete();  

      if($result) 
        {
          return ["status"=>"success", "message"=>"Record Deleted Successfully"]; Response::HTTP_OK;
        }
        else 
        {
          return ["status"=> "error", "message"=> "Error on Deleting"];Response:: HTTP_INTERNAL_SERVER_ERROR;
        }
  }

function fetchCorrespondenceDetails($id)
{

$correspondence = Correspondence::find($id);
return ["Status"=>"success", "Correspondence"=>$correspondence];Response:: HTTTP_OK;

}

}
