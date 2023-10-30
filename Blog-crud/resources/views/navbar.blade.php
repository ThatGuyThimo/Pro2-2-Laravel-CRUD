
<div class="flex flex-row items-stretch bg-[#333333]">
    <ul class="text-white p-2 flex">
        <a href="/" class="hover:text-gray-400 mr-2 " ><li><img width="60px" src="{{ asset('/images/GS.svg') }}"></li></a>
        @if (session()->has('username')) 
        <a href="/editprofile" class="hover:text-gray-400 mr-2 " ><li>{{session()->get('username')}}</li></a>
        <a href="/logout" class="hover:text-gray-400 mr-2 " ><li>Logout</li></a>
        @if (session('visits') >= 3 )
        <a href="/createblog" class="hover:text-gray-400 mr-2 " ><li>Create blog</li></a>
        <a href="/myposts" class="hover:text-gray-400 mr-2 " ><li>My blogs</li></a>
        @endif
        @else
        <a href="/login" class="hover:text-gray-400 mr-2 " ><li>Login</li></a>
        @endif
        <a href="/blogs" class="hover:text-gray-400 mr-2 " > <li>Blogs</li></a>
    </ul>
</div>