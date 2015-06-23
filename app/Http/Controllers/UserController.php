<?php 
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User as User; //loads the User model
use Illuminate\Http\Request; //loads the Request class for retrieving inputs
use Illuminate\Support\Facades\Hash; //load this to use the Hash::make method

class UserController extends BaseController
{
	public function index(){ //Get all records from users table
		return User::all();
	}

	public function show($id){ //Get a single record by ID
		return User::find($id); 
	}

	/* The -C- Part */
	public function store(Request $request){ //Insert new record to users table
		$this->validate($request, [
			'email'  => 'required|unique:users',
			'password' => 'sometimes',
			'name'  => 'required',
			'address' => 'required',
			'phone'  => 'required'
		]); 
		$user   = new User;
		$user->email  = $request->input('email');
		$user->password  = Hash::make( $request->input('password') );
		$user->name  = $request->input('name');
		$user->address  = $request->input('address');
		$user->phone  = $request->input('phone');
		$user->save();
	}

	public function update(Request $request, $id){ //Update a record
		$this->validate($request, [
			'email'  => 'required',
			'password' => 'sometimes',
			'name'  => 'required',
			'address' => 'required',
			'phone'  => 'required'
		]); 
		$user    = User::find($id);
		$user->email   = $request->input('email');
		if($request->has('password')){
			$user->password = Hash::make( $request->input('password') );
		}
		$user->name   = $request->input('name');
		$user->address   = $request->input('address');
		$user->phone   = $request->input('phone');
		$user->save();
	}

	public function destroy(Request $request){
		$this->validate($request, [
			'id' => 'required|exists:users'
		]);
		$user = User::find($request->input('id'));
		$user->delete();
	}
}