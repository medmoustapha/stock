<!doctype html>

<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
    </head>
    <body>
   
        <div class="container"> 
          <br />
          <form action="{{url('stock/add')}}" method="post">
            {{csrf_field()}}
            <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">@include('layouts.errors')
            <div class="form-group">
               <label for="stockName">Stock Name:</label>
               <input type="text" class="form-control" id="stockName" name="stockName">
               @if ($errors->has('stockName'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('stockName') }}</strong>
                                    </span>
                                @endif
             </div>
             <div class="form-group">
               <label for="stockPrice">Stock Price:</label>
               <input type="text" class="form-control" id="stockPrice" name="stockPrice"> @if ($errors->has('stockPrice'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('stockPrice') }}</strong>
                                    </span>
                                @endif
             </div>
             <div class="form-group">
               <label for="stockYear">Stock Year:</label>
               <input type="text" class="form-control" id="stockYear" name="stockYear">
               @if ($errors->has('stockYear'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('stockYear') }}</strong>
                                    </span>
                                @endif
            </div>
             <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
    </body>
</html>