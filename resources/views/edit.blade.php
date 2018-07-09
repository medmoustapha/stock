<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
<br><br>
<div class="container">
      <h2 align='center'>Edit A Product</h2><br  />
      <form method="post" action="{{action('StockController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
       
         @include('layouts.errors')
            <label for="stockName">Name:</label>
            <input type="text" class="form-control" name="stockName" value="{{$stock->stockName}}">
            @if ($errors->has('stockName'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('stockName') }}</strong>
                                    </span>
                                @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="stockPrice">Price:</label>
              <input type="text" class="form-control" name="stockPrice" value="{{$stock->stockPrice}}">
              @if ($errors->has('stockPrice'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('stockPrice') }}</strong>
                                    </span>
                                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="stockYear">Stock Year:</label>
                <input type="text" class="form-control" name="stockYear" value="{{$stock->stockYear}}">
                @if ($errors->has('stockYear'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('stockYear') }}</strong>
                                    </span>
                                @endif
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update Stock</button>
          </div>
        </div>
      </form>
    </div>


