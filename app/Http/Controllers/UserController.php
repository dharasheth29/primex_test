<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $users = DB::table('user_roles AS ur')
            ->rightjoin('users AS u', 'u.role_id', 'ur.id')
            ->select('u.id', 'u.firstname', 'u.lastname', 'u.company', 'u.email', 'ur.role')
            ->get();

        return response()->json($users);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'company' => 'required|string|max:50',
            'role' => 'required|string|max:50',
        ]);

        $role = DB::table('user_roles AS ur')
            ->select('ur.id')
            ->where('ur.role', '=', strtoupper($request->role))
            ->first();

        if (empty($role)) {
            return response()->json(['status' => 'error', 'message' => 'This role is not defined in our database.'], 401);
        } else {
            $user = new User;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->company = $request->company;
            $user->role_id = $role->id;

            $user->save();

            return response()->json($user);
        }
    }

    public function show($id)
    {
        $user = DB::table('user_roles AS ur')
            ->rightjoin('users AS u', 'u.role_id', 'ur.id')
            ->select('u.id', 'u.firstname', 'u.lastname', 'u.company', 'u.email', 'ur.role')
            ->where('u.id', '=', $id)
            ->get();
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'company' => 'required|string|max:50',
            'role' => 'required|string|max:50',
        ]);

        $role = DB::table('user_roles AS ur')
            ->select('ur.id')
            ->where('ur.role', '=', strtoupper($request->role))
            ->first();

        if (empty($role)) {
            return response()->json(['status' => 'error', 'message' => 'This role is not defined in our system.'], 401);
        } else {
            $user = User::find($id);
            if (empty($user)) {
                return response()->json(['status' => 'error', 'message' => 'This user does not exist in our system.'], 401);
            } else {
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->company = $request->company;
                $user->role_id = $role->id;

                $user->save();

                return response()->json($user);
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('user removed successfully');
    }
}

