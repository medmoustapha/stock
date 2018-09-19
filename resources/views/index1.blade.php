<!-- index.blade.php -->

<!DOCTYPE html>
@extends('layouts.default')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<br><br><br>
<div class="container">
<div class="panel panel-default">
<div class="row" ng-app="ajaxExample">
<script rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div class="col-sm-2"></div>
<div class="col-sm-8" >
     <!-- <form action="{{url('stock/searchButton')}}" method="post")> -->
       <input type="text" class ="input-lg" name="search" id="search" placeholder="Filter" ng-modul=""/>
       <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
       <span id="pagination" style:align="right"></span>
      
       <span id="total_row" style="text-align:right";></span>
       <span  style:align="right"class ="nav navbar-nav navbar-right">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                  <li>
                     <a href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                Logout
                      </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form> </li>
                                </ul>
        </span>
    <!--  </form> -->
    <br>
<table class="table table-bordered table-hover" ng-controller="controller">
    
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>year</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody >
      
   @foreach($stocks as $stock)
      
     <tr ng-repeat= "stock in stocks | filter:search"  >
      <?php /*  <td>{{stock.id}}</td>
        <td>{{stock.stockName}}</td>
        <td>{{stock.stockPrice}}</td>
        <td>{{stock.tockYear}}</td>  */  ?>
        <td>{{$stock['id']}}</td>
        <td>{{$stock['stockName']}}</td>
        <td>{{$stock['stockPrice']}}</td>
        <td>{{$stock['stockYear']}}</td>
        <td><a href="{{action('StockController@edit', $stock['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('StockController@destroy', $stock['id'])}}" method="post"onsubmit="return confirm('Are you sure?');">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit" )>Delete</button>
          </form>
        </td>
      </tr> 
    @endforeach 
    </tbody>
</table>
  <span id="pagination">{{ $stocks->links()}}</span>
    
  </div>
  <div class="col-sm-2"></div>
  </div>
  </div>
  </div>
 


  </body>
</html>
<script>
$(document).ready(function(){

 fetch_prod_data();

 function fetch_prod_data(query='' )
 { 

  $.ajax({
   url:'stock/search',
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {  console.log('data');
    $('tbody').html(data.table_data);
    $('#pagination').html(data.pagination_data);
    $('#total_row').html(data.total_data);
    

   }
  });
 }

 $('#search').on('keyup', function(){
  $query = $(this).val();
  
  fetch_prod_data($query);
 });
})
</script>
<script>
 var ajaxExample = angular.module('ajaxExample', [])
  .config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('{{');
    $interpolateProvider.endSymbol('}}');
});
  ajaxExample.controller('controller',function($scope, $http)  {
                $http.get('stock/indexAg').success(function(data){
                $scope.stocks = data;
              });})
 
 </script>