<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
        <script src="bower_components/c3/c3.min.js"></script>
        <script src="bower_components/d3/d3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script>
      var url = "{{url('stock/chart')}}";
      var Years = new Array();
      var Labels = new Array();
      var Prices = new Array();
      $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Years.push(data.stockYear);
                Labels.push(data.stockName);
                Prices.push(data.stockPrice);
            });
            var ctx = document.getElementById("canvas");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:Labels,Years,
                      datasets: [{
                          label: 'Price',
                          data: Prices,
                          borderWidth: 0
                      }]
                  },
                 /*  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  } */
              });
          });
        });
       
        /* $.ajaxSetup({
headers:{
'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')

}

}); */
$(".select").change(function(e){
  e.preventDefault();
  var name1=$("select[name=role_id]").val();
  $.ajax({

 dataType:'text',
 type:'GET',
 url:'/filterselect',
    data:{name:name1},
    success:function(data){
     //alert(data);
      OnSuccess(data);
    }
  });
  function OnSuccess(response) {
                  var jsonData = JSON.parse(response);
                  var chart = c3.generate({
                  bindto: '#chart',
                  data: {
                      json: jsonData,
                      keys: {
                          x: 'stockYear',
                          value:['stockPrice','id'],
                      },

                  type: 'bar'
                   }

                  ,
                  bar: {
                    width: 20
                  }
                  });


                };
});

$(".btn-submit").click(function(e){

  e.preventDefault();


});

</script>