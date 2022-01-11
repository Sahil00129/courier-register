<?php
namespace App\Imports;
use App\CourierCompany;
use App\Sender;
use App\salesData;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class BulkImport implements ToModel,WithHeadingRow
{
	/**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($_POST['import_type'] == 1){
           //echo "<pre>"; print_r($row);die;
           $sender = DB::table('sender_details')
           ->where('name', '=', $row['name'])
           ->where('telephone_no', '=', $row['telephone_no'])
           ->first();
           if(is_null($sender)) {
            return new Sender([
                'name'  => $row['name'],
                'type'    => $row['type'],
                'address' => $row['address'],
                'distt'   => $row['distt'],
                'city'   => $row['city'],
                'pin_code' =>$row['pin_code'],
                'telephone_no' =>$row['telephone_no'],
            ]);
           }else{
              return $e;
           }

            
       }

       if($_POST['import_type'] == 2){
         //echo "<pre>"; print_r($row['courier_name']);die;
         $CU = DB::table('courier_companies')
         ->where('courier_name', '=', $row['courier_name'])
         ->first();
         if(is_null($CU)) {
            return new CourierCompany([
                'courier_name'  => $row['courier_name']
            ]);
               
         }else{
              return $e;
         } 

    }
}

    
}