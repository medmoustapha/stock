@extends('layouts.default')

@section('content')
<br><br><br>
<div class="row">
       <!-- <div class="col-sm-3"></div> -->
    <div class="col-sm-8">
     <div class="row">
       <div class="col-md-10 col-md-offset-0">
           <div class="panel panel-default">
               <div class="panel-body">
                   <canvas id="canvas" height="540" width="800"></canvas>
               </div>
           </div>
       </div>
      </div>
    </div>
    <div class="col-sm-4 panel panel-default">
        <div class="form-group">
          <label for="role_id">Filtre</label>
          <form action="" id="form_id">
            <select class="form-control select" name="role_id" >
               @foreach($result as $resul)
                  <option >{{$resul->stockName}}</option>
               @endforeach
            </select>
          
            <div >
             Min price <b>$</b><input type="number" class="form-control"  name="priceMin">
             Max price <b>$</b><input type="number" class="form-control"  name="priceMax">
             Year: <input type="number" class="form-control"  name="year" >
             <button class="btn btn-search btn-submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          
          </form>
        </div><br>
        <div id="chart"></div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
   $.ajaxSetup({

     headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }});



 $(".btn-submit").click(function(e){
alert('test');
   e.preventDefault();

   var name = $("select[name=role_id]").val();
   var priceMin = $("input[name=priceMin]").val();
   var priceMax = $("input[name=priceMax]").val();
   var year = $("input[name=year]").val();
   var Labels = new Array();
  $.ajax({
     type:'get',
     url:'/filter',
     data:{name:name,priceMin:priceMin,priceMax:priceMax,year:year}, 
     }).done(function(response) {
        response.forEach(function(data){
                Labels.push(data.stockName);
            });
      //var jsonData = JSON.parse(response);
     var chart = c3.generate({
                bindto: '#chart',
                data: {
                      labels:Labels,
                      json: response,
                      keys: {
                          x: 'stockYear',
                          value:['stockPrice','id'],
                      },

                      type: 'bar',
                      empty: {
                         label: {
                                   text: "No Data"
                                }
                             }
                        }

                  ,
                bar: {
                    width: 20
                  }
                  });
    })
 });
</script>
@include('chart.chart')
@endsection
