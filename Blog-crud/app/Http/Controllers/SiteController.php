<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function getFavorites() {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $reqUuid = DB::table('users')->where('uuid', $uuid)->first();

            if($reqUuid) {
                print_r($reqUuid->uuid);
                
            }

        } else {
            return redirect('login');
        }
    }

    public function editPost() {
        if(session()->has('uuid')) {
            $uuid = session('uuid');
            $id = $_GET['id'];

            $reqPost = DB::table('posts')->where('id', $id)->first();


            if($reqPost) {

                $categorys = $this->getCategorys();
        
                $reqPost = json_decode(json_encode($reqPost), true);
        
                return view('edit', ['categorys' => $categorys, 'post' => $reqPost, 'id' => $id]);

            }

        } else {
            return redirect('login');
        }
    }

    public function updatePost(Request $request) {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $reqPost = null;

            if(session()->get('level') == 1) {
                $reqPost = DB::table('posts')->where('id', $request['postid'])->first();
            } else {
                $reqPost = DB::table('posts')->where('id', $request['postid'])->where('user_id', $uuid)->first();
            }
            
            
            if($reqPost) {

                $validated = $request->validate([
                    'title' => 'required|max:30',
                    'category' => 'required|max:50',
                    'content' => 'required',
                ]);
                
                $validated["updated_at"] = date('Y-m-d H:i:s');

                if(session()->get('level') == 1) {
                    DB::table('posts')->where('id', $reqPost->id)->update($validated);
                } else {
                    DB::table('posts')->where('id', $reqPost->id)->where('user_id', $uuid)->update($validated);
                }

        
                return redirect('blogs');

            }

        } else {
            return redirect('login');
        }
    }

    public function deletePost() {
        if(session()->has('uuid')) {
            $uuid = session('uuid');
            $id = $_GET['id'];

            $reqPost = null;

            if(session()->get('level') == 1) {
                $reqPost = DB::table('posts')->where('id', $id)->first();
            } else {
                $reqPost = DB::table('posts')->where('id', $id)->where('user_id', $uuid)->first();
            }
            
            
            print_r($uuid);
            
            if($reqPost) {

                if(session()->get('level') == 1) {
                    DB::table('posts')->where('id', $reqPost->id)->delete();
                } else {
                    DB::table('posts')->where('id', $reqPost->id)->where('user_id', $uuid)->delete();
                }

        
                return redirect('blogs');

            }

        } else {
            return redirect('login');
        }
    }

    public function getUserPosts() {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $reqUuid = DB::table('users')->where('uuid', $uuid)->first();

            if($reqUuid) {
                $categorys = $this->getCategorys();
        
                $reqPosts = $this->getAllPosts();
        
                return view('myblogs', ['categorys' => $categorys, 'posts' => $reqPosts]);

            }

        } else {
            return redirect('login');
        }
    }

    public function createBlog() {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $reqUuid = DB::table('users')->where('uuid', $uuid)->first();

            if($reqUuid) {

                $categorys = $this->getCategorys();

                return view('createblog', ['categorys' => $categorys]);
            } else {
                return redirect('login');
            }

        } else {
            return redirect('login');
        }
    }

    public function createPost(Request $request) {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $reqUuid = DB::table('users')->where('uuid', $uuid)->first();

            if($reqUuid) {

                $validated = $request->validate([
                    'title' => 'required|max:30',
                    'category' => 'required|max:50',
                    'content' => 'required',
                ]);
                
                $validated["user_id"] = $reqUuid->uuid;
                $validated["created_at"] = date('Y-m-d H:i:s');
                $validated["updated_at"] = date('Y-m-d H:i:s');

                DB::table('posts')->insert($validated);

                return redirect("blogs");
            }

        } else {
            return redirect('login');
        }
    }
    public function getDetails() {
        if(session()->has('uuid')) {

            $uuid = session('uuid');

            $reqVisits = DB::table('visits')->where('user_id', $uuid)->first();

            $req = [];
            

            if($reqVisits) {

                $req['visits'] = $reqVisits->visits + 1;

                session(['visits' => $reqVisits->visits + 1]);
                $req["updated_at"] = date('Y-m-d H:i:s');

                DB::table('visits')->where('user_id', $uuid)->update($req);
        

            } else {

                $req['user_id'] = $uuid;
                $req['visits'] = 1;
                $req["created_at"] = date('Y-m-d H:i:s');
                $req["updated_at"] = date('Y-m-d H:i:s');

                session(['visits' => 1]);

                DB::table('visits')->insert($req);
            }

            $id = $_GET['id'];


            $reqPosts = DB::table('posts')->where('id', $id)->first();

            
            if($reqPosts) {

                $reqPost = json_decode(json_encode($reqPosts), true);
        
                return view('details', ['post' => $reqPost]);

            }


        } else {
            return redirect('login');
        }
    }

    public function getCategorys() {

        $reqCategorys = DB::table('categorys')->get();

        return json_decode(json_encode($reqCategorys), true);
    }

    public function getAllPosts() {

        $reqPosts = DB::table('posts')->get();

        return json_decode(json_encode($reqPosts), true);
    }

    public function getFilteredPosts($category, $search) {

        $reqPosts = DB::table('posts')->where('title', $search)->orWhere('content', $search)->get();

        foreach ($category as $value) {
            $reqPost = $reqPosts->orWhere('category', $value['name']);
        }

        return json_decode(json_encode($reqPosts), true);
    }

    public function getPosts() {
        $categorys = $this->getCategorys();
        
        $reqPosts = $this->getAllPosts();

        return view('blogs', ['categorys' => $categorys, 'posts' => $reqPosts]);
    }

    public function getBlogData(Request $request) {

        $categorys = $this->getCategorys();
        $search = $request['search'];
        // dd($request);
        
        // print_r($categorys);
        // print_r($categorys[0]['name']);
        $reqPosts = null;
        if($search == "") {
            $reqPosts = DB::table('posts')->get();
        } else {
            $reqPosts = DB::table('posts')->where('title', $search)->orWhere('content', $search)->get();
        }
        $data = json_decode(json_encode($reqPosts), true);

        $dataResponse = [];
        
        foreach($categorys as $key => $value) {
            if($request[$value['name']] = "on") {
                print_r($request[$value['name']]);
                // print_r($value['name']);
                foreach ($data as $entry) {
                    if ($entry['category'] == $value['name'] ) {
                        // print_r($entry['category']);
                        // print_r($value['name']);
                        array_push($dataResponse, $entry);
                    }
                }
            }
        }
        
        dd($request);
        dd($dataResponse);


        // $reqPosts = $reqPosts->get();

        // $data = json_decode(json_encode($reqPosts), true);

        return view('blogs', ['categorys' => $categorys, 'posts' => $dataResponse]);
    }

    public function editProfile() {
        if(session()->has('uuid')) {
            $uuid = session('uuid');

            $reqUuid = DB::table('users')->where('uuid', $uuid)->first();

            if($reqUuid) {


                return view('editProfile', ['name' => $reqUuid->username, 'email' => $reqUuid->email]);

            }

        } else {
            return redirect('login');
        }
    }
}
