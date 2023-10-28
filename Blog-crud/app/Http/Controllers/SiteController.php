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

    public function getCategorys() {

        $reqCategorys = DB::table('categorys')->get();

        return json_decode(json_encode($reqCategorys), true);
    }

    public function getAllPosts() {

        $reqPosts = DB::table('posts')->get();

        return json_decode(json_encode($reqPosts), true);
    }

    public function getPosts() {
        $categorys = $this->getCategorys();
        
        $reqPosts = $this->getAllPosts();

        return view('blogs', ['categorys' => $categorys, 'posts' => $reqPosts]);
    }
}
