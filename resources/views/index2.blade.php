@extends('layouts.default')

@section('content')
<br><br>
<center><h1>Simple chart</h1></center>
<div class="row">
       <div class="col-md-10 col-md-offset-1">
           <div class="panel panel-default">
               <div class="panel-heading"><b>Chart</b></div>
               <div class="panel-body">
                   <canvas id="canvas" height="250" width="600"></canvas>
               </div>
           </div>
       </div>
     </div>
     @include('chart.chart');
</center>



@endsection('content')
