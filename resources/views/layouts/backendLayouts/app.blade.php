<!DOCTYPE html>
<html lang="en">
   	@include('admin.include.head')
<body class="skin-black">
	@include('admin.include.header')
	@include('admin.include.sidebar')
   	<aside class="right-side">
    	@yield('content') 
    </aside>
    @include('admin.include.footer')
</body>
</html>