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
        $sender->address = $request->address_1.','.$request->address_2.','.$request->address_3;
        $sender->city = $request->city;
        $sender->distt = $request->distt;
        $sender->pin_code = $request->pin_code;
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
         $senders = Sender::orderby('name')->select('address','city','distt','pin_code','name','type','telephone_no')->get();
     
      }else{
         $senders = Sender::orderby('name')->select('address','city','distt','pin_code','name','type','telephone_no')->where('name', 'like', '%' .$search . '%')->orWhere('city', 'like', '%' .$search . '%')->get();
      }
     

      $response = array();
      foreach($senders as $sender){
          
         $response[] = array("value"=>$sender->address,"city"=>$sender->city,"distt"=>$sender->distt,"pin_code"=>$sender->pin_code,"num"=>$sender->telephone_no,"label"=>$sender->name.' - '.$sender->city);
      }

      return response()->json($response);
        

    } 

    public function newCreate(Request $request)
    {
      //echo"<pre>"; print_r($_POST); die;
        $sender = new CourierSender;
        $sender->name_company = $request->name_company; 
        $sender->address = $request->address;
        $sender->city = $request->city;
        $sender->distt = $request->distt;
        $sender->pin_code = $request->pin_code;
        $sender->docket_no = $request->docket_no;
        $sender->docket_date = $request->docket_date;
        $sender->document = $request->document;
        $sender->telephone_no = $request->telephone_no;
        $sender->given_to = $request->given_to;
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

          return view('update',compact('sender' ));
         // return view('update',  ['sender' => $sender]);
    }

    public function update(Request $request,$id)
    {
      $senders = CourierSender::find($id);
      $senders->name_company = $request->name_company; 
      $senders->address = $request->address;
      $senders->city = $request->city;
      $senders->distt = $request->distt;
      $senders->pin_code = $request->pin_code;
      $senders->docket_no = $request->docket_no;
      $senders->docket_date = $request->docket_date;
      $senders->document = $request->document;
      $senders->telephone_no = $request->telephone_no;
      $senders->given_to = $request->given_to;

      Session::flash('update', 'Data has been updated successfully');
      $senders->update();
      
      return redirect('courier-list');


    }
}
