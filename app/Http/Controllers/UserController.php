<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\User;

class UserController extends Controller
{
    //
    function AddUsers(Request $req)
    {
        $getemail = $req->UserEmailHolder;
        $searchemailexistence = User::where('email',$getemail)->first();

        if($searchemailexistence)
        {
            return["status"=>"error","message"=>"Email Already Used"]; Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        else{
            $user = new User;
            $user->name=$req->UserfullnameHolder;
            $user-> email=$req->UserEmailHolder;
            $user->password=$req->UserPasswordHolder;
            $user->role=$req->UserRoleHolder;

            $result = $user->save();

            if($result)
            {
                return["status"=>"success","message"=>"User added successfully"]; Response::HTTP_OK;
            }
            else{
                    return["status"=>"error","message"=>"Error adding User"]; Response::HTTP_INTERNAL_SERVER_ERROR;
            }
        }
                
            

    }

    function ListUsers()
    {
        return User::orderByDesc('id')->get();
    }

    function fetchUserDetails($id)
{

$user = User::find($id);
return ["Status"=>"success", "User"=>$user];Response:: HTTTP_OK;

}


function updateUsers(Request $req)
 {

  $user = User::find($req->id);
  $user->name = $req->UserFullNameHolder;
  $user->email = $req->UserEmailHolder;
  $user->role = $req->UserRoleHolder;

  $result = $user->save();

    if($result) {
      return ["status"=>"success", "message"=>"User Updated successfully"];
    } 
      else {
        return ["status"=>"error", "message"=>"Error on User update"];
      }
      
  }

  function deleteUsers($id) 
  { 
    $user= User::find($id);
    $result = $user->delete();  

      if($result) 
        {
          return ["status"=>"success", "message"=>"User Deleted Successfully"]; Response::HTTP_OK;
        }
        else 
        {
          return ["status"=> "error", "message"=> "Error on Deleting User"];Response:: HTTP_INTERNAL_SERVER_ERROR;
        }
  }

     
      
}
