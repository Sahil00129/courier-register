@extends('layouts.main')

@section('title', 'Create New')

@section('content')
<style>
.list-group{
    width: 300px !important;
   
    padding: 10px !important;
    list-style-type: none;
}
.list-group {
    max-height: 230px;
    overflow-y: auto;
    / prevent horizontal scrollbar /
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
   li:hover{  
    color: blue;
 }  
 .editlable{
   
    color: gray;

 }
 
</style>



<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

	<!--begin::Toolbar-->

	<div class="toolbar" id="kt_toolbar">

		<!--begin::Container-->

		<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">

			<!--begin::Page title-->

			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

				<!--begin::Title-->

				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create New</h1>

				<!--end::Title-->

				<!--begin::Separator-->	<span class="h-20px border-gray-200 border-start mx-4"></span>

				<!--end::Separator-->

				<!--begin::Breadcrumb-->
				<!--end::Breadcrumb-->

			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>

	<!--end::Toolbar-->

	<!--begin::Post-->

	<div class="post d-flex flex-column-fluid" id="kt_post" >

		<!--begin::Container-->

		<div id="kt_content_container" class="container-xxl">

			<!--begin::Card-->

			<div class="card">

				<!--begin::Card body-->

				<div class="card-body pt-0" style="min-height:500px; width: auto; margin-top:21px;">
                


				<div class="container mt-5">
                <h3><b>Sender Details</b></h3>
     <form id="newSender" method="post" class="specify-numbers-price">
         @csrf
         <div class="row">
         <div class="col">
		<div class="fv-row mb-10">
        <!--begin::Label-->
       
              <label class="fw-bold-gray fs-6 mb-2 editlable">From</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="search" name="name_company" class="form-control form-control-solid mb-3 mb-lg-0" style="width:95%;" placeholder="" value="" autocomplete="off"/>
        <!--end::Input-->
        <div id="product_list"></div>
       </div>
   </div>
   <div class="col">
       <label for="" class="form-label editlable">Location</label>
    <textarea id="location" name="location" class="form-control form-control form-control-solid" data-kt-autosize="true" style="width:99%;" rows="1" cols="1"></textarea>
   </div>

    
    <div class="col">
	 <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold-gray fs-6 mb-2 editlable">Telephone No</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="telephone_no" name="telephone_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
    </div>
   </div>
   </div>

    <h3><b><u>Courier Details</u></b></h3>
	       <div class="row">
              <div class="col"> 
                   <label for="" class="form-label editlable">Courier Name</label>
                     <select class="form-select form-select-solid" id="slct" name="slct" data-control="select2" data-placeholder="~~Select~~" onchange="yesnoCheck(this);" required> 
	             	<option disabled selected >select..</option>
	             	@foreach($couriers as $courier)
                    <option value="{{$courier->courier_name}}">{{$courier->courier_name}}</option>
	             	@endforeach
                    <option>other</option>
                </select><br>
	        	<br>
		<div id="ifYes" style="display: none;">
		<input type="text" id="other" name="other_courier" class="form-control form-control-solid mb-3 mb-lg-0" style="width:45%;" placeholder="other" value=""/>
        </div><br>
       </div>
              <div class="col">
	             <div class="fv-row mb-10 col-md-16">
                   <!--begin::Label-->
                     <label class="fw-bold-gray fs-6 mb-2 editlable">Docket No.</label>
                   <!--end::Label-->
                  <!--begin::Input-->
                    <input type="text" id="docket_no" name="docket_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
                  <!--end::Input-->
                  </div>
               </div>
             <div class="col">
	        <!--begin::Input group-->
        	 <div class="fv-row mb-10 col-md-12">
            <!--begin::Label-->
            <label class="fw-bold-gray fs-6 mb-2 editlable">Docket Date</label>
              <!--end::Label-->
                 <!--begin::Input-->
                    <input type="date" id="docket_date" name="docket_date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
        <!--end::Input-->
              </div>
           </div>
        </div>
          <div class="insertRowAfter">
            <h3><b>Document Details</b></h3>
               <div id="output"></div>
                    <div id="appendRow" enctype="multipart/form-data">
      
                      <div class="row">    
                           <div class="col"> 
                     <label for="" class="form-label editlable" >Add Catagories</label>
                    <select class="form-select form-select-solid" id="catagories" name="catagories[]" data-control="select2" data-placeholder="~~Select~~" onchange="depCheck(this);"> 
		            <option disabled selected >select..</option>
		             @foreach($categorys as $category)
                    <option value="{{$category->catagories}}">{{$category->catagories}}</option>
	             	@endforeach
                   <option>Other</option>
               </select><br>
             <!--  <div id="catYes" style="display: none;">
		    <input type="text" id="other_cat" name="other_cat" class="form-control form-control-solid mb-3  mb-lg-0" style="width:45%;" placeholder="other" value=""/>
            </div><br> -->
          </div>
             <div class="col"> 
                 <label for="" class="form-label editlable">For</label>
                    <select class="form-select form-select-solid" id="for" name="for[]" data-control="select2" data-placeholder="~~Select~~" onchange="forCheck(this);" required> 
	        	<option disabled selected >select..</option>
             @foreach($forcompany as $forcomp)
            <option value="{{$forcomp->for_company}}">{{$forcomp->for_company}}</option>
	     	@endforeach
            <option>other</option>
        </select><br>
        
		<br>
    <!--	<div id="forYes" style="display: none;">
		<input type="text" id="cfor" name="cfor" class="form-control form-control-solid mb-3 mb-lg-0" style="width:45%;" placeholder="other" value=""/>
        </div><br> -->

        </div>
        </div>
      <div class="row">
      <div class="col">
    	 <!--begin::Input group-->
	         <div class="fv-row mb-10 col-md-12" id="catBill" style="display: none;">
             <!--begin::Label-->
             <label class="fw-bold-gray fs-6 mb-2 editlable">Bill No</label>
             <!--end::Label-->

           <!--begin::Input-->
                 <input type="text" id="bill" name="bill[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
        </div>
        </div>
	 <!--begin::Input group-->
        <div class="col">
	    <div class="fv-row mb-10 col-md-10" id="catamt" style="display: none;">
            <!--begin::Label-->
            <label class="fw-bold-gray fs-6 mb-2 editlable">Amount</label>
             <!--end::Label-->
             <!--begin::Input-->
            <input type="text" id="amount" name="amount[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/>
        <!--end::Input-->
    </div>
   </div>

   <div class="fv-row mb-10 col-md-4" id="catfrom" style="display: none;">
        <!--begin::Label-->
        <label class="fw-bold-gray fs-6 mb-2 editlable">From</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="from" name="from[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
        </div>
   </div>
    <div class="row">
    
	 <!--begin::Input group-->
     <div class="col">
	 <div class="fv-row mb-10 col-md-10 editlable" id="catmonth" style="display: none;">
        <!--begin::Label-->
        <label class="fw-bold-gray fs-6 mb-2">Month</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="month" name="month[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/>
        <!--end::Input-->
    </div>
   </div>

    <div class="fv-row mb-10 col-md-4" id="catother" style="display: none;">
        <!--begin::Label-->
        <label class="fw-bold-gray fs-6 mb-2 editlable">Other</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="other_detail" name="other_detail[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
    </div>
  </div>
   <div class="row">
    
    <!--begin::Input group-->
    <div class="col">
    <div class="fv-row mb-10 col-md-10 editlable" id="catagree" style="display: none;">
       <!--begin::Label-->
       <label class="fw-bold-gray fs-6 mb-2">Financial document</label>
       <!--end::Label-->
       <!--begin::Input-->
       <input type="text" id="financial" name="financial[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/>
       <!--end::Input-->
   </div>
    </div>

           <div class="fv-row mb-10 col-md-4" id="catment" style="display: none;">
          <!--begin::Label-->
          <label class="fw-bold-gray fs-6 mb-2 editlable">kyc</label>
          <!--end::Label-->
           <!--begin::Input-->
           <input type="text" id="kyc" name="kyc[]" class="form-control form-control-solid mb-3 mb-lg-0"      placeholder="" value="" />
           <!--end::Input-->
             </div>
         </div>
    </div>
  </div>
       </div>
       <div class="row">
             <div class="col addrow">
                <div class="mb-3"><h6 style="background: rgb(238 231 18);padding: 5px 0;text-align: center;width:18%;float:right; ">Add Row</h6></div>
                
              </div>
             </div>
              <!--<button type="button" id="newsectionbtn" class="btn btn-warning" style="float: right;"><span     class="glyphicon glyphicon-plus-sign"></span>Add</button>  -->
		      <button type="submit" class="btn btn-danger" style="margin-left:75px;">
                   <span class="indicator-label">Submit</span>
		           <span class="indicator-progress">Please wait...
	         	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
	       	</button>
          </div>
     </form>		
    </div>
<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>

	<!--end::Post-->
      </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
                   
    $(document).ready(function(){
      
    $('.addrow').on('click', function(){
    var appendData ='<div class="insertRowAfter1"> <h3> <b>Document Details</b> </h3> <div class="row"> <div class="col"> <label for="" class="form-label editlable">Add Catagories</label> <select class="form-select form-select-solid" id="catagories" name="catagories[]" data-control="select2" data-placeholder="~~Select~~" onchange="rowCheck(this);"> <option disabled selected>select..</option>@foreach($categorys as $category) <option value="{{$category->catagories}}">{{$category->catagories}}</option>@endforeach <option>Other</option> </select> <br></div><div class="col"> <label for="" class="form-label editlable">For</label> <select class="form-select form-select-solid" id="for" name="for[]" data-control="select2" data-placeholder="~~Select~~" onchange="" required> <option disabled selected>select..</option> @foreach($forcompany as $forcomp) <option value="{{$forcomp->for_company}}">{{$forcomp->for_company}}</option>@endforeach <option>other</option> </select> <br><br></div></div><div class="row"> <div class="col"> <div class="fv-row mb-10 col-md-12" id="newbill" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2 editlable">Bill No</label> <input type="text" id="bill" name="bill[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""/> </div></div><div class="col"> <div class="fv-row mb-10 col-md-10" id="newAmt" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2 editlable">Amount</label> <input type="text" id="amount" name="amount[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/> </div></div><div class="fv-row mb-10 col-md-4" id="newFrom" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2 editlable">From</label> <input type="text" id="from" name="from[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""/> </div></div><div class="row"> <div class="col"> <div class="fv-row mb-10 col-md-10 editlable" id="newMonth" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2">Month</label> <input type="text" id="month" name="month[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/> </div></div><div class="fv-row mb-10 col-md-4" id="catother" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2 editlable">Other</label> <input type="text" id="other_detail" name="other_detail[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""/> </div></div><div class="row"> <div class="col"> <div class="fv-row mb-10 col-md-10 editlable" id="nfinancial" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2">financial document</label> <input type="text" id="financial" name="financial[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/> </div></div><div class="fv-row mb-10 col-md-4" id="nkyc" style="display: none;"> <label class="fw-bold-gray fs-6 mb-2 editlable">kyc</label> <input type="text" id="kyc" name="kyc[]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""/> </div></div> <button type="button" class="btn btn-primary" id="remove"><i class="fa fa-trash"></button></div>';            
    $(appendData).insertAfter('.insertRowAfter'); 
     
     });

    });

    $(document).on('click','#remove', function(){
     
      $(this).closest('.insertRowAfter1').remove();
    });
    </script>

@endsection
