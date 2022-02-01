<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sender;
use App\CourierSender;
use App\CourierCompany;
use App\ForCompany;
use App\Department;
use App\Category;
use DB;
use Response;
use Session;

class SenderDetailsController extends Controller
{

    public function courierCmpy(Request $request) 
    {
   //echo"<pre>"; print_r($_POST); die;
        $sender = new Sender;
        $sender->name = $request->name; 
        $sender->type = $request->type;
        $sender->location = $request->location;
        $sender->telephone_no = $request->telephone_no;


        $S = DB::table('sender_details')
        ->where('name', '=', $request['name'])
        ->where('telephone_no', '=', $request['telephone_no'])
        ->first();
        //echo"<pre>"; print_r($S); die;
        if(is_null($S)) {
        $sender->save();
      
        $response['success'] = true;
        $response['messages'] = 'Succesfully imported';
        return Response::json($response);
        }else{
            $response['success'] = false;
            $response['messages'] = 'Data already exist';
            return Response::json($response);
        }
        
    }

    public function autocompleteSearch(Request $request)
    {
        if ($request->ajax()) {
           $data = Sender::orderby('name')->select('location','name','type','telephone_no')->where('name', 'like', '%' .$request->search . '%')->orWhere('location', 'like', '%' .$request->search . '%')->get();
           // $data = Sender::where('name','LIKE',$request->search.'%')->orWhere('location','LIKE',$request->search.'%')->get();
           // echo'<pre>'; print_r($data); die;
            $output = '';
            if (count($data)>0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                //echo'<pre>'; print_r($output); die;
                foreach ($data as $row) {
                   //echo'<pre>'; print_r($row->name);die;
                    $output .= '<li class="list-group-item">'.$row->name.'-'.$row->location.'-'.$row->telephone_no.'</li>';  
                }
                $output .= '</ul>';
            }else {
                $output .= '<li class="list-group-item disabled">'.'No Data Found'.'</li> <a href="'.url('sender-details').'" class="btn btn-sm btn-primary" >Add Sender</a>'
                ;
            }
            return $output;
        }
        return view('create-new');  
    }



 /*   public function autocompleteSearch(Request $request)
    {
        
      $search = $request->search;

      if($search == ''){
         $senders = Sender::orderby('name')->select('location','name','type','telephone_no')->get();
     
      }else{
         $senders = Sender::orderby('name')->select('location','name','type','telephone_no')->where('name', 'like', '%' .$search . '%')->orWhere('location', 'like', '%' .$search . '%')->get();
      }
     

      $response = array();
      foreach($senders as $sender){
          
         $response[] = array("value"=>$sender->location,"num"=>$sender->telephone_no,"label"=>$sender->name.' - '.$sender->location);
      }

      return response()->json($response);
        

    } */
////////////////////////////////////////////////////////////////////////////////////////////////
    public function newCreate(Request $request)
    {
      // echo"<pre>"; print_r($_POST); die;

       $name_company = $request->name_company; 
       $location = $request->location;
       $docket_no = $request->docket_no;
       $docket_date = $request->docket_date;
       $telephone_no = $request->telephone_no;
       $courier_name = $request->slct;
       if( $request->slct == 'other'){
         $courier_name = $request->other_courier;
         $cmpny = new CourierCompany;
         $cmpny->courier_name = $request->other_courier;
         $cmpny->save();
       }else{
        $courier_name = $request->slct;
       }


       foreach($request->catagories as $key => $value){
            
            $sender = ([
                  'name_company' => $name_company,
                  'location' => $location,
                  'docket_no' => $docket_no,
                  'docket_date' => $docket_date,
                  'telephone_no' => $telephone_no,
                  'courier_name' => $courier_name,
                  'catagories' => $value,
                  'for' => $request->for[$key],
                  'bill' => $request->bill[$key],
                  'amount' => $request->amount[$key],
                  'from' => $request->from[$key],
                  'month' => $request->month[$key],
                  'financial' => $request->financial[$key],
                  'kyc' => $request->kyc[$key],
                  'other_catagory' => $request->other_catagory[$key],

            ]);
            // echo'<pre>'; print_r($sender); die;
           // $sender->save();
          //echo'<pre>'; print_r($sender); die;
           DB::table('new_courier_sender')->insert($sender);

       }

        $response['success'] = true;
        $response['messages'] = 'Succesfully Submitted';
        return Response::json($response);
        //'bill' => $_POST['bill'][$key],
        //'amount' => $_POST['amount'][$key],
        //'from' => $_POST['from'][$key],
        //'month' => $_POST['month'][$key],
        //'financial' => $_POST['financial'][$key],
        //'kyc' => $_POST['kyc'][$key],
        
    }

    public function destroy($cmpny_id)
    {
       $cmpny = CourierSender::find($cmpny_id);
       //Session::flash('delete', 'deleted');
       $cmpny->delete();
       Session::flash('deleted', 'Data has been deleted');
       return redirect()->back();
    }
    

    public function edit($id)
    {
      $sender = CourierSender::find($id);
      $couriers = DB::table('courier_companies')->select ('courier_name')->distinct()->get();
      $departs = DB::table('departments')->select ('department')->distinct()->get();
      $categorys = DB::table('catagories')->select ('catagories')->distinct()->get();
      $forcompany = DB::table('for_companies')->select ('for_company')->distinct()->get();
      //echo'<pre>'; print_r($sender); die;
      return view('update',compact('sender','couriers','departs','categorys','forcompany'));                   // return view('update',  ['sender' => $sender]);
    }

    public function update(Request $request,$id)
    {
      $senders = CourierSender::find($id);
      $senders->name_company = $request->name_company; 
      $senders->location = $request->location;
      $senders->telephone_no = $request->telephone_no;
      $senders->docket_no = $request->docket_no;
      $senders->docket_date = $request->docket_date;
      //$months = $request->docket_date;
      //$chg = date('F Y', strtotime($months));
      $senders->courier_name = $request->slct;
      $senders->for = $request->for;
      $senders->catagories = $request->catagories;
      $senders->bill = $request->bill;
      $senders->amount = $request->amount;
      $senders->from = $request->from;
      $senders->month = $request->month;
      $senders->financial = $request->financial;
      $senders->kyc = $request->kyc;
      $senders->other_catagory = $request->other_catagory;
      $senders->given_to = $request->given_to;
      $senders->checked_by = $request->checked_by;

      Session::flash('update', 'Data has been updated successfully');
      $senders->update();
      return redirect('courier-list');

    }
}
