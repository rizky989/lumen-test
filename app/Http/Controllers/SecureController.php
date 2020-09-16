<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Helpers\SendResponse;

class SecureController extends Controller
{
	public function profile(Request $request)
	{
		try{
			$data = User::with('phone')->find(Auth::user()->id);
			
            $response['users'] = $data;
            return SendResponse::success($response,200);
        }catch (\Exception $e) {
            return SendResponse::fail("Unable to communicate with database", 500);
        }
	}
}