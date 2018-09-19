<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   <link href="{{asset('bower_components/c3/c3.min.css')}}" rel="stylesheet" type="text/css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table de bord</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <meta name = "csrf-token" content = "{{csrf_token ()}}"/>

</head>
<body>
<div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        
        <div id="navbar" class="collapse navbar-collapse">
      
          <ul class="nav navbar-nav">
            <li class="active"><a href="stock">Products</a></li>
            <li class="active"><a href="stocks">Chart with filter</a></li>
            <li class="active"><a href="stocks2">Chart </a></li>
            <li class="active"><a href="stock/add">Add Product</a></li>
           <!--  <li class="active"><a href="logout">logOut</a></li> -->
          </ul>
         
         </div>
      </div>
    </nav>

  </div>
  <div class="container">
    @yield('vave')
</div>
<div class="container">
    @yield('content')
</div>

</body>
</html>
