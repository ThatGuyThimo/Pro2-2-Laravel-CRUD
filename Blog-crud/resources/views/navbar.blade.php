
<div class="flex flex-row items-stretch bg-[#333333]">
    <ul class="text-white p-2 flex">
        <a href="{{ route('blogs') }}" class="hover:text-gray-400 mr-2 " ><li><img width="60px" src="{{ asset('/images/GS.svg') }}"></li></a>
        @if (session()->has('username')) 
        <a href="{{ route('editprofile') }}" class="hover:text-gray-400 mr-2 " ><li>{{session()->get('username')}}</li></a>
        <a href="{{ route('logout') }}" class="hover:text-gray-400 mr-2 " ><li>Logout</li></a>
        @if (session('visits') >= 3 )
        <a href="{{ route('createblog') }}" class="hover:text-gray-400 mr-2 " ><li>Create blog</li></a>
        <a href="{{ route('myposts') }}" class="hover:text-gray-400 mr-2 " ><li>My blogs</li></a>
        @endif
        @else
        <a href="{{ route('login') }}" class="hover:text-gray-400 mr-2 " ><li>Login</li></a>
        @endif
        <a href="{{ route('blogs') }}" class="hover:text-gray-400 mr-2 " > <li>Blogs</li></a>
    </ul>
</div>