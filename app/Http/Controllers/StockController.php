<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Http\Resources\ResourcesStock;
use Illuminate\Support\Facades\Redirect;
use App\Stock;
use App\User;
use Illuminate\Http\Responce;

class StockController extends Controller
 {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
    { if(Auth::check()){
      $result = Stock::all();
      return view('index',compact('result'));
    }
    else {  return Redirect::to('login'); }

  }
    /**
     * Display a listing of the resource filter.
     *
     * @return \Illuminate\Http\Response
     */
public function search(Request $request){
      
    if($request->ajax()){ 
        
        $out='';
        $nbg='';
       
        $query = $request->get('query');

        if($query !=''){
             $stocks = DB::table('stocks')->where('stockName','LIKE','%'.$query.'%')->get();
             }
             else{
              $stocks = Stock::all()->toArray();
              //return redirect('stock');
             }
        $total_data = '<b>RESULT: '.count($stocks).'<b>';
        $total_row = count($stocks);
        
        if($total_row > 0){
          
          foreach($stocks as $stock){
           
                    $out.=
                  '<tr>
                    <td>'.$stock->id.'</td><td>'.$stock->stockName.'</td>
                    <td>'.$stock->stockPrice.'</td><td>'.$stock->stockYear.'</td>
                    <td><a href= "" class="btn btn-warning">edit</a></td>
                    <td>
                    <a href= "" class="btn btn-danger">Delete</a>
                   <!--  <form action="" method="post" onsubmit="return confirm("vos étes sur de supprimer ce produit?");">
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit" )>Delete</button>
                      </form>-->
                     </td>
                  </tr>'; }
           } 
        else   { 
              $out = '<tr>
                            <td align="center" colspan="6">No Data Found</td>
                         </tr>';
                        }
        $stocks = Stock::paginate(7);
        $nbg=$stocks->links();
        $data = array(
                        'table_data'  => $out,
                        'pagination_data'  => $nbg,
                        'total_data'=>$total_data );
                         
        echo json_encode($data);
      
        }
         
    }
public function searchButton($request){
      $stocks = DB::table('stocks')->where('stockName','LIKE','%'.$request->search.'%');
      $stocks = Stock::paginate(8);
      if($stocks){
        return view('index1',compact('stocks'));}
        else{
          return redirect('stock');
        }
    }
    /**
    * Create a new controller instance.
    */
public function filter(Request $request){ 
  
  if($request->priceMin!=null and $request->priceMax!=null and $request->year!=null){
    $produit=Stock::where('stockName',$request->name)
                  ->whereBetween('stockPrice', array($request->priceMin, $request->priceMax))
                  ->where('stockYear',$request->year)
                  ->select('stockName','stockYear','stockPrice','id')
                            ->get();}
  elseif($request->priceMin!=null and $request->priceMax!=null and $request->year==null){
    $produit=Stock::where('stockName',$request->name)
                  ->whereBetween('stockPrice', array($request->priceMin, $request->priceMax))
                  ->select('stockName','stockYear','stockPrice','id')
                  ->get();
           }
  elseif ($request->priceMin!=null){
    $produit=Stock::where('stockName',$request->name)
    ->where('stockPrice','>=',$request->priceMin)
    ->select('stockName','stockYear','stockPrice','id')
    ->get();
   }
  elseif ($request->priceMax!=null){
    $produit=Stock::where('stockName',$request->name)
    ->where('stockPrice','<=',$request->priceMax)
    ->select('stockName','stockYear','stockPrice','id')
    ->get();
   }
   
  elseif($request->priceMin==null and $request->priceMax==null and $request->year!=null){
      $produit=Stock::where('stockName',$request->name)
                    ->where('stockYear',$request->year)
                    ->select('stockName','stockYear','stockPrice','id')
                    ->get();
                   }
                   
  else{
    $produit=Stock::where('stockName',$request->name)
                  ->select('stockName','stockYear','stockPrice','id')
                  ->get();
                            }
  return response()->json($produit);
   }
public function filterSelect(){
  $produit=Stock::where('stockName',$request->name)
  ->select('stockName','stockYear','stockPrice','id')
  ->get();
  return response()->json($produit);
 }
public function index2()
    { if(Auth::check()){
      return view('index2');}
      else {
        return redirect::to('login');
      }
    
    }
public function index3()
    { if(Auth::check()){
      $id = Auth::id();
      $user=User::where('id',$id)->select('name','email')->get();
      $stocks = Stock::all()->toArray();
      /* $stocks = \DB::table('stocks')
                    ->orderBy('id', 'DESC')
                    ->get(); */
      $stocks = Stock::paginate(7);
      return view('index1',compact('stocks','user'));
    }
    else return redirect::to('login');
    }
function indexAg(){
      $stocks = Stock::all()->toArray();
      $stocks = Stock::paginate(5);
      return json_encode($stocks);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create()
    {  if(Auth::check()){
         $stock=new Stock();
         return view('Stock',compact('stock'));}
         else return redirect::to('login');
    }
  //afficher liste de nom produits

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
   {
   $request->validate([
      'stockName' =>  'required|max:30',
      'stockPrice' => 'required|numeric',
      'stockYear' =>  'required|numeric',
      ]);
    
     $stock=Stock::create($request->all());
     
     return redirect('stock');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit($id)
    { if(Auth::check()){
       $stock = \App\Stock::find($id);

        return view('edit',compact('stock','id'));}
      else return redirect::to('login');
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int   $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
    {
      $request->validate([
        'stockName' =>  'required|max:30',
        'stockPrice' => 'required|numeric',
        'stockYear' =>  'required|numeric',
        ]);
    $stock = \App\Stock::find($id);
    $stock->update($request->all());
      return redirect('stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
    { if(Auth::check()){
      $stock = \App\Stock::find($id);
      $stock->delete();
      return redirect('stock');}
      else redirect::to('login');
    }
public function chart()
      {
        $results = \DB::table('stocks')
                    ->orderBy('stockPrice', 'desc')
                    ->limit(10)
                    ->get();
        return response()->json($results);
        /* return response()->json(['prix'=>'45', 'stock'=>'10','annee'=>'2018']); */
        //return new StockResource($result);
      }
public function logout(){
  Auth::logout(); // logging out user
  return Redirect::to('login');
      }
 }

