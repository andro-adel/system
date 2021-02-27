<!DOCTYPE html>
<html lang="en">
<head>
      @include('admin.layout.header')
</head>
<body class="sb-nav-fixed">


        @include('admin.layout.navbar')

            @include('admin.layout.aside')

               
                    @yield('body')
                
            
            @include('admin.layout.footer')

        
</body>
</html>