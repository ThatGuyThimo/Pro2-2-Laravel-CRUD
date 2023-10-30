<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function registerUser(Request $request) {


        $validated = $request->validate([
            'username' => 'required|max:16',
            'email' => 'required|max:50',
            'password' => 'required|max:32',
        ]);

        $reqEmail = DB::table('users')->where('email', $validated['email'])->first();
        if ($reqEmail) {
            return view("register", [ 'error' => "Email already registered"]);
        }

        function createUuid() {
            $uuid = Str::uuid()->toString();
            $reqUuid = DB::table('users')->where('uuid', $uuid)->first();

            if (!$reqUuid) {
            return $uuid;
            } else {
                createUuid();
            }
        }



        $validated["UUID"] = createUuid();
        $validated["level"] = 0;
        $validated["password"] = bcrypt($validated["password"]);
        $validated["created_at"] = date('Y-m-d H:i:s');
        $validated["updated_at"] = date('Y-m-d H:i:s');
        print_r($validated);

        DB::table('users')->insert($validated);

        return redirect("login");
    }

    public function editProfile(Request $request) {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $validated = $request->validate([
                'username' => 'required|max:16',
                'email' => 'required|max:50',
                'password' => 'required|max:32',
            ]);

            $query = [];

            if($request['password'] == null) {
                $query["username"] = $request['username'];
                $query["email"] = $request['email'];
            } else {
                $query["username"] = $request['username'];
                $query["email"] = $request['email'];
                $query['password'] = bcrypt($request['password']);
            }

            $reqUuid = DB::table('users')->where('uuid', $uuid)->update($query);

            if($reqUuid) {


                return redirect('editprofile');

            }

        } else {
            return redirect('login');
        }
    }

    public function loginUser(Request $request) {

        $validated = $request->validate([
            'email' => 'required|max:50',
            'password' => 'required|max:32',
        ]);

        $reqEmail = DB::table('users')->where('email', $validated['email'])->first();

        if (!$reqEmail) {
            return view("login", [ 'error' => "Email or password is incorrect"]);
        } else {
            $pwVerify = password_verify($validated['password'], $reqEmail->password);
            if ($pwVerify) {

                $reqVisits = DB::table('visits')->where('user_id', $reqEmail->uuid)->first();

                if($reqVisits) {
                    $reqVisits = $reqVisits->visits;
                } else {
                    $reqVisits = 0;
                }

                session()->flush();

                session([
                    "username" => $reqEmail->username,
                    "email" => $reqEmail->email,
                    "uuid" => $reqEmail->uuid,
                    "level" => $reqEmail->level,
                    "visits" => $reqVisits
                ]);

                return redirect('/');
            } else {
                return view("login", [ 'error' => "Email or password is incorrect"]);
            }
        }

    }

    public function logoutUser() {
        session()->flush();
        return redirect('login');
    }

}
