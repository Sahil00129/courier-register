<?php
namespace App\Imports;
use App\CourierCompany;
use App\Sender;
use App\salesData;
use App\Department;
use App\Category;
use App\ForCompany;
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
                'location' => $row['location'],
                'telephone_no' =>$row['telephone_no'],
            ]);
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
               
         
         } 

    }
    if($_POST['import_type'] == 3){
        //echo "<pre>"; print_r($row['department']);die;
        $dept = DB::table('departments')
        ->where('department', '=', $row['department'])
        ->first();
        if(is_null($dept)) {
           return new Department([
               'department'  => $row['department']
           ]);      
        } 
   }

   if($_POST['import_type'] == 4){
    //echo "<pre>"; print_r($row['department']);die;
    $catagory = DB::table('catagories')
    ->where('catagories', '=', $row['catagories'])
    ->first();
    if(is_null($catagory)) {
       return new Category([
           'catagories'  => $row['catagories']
       ]);      
    } 
}
if($_POST['import_type'] == 5){
    //echo "<pre>"; print_r($row['department']);die;
    $for = DB::table('for_companies')
    ->where('for_company', '=', $row['for_company'])
    ->first();
    if(is_null($for)) {
       return new ForCompany([
           'for_company'  => $row['for_company']
       ]);      
    } 
}

}

  
}