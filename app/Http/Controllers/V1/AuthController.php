<?php

namespace App\Http\Controllers\V1;

use App\Generator\GeometryLogGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Employe;
use App\Models\Role;
use App\Models\Route;
use App\Models\Town;
use App\Models\User;
use App\Models\UserMarket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);

        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return $this->setStatusCode(200)
                    ->setMessage("User Authenticate")
                    ->responseWithItem($this->guard()->user());
    }

    // Change Password

    public function changePassword(Request $request){
        if(isset($request->old_password)){

        }else{
            return $this->setStatusCode(422)
                        ->setMessage("Current Password Not Provided")
                        ->responseWithError();
        }
        if(isset($request->password)){
            $user=User::find($this->guard()->user()->id);
            if(Hash::check($request->old_password,$user->password)){
                $user->password=Hash::make($request->password);
                $user->save();
            }else{
                return $this->setStatusCode(422)
                            ->setMessage("Old Password Does not Match")
                            ->responseWithError();
            }
            return $this->setStatusCode(200)
                        ->setMessage("Password Change Successfully")
                        ->responseWithSuccess();
        }else{
            return $this->setStatusCode(422)
                        ->setMessage("Password Not Provided")
                        ->responseWithError();
        }
    }

    /**
     * Get User By Id
     */
    public function getSingleUser($id){
        $user=User::where('id',$id)->first();
        return $this->setStatusCode(200)
                    ->setMessage("User Fetch Successfully")
                    ->setResourceName('user')
                    ->responseWithItem($user);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    /**
     * 
     * Register new user
     * required: name,email,password
     * unique: email
     * 
     */
    public function register(RegisterRequest $request){
        DB::beginTransaction();
        try {
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
            DB::commit();
            return $this->setStatusCode(200)
                        ->setMessage("Registration Success !")
                        ->responseWithSuccess();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->setStatusCode(500)
                        ->setMessage($e->getMessage())
                        ->responseWithError();
        }
    }

    public function createUser(RegisterRequest $request){
        DB::beginTransaction();
        try {
            // step-1: create user
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            
            DB::commit();
            return $this->setStatusCode(200)
                        ->setMessage("User Created Successfully")
                        ->setResourceName('user')
                        ->responseWithItem($user);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->setStatusCode(500)
                        ->setMessage($e->getMessage())
                        ->responseWithError();
        }
    }



}
