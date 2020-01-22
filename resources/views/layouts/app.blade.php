<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>
@section('sidebar')
    <h1>This is the ordering section page</h1>
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>
