<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\BulkExport;
use Response;
use App\Imports\BulkImport;
use App\CourierCompany;
use App\CourierSender;
use App\Sender;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use DataTables,Auth;
use PDF;
class ImportExportController extends Controller
{
    /**
    * 
    */
    public function importExportView()
    {
       return view('importexport');
    }

//////////////////////////////////////////Import Master/////////////////////////////////////////////////
    public function import() 
    {
        if($_POST['import_type'] == 1){
        try
        {     
           //echo'<pre>'; print_r($_POST); die;
            $data = Excel::import(new BulkImport, request()->file('file'));
            $response['success'] = true;
            $response['messages'] = 'Succesfully imported';
            return Response::json($response);
        
        }catch (\Exception $e) {
          $response['success'] = false;
          $response['messages'] = 'something wrong';
          echo'<pre>'; print_r($e); die;
          return Response::json($e);
        }

      }elseif($_POST['import_type'] == 2){
       //echo '<pre>'; print_r($_FILES); die;
        try
         {      
        //echo'<pre>'; print_r($_POST); die;
         $data = Excel::import(new BulkImport, request()->file('file'));
         $response['success'] = true;
         $response['messages'] = 'Succesfully imported';
         return Response::json($response);
       
     }catch (\Exception $e) {
       $response['success'] = false;
       $response['messages'] = 'something wrong';
       return Response::json($response);
     }

   }elseif($_POST['import_type'] == 3){

    try
    {      
   //echo'<pre>'; print_r($_POST); die;
      $data = Excel::import(new BulkImport, request()->file('file'));
      $response['success'] = true;
      $response['messages'] = 'Succesfully imported';
      return Response::json($response);
  
      }catch (\Exception $e) {
      $response['success'] = false;
      $response['messages'] = 'something wrong';
      return Response::json($response);
   }

   }elseif($_POST['import_type'] == 4){
      
    try
    {      
   //echo'<pre>'; print_r($_POST); die;
      $data = Excel::import(new BulkImport, request()->file('file'));
      $response['success'] = true;
      $response['messages'] = 'Succesfully imported';
      return Response::json($response);
  
      }catch (\Exception $e) {
      $response['success'] = false;
      $response['messages'] = 'something wrong';
      return Response::json($response);
   }


   }elseif($_POST['import_type'] == 5){

    try
    {      
   //echo'<pre>'; print_r($_POST); die;
      $data = Excel::import(new BulkImport, request()->file('file'));
      $response['success'] = true;
      $response['messages'] = 'Succesfully imported';
      return Response::json($response);
  
      }catch (\Exception $e) {
      $response['success'] = false;
      $response['messages'] = 'something wrong';
      return Response::json($response);
   }

   } 
    //return back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    public function list()
    {
        
       return view('pages.sender-details');
    }

    public function saledata()
    {
        $list = DB::table('sale_data')->get();
       return view('pages.salesData',  ['list' => $list]);
    }

    public function purchasedata()
    {
      $sends = Sender::all();
       return view('pages.list-data',  ['sends' => $sends]);
    }

    public function getpdf()
    {
      
      $couriers = DB::table('courier_companies')->select ('courier_name')->distinct()->get();
      $departs = DB::table('departments')->select ('department')->distinct()->get();
      $categorys = DB::table('catagories')->select ('catagories')->distinct()->get();
      $forcompany = DB::table('for_companies')->select ('for_company')->distinct()->get();
        return view('pages.create-new',  ['couriers' => $couriers , 'departs' => $departs ,'categorys' => $categorys ,'forcompany' => $forcompany]);

     }  

     public function bulkpdf()
     {
         if (Auth::check())
         {
             $user_id = Auth::user()->id;  
             $cmpnys = CourierSender::all();
            // echo'<pre>'; print_r($cmpnys); die;
              return view('pages.courier-list', ['cmpnys' => $cmpnys]);
         
 
            return redirect('/login');
         }
      }  

    public function getItemsofgroup()
    {
       // echo "<pre>";print_r($_POST);die;
        $packing = DB::table('item_master')->select('pack')->where('group',$_POST['group'])->distinct()->get();
        $response['success'] = true;
        $response['messages'] = $packing;
        return Response::json($response);
    }

    public function getDateFilter()
    {
        try
        {
            $site_id = $_POST['site_id'];
            //echo "<pre>"; print_r($user_id);die;
            $list =  DB::table('item_master')->where('pack', $_POST['packing'])->where('group', $_POST['group'])->get();
            //echo "<pre>"; print_r($list);die;
           $items  = array();
           $count = count($list);
           //echo "<pre>"; print_r($count);

            foreach($list as $item){
               // echo "<pre>"; print_r($item);
                $items['sale'][] =  DB::table('sale_data')->where('item_name', $item->item_name)->where('site_id', $site_id)->whereBetween('bill_date',[$_POST['fromDate'],$_POST['toDate']])->get();
               
                $items['purchase'][] =  DB::table('purchase_data')->where('item_name', $item->item_name)->where('site_id', $site_id)->whereBetween('bill_date',[$_POST['fromDate'],$_POST['toDate']])->get(); 

                $items['stock_trf'][] =  DB::table('stock_transfer')->where('item_name', $item->item_name)->where('site_id', $site_id)->whereBetween('bill_date',[$_POST['fromDate'],$_POST['toDate']])->get();   
                         
             }
            $array = json_decode(json_encode($items), true);
            $saleData = $array['sale'];
            $purchaseData = $array['purchase'];
            $stock_trf = $array['stock_trf'];
            $sale_count = count($saleData);
            $purchase_count = count($purchaseData);
            $trf_count = count($stock_trf);
            $dataCount = $sale_count + $purchase_count + $trf_count;
            $res = array_merge($saleData, $purchaseData, $stock_trf);

            for ($i=0; $i < count($res); $i++) { 
                for ($j=0; $j < count($res[$i]); $j++) { 

                    $doc_type= $res[$i][$j]['document_type'];
                    
                 }
               echo "<br>";
            }
            $pdf = PDF::loadHtml('myPDF');
            $sheet = $pdf->setPaper('a4', 'landscape');
           // $pdf->save('pdf/'.$site_id.'.pdf');
            return $pdf->download('pdf/'.$site_id.'.pdf');

         }catch (\Exception $e) {
            $bug = $e->getMessage();
            $response['success'] = false;
            $response['messages'] = $bug;
            return Response::json($response);
        }
           
    }



}