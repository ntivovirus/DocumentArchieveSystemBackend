<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function Login(Request $reqs)
    {
      // $emailfind = $reqs->userLoginEmailHolder;
      // $passwordfind = $reqs->userLoginEmailHolder;

      $user = User::where('email',$reqs->email)->first();

      if($user){

        if(!$user || !Hash::check($reqs->password,$user->password)) {
          // return response(['status'=>['error'],'message' => ['Wrong Password, Please rethink']],404);
        return ["status"=>"error", "message" => "Wrong Password"];

        }

        else{

        $checkUserAccountstatus =$user->account_status;

        if($checkUserAccountstatus==='DEACTIVATED')
        {
        return ["status"=>"error", "message" => "Your Account is Deactivated !!!. You no longer have access to this system"];


        }
        else if($checkUserAccountstatus==='ACTIVE')
        {
          $token = $user->createToken('my-app-token')->plainTextToken;

          $response = [
            'user' => $user,
            'token' => $token,
            'message'=>'You are Logged in Successfully'
          ]; 
  
          return response ($response, 201);
  
          }
          else{

          return ["status"=>"error", "message" => "Opps! Something Wrong at our end"];

          }

        }
        

      }
      else{
       
        return ["status"=>"error", "message" => "This is not a registered email address in our system"];

      }
    
    }

    function DashUserCount()
    { 
      return User::count('id');

    }

    function AddUsers(Request $req)
    {
        $getemail = $req->UserEmailHolder;
        $searchemailexistence = User::where('email',$getemail)->first();

        if($searchemailexistence)
        {
            // return["status"=>"error","message"=>"Email Already Used"]; Response::HTTP_INTERNAL_SERVER_ERROR;
            return ["status"=>"error", "message" => "Email Already Used"];

        }
        else{
            $user = new User;
            $user->name=$req->UserfullnameHolder;
            $user-> email=$req->UserEmailHolder;
            $user->password=Hash::make($req->UserPasswordHolder);
            $user->role=$req->UserRoleHolder;
            $user->account_status=$req->UserStatusHolder;

            $result = $user->save();

            if($result)
            {
                return["status"=>"success","message"=>"User added successfully"]; Response::HTTP_OK;
            }
            else{
                    // return["status"=>"error","message"=>"Error adding User"]; Response::HTTP_INTERNAL_SERVER_ERROR;
                return ["status"=>"error", "message" => "Error adding User"];

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
return ["status"=>"success", "User"=>$user];Response:: HTTTP_OK;

}


function updateUsers(Request $req)
 {

  // $getemail = $req->UserEmailHolder;
  // $searchemailexistence = User::where('email',$getemail)->first();

  // if($searchemailexistence){

  //   return ["status"=>"error", "message" => "Email Already Used"];

  // }
  // else{

    $user = User::find($req->id);
  $user->name = $req->UserFullNameHolder;
  $user->email = $req->UserEmailHolder;
  $user->role = $req->UserRoleHolder;
  $user->account_status = $req->UserStatusHolder;


  $result = $user->save();

    if($result) {
      return ["status"=>"success", "message"=>"User Updated successfully"];
    } 
      else {
        return ["status"=>"error", "message"=>"Error on User update"];
      }

  // }
      
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
