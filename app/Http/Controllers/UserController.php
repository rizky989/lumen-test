<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\SendResponse;

class UserController extends Controller
{
    public function index(Request $request)
    { 
        try{
            if($request->with){
                $rel = explode(",",$request->with);
                try{
                    $data = User::with($rel)->get();
                }catch (\Exception $e) {
                    return SendResponse::fail('relation tidak ditemukan pada model user', 500);
                }
            }else{
                $data = User::all();
            }
            $response['users'] = $data;
            
            return SendResponse::success($response,200);
        }catch (\Exception $e) {
            return SendResponse::fail("Unable to communicate with database", 500);
        }
    }

    public function view(Request $request, string $user)
    {
        try{
            $data = User::where('fullname','like', '%' . $user . '%')
                    ->orWhere('email','like', '%' . $user . '%')
                    ->first();
            if($data){
                $response['users'] = $data;
                return SendResponse::success($response,200);
            }else{
                return SendResponse::fail(null,404);
            }
        }catch (\Exception $e) {
            return SendResponse::fail("Unable to communicate with database", 500);
        }

    }
}
