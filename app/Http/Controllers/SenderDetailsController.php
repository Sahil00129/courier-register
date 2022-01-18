<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sender;
use App\CourierSender;
use App\CourierCompany;
use DB;
use Response;
use Session;

class SenderDetailsController extends Controller
{

    public function courierCmpy(Request $request) 
    {
   // echo"<pre>"; print_r($_POST); die;
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
        

    } 

    public function newCreate(Request $request)
    {
        //echo"<pre>"; print_r($_POST); die;
        $sender = new CourierSender;
        $sender->name_company = $request->name_company; 
        $sender->location = $request->location;
        $sender->docket_no = $request->docket_no;
        $sender->docket_date = $request->docket_date;
       
        $sender->document_details = $request->bill.', '.$request->amount.', '.$request->from.', '.$request->for.', '.$request->month.', '.$request->other_detail;
       
        if($request->for == "other"){
         $sender->document_details = $request->bill.', '.$request->amount.', '.$request->from.', '.$request->for_other.', '.$request->month.', '.$request->other_detail;
        }else{
         $sender->document_details = $request->bill.', '.$request->amount.', '.$request->from.', '.$request->for.', '.$request->month.', '.$request->other_detail;
        }

        $sender->telephone_no = $request->telephone_no;
        $sender->given_to = $request->given_to;
        $sender->department = $request->department;
        if($request->department == "other"){
         $sender->department = $request->other_dept;
        }else{
         $sender->department = $request->department;
        }

        $sender->catagories = $request->catagories;
        if($request->catagories == "other"){
         $sender->catagories = $request->other_cat;
        }else{
         $sender->catagories = $request->catagories;
        }

        $sender->courier_name = $request->slct; 
         if($request->slct == "other"){
          $sender->courier_name = $request->other;
          $cmpny = new CourierCompany;
          $cmpny->courier_name = $request->other;
          $cmpny->save();

         }else{
          $sender->courier_name = $request->slct;  
         } 

         

         $sender->save();
          
       
        //echo'<pre>'; print_r($request->other); die;

        $response['success'] = true;
        $response['messages'] = 'Succesfully Submitted';
        return Response::json($response);
        
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
          //echo'<pre>'; print_r($sender); die;
          return view('update',compact('sender','couriers'));
         // return view('update',  ['sender' => $sender]);
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
      $senders->document_details = $request->bill.','.$request->amount.','.$request->from.','.$request->for.','.$request->month.','.$request->other_detail;
      if($request->for == "other"){
         $senders->document_details = $request->bill.', '.$request->amount.', '.$request->from.', '.$request->for_other.', '.$request->month.', '.$request->other_detail;
        }else{
         $senders->document_details = $request->bill.', '.$request->amount.', '.$request->from.', '.$request->for.', '.$request->month.', '.$request->other_detail;
        }
      $senders->given_to = $request->given_to;
      $senders->checked_by = $request->checked_by;

      $senders->department = $request->department;
      if($request->department == "other"){
       $senders->department = $request->other_dept;
      }else{
       $senders->department = $request->department;
      }

      $senders->catagories = $request->catagories;
      if($request->catagories == "other"){
       $senders->catagories = $request->other_cat;
      }else{
       $senders->catagories = $request->catagories;
      }

      $senders->courier_name = $request->slct;
          
      if($request->slct == "other"){
       $senders->courier_name = $request->other;
       $cmpny = new CourierCompany;
       $cmpny->courier_name = $request->other;
       $cmpny->save();

      }else{
       $senders->courier_name = $request->slct;  
      } 
       
      Session::flash('update', 'Data has been updated successfully');
      $senders->update();
      
      return redirect('courier-list');

    }
}
