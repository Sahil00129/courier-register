<?php

namespace App\Http\Controllers;
use App\Department;
use App\Category;
use App\CourierCompany;
use App\ForCompany;
use Session;

use Illuminate\Http\Request;

class TableController extends Controller
{
    public function departmentTable()
    {

      $departments = Department::all();
      return view('pages.department' , ['departments' => $departments]);

    }

    public function categoryTable()
    {

      $catagories = Category::all();
      return view('pages.catagories', ['catagories' => $catagories]);
      
    }
 
    public function courierCompanies()
    {
      $couriers = CourierCompany::all(); 
      return view('pages.courier-companies' , ['couriers' => $couriers]);
    }

    public function forCompany()
    {
      $forcompanys = ForCompany::all(); 
      return view('pages.for-company' , ['forcompanys' => $forcompanys]);
    }

    ////////////////////////////Department////////////////////
    public function editDept($id)
       {
            $nw = Department::find($id);
             return response()->json([
            'status' =>200,
             'nw' => $nw,
       ]);
     }
      public function updateDepartment(Request $request)
      {
        $dept_id = $request->dept_id;
        $add = Department::find($dept_id);
        $add->department = $request->department;
        Session::flash('update', 'Data has been updated successfully');
         $add->update();

         return redirect()->back();

      }
       ////////////////////Category//////////////////////
       public function editCat($id)
       {
            $newcata = Category::find($id);
             return response()->json([
            'status' =>200,
             'newcata' => $newcata,
       ]);
     }

     public function updateCatagories(Request $request)
     {
       $cat_id = $request->cat_id;
       $addnew = Category::find($cat_id);
       $addnew->catagories = $request->catagories;
       Session::flash('update', 'Data has been updated successfully');
        $addnew->update();
     
        return redirect()->back();

     }
     ///////////////////////For Company//////////////

     public function editforCompany($id)
     {
          $forcomp = ForCompany::find($id);
           return response()->json([
          'status' =>200,
           'forcomp' => $forcomp,
     ]);
   }

      public function updateforCompany(Request $request)
     {
       $for_id = $request->for_id;
       $addfor = ForCompany::find($for_id);
       $addfor->for_company = $request->for_company;
       Session::flash('update', 'Data has been updated successfully');
       $addfor->update();
      return redirect()->back();

     }
    /////////////Courier Company//////////////////
    public function editcourierCompany($id)
    {
         $forcourier = CourierCompany::find($id);
          return response()->json([
         'status' =>200,
          'forcourier' => $forcourier,
    ]);
  }

     public function updatecourierCompany(Request $request)
    {
      $courier_id = $request->courier_id;
      $addcourier = CourierCompany::find($courier_id);
      $addcourier->courier_name = $request->courier_name;
      Session::flash('update', 'Data has been updated successfully');
      $addcourier->update();
     return redirect()->back();

    }


   
}
