@extends('layouts.main')

@section('title', 'Create New')

@section('content')

<style>
.ui-menu {
    width: 300px !important;
    background: #ccc !important;
    padding: 10px !important;
    list-style-type: none;
}
.ui-autocomplete {
    max-height: 200px;
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
</style>



<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

	<!--begin::Toolbar-->

	<div class="toolbar" id="kt_toolbar">

		<!--begin::Container-->

		<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">

			<!--begin::Page title-->

			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

				<!--begin::Title-->

				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Update Data</h1>

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
                <h3><b><u>Sender Details</u></b></h3>
  <form method="POST" action="{{'update-data/'.$sender->id}}">
      @csrf
      @method('PUT')
      <div class="row">
   <div class="col">
		<div class="fv-row mb-10">
        <!--begin::Label-->
       
        <label class="fw-bold fs-6 mb-2">From</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="" name="name_company" class="form-control form-control-solid mb-3 mb-lg-0" style="width:95%;" placeholder="" value="{{$sender->name_company}}" />
        <!--end::Input-->
       </div>
      </div>
      <div class="col">
       <label for="" class="form-label">Location</label>
    <textarea id="location" name="location" class="form-control form-control form-control-solid" data-kt-autosize="true" style="width:99%;" rows="1" cols="1" value="">{{$sender->location}}</textarea>
    </div>

 
    <div class="col">
	 <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Telephone No</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="telephone_no" name="telephone_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->telephone_no}}" />
        <!--end::Input-->
    </div>
</div>
</div>

    <h3><b><u>Courier Details</u></b></h3>
	<div class="row">
    <div class="col"> 
        <label for="" class="form-label">Courier Name</label>
        <select class="form-select form-select-solid" id="slct" name="slct" data-control="select2" data-placeholder="~~Select~~" onchange="yesnoCheck(this);" required> 
        <option value="{{$sender->courier_name}}" selected >{{$sender->courier_name}}</option>
		@foreach($couriers as $courier)
            <option value="{{$courier->courier_name}}">{{$courier->courier_name}}</option>
		@endforeach
      <option>other</option>

        </select><br>
		<br>
		<div id="ifYes" style="display: none;">
		<input type="text" id="other" name="other" class="form-control form-control-solid mb-3 mb-lg-0" style="width:45%;" placeholder="other" value=""/>
 </div><br>

 </div>
    <div class="col">
	 <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Docket No.</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="docket_no" name="docket_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->docket_no}}" required/>
        <!--end::Input-->
    </div>
</div>
<div class="col">
	 <!--begin::Input group-->
	 <div class="fv-row mb-10 col-md-12">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Docket Date</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="date" id="docket_date" name="docket_date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->docket_date}}" required/>
        <!--end::Input-->
    </div>
</div>
</div>
<!--
 $l = (explode(",",$sender->document_details));
 //echo'<pre>'; print_r($l); die;
   $bill = @$l[0];
   $amount = @$l[1];
   $from = @$l[2];
   $month = @$l[3];
   $financial = @$l[4];
   $kyc = @$l[5];
-->
<h3><b><u>Document Details</u></b></h3>
<div class="row">
<div class="col">
<label for="" class="form-label">Add Catagories</label>
        <select class="form-select form-select-solid" id="catagories" name="catagories" data-control="select2" data-placeholder="~~Select~~" onchange="depCheck(this);"> 
		<option value="{{$sender->catagories}}" selected >{{$sender->catagories}}</option>
        @foreach($categorys as $category)
        
            <option value="{{$category->catagories}}">{{$category->catagories}}</option>
		@endforeach
		
      <option>other</option>

        </select><br>
        <div id="catYes" style="display: none;">
		<input type="text" id="other_cat" name="other_cat" class="form-control form-control-solid mb-3 mb-lg-0" style="width:45%;" placeholder="other" value=""/>
   </div><br>
   </div>
   <div class="col"> 
        <label for="" class="form-label">For</label>
        <select class="form-select form-select-solid" id="for" name="for" data-control="select2" data-placeholder="~~Select~~" onchange="forCheck(this);" required> 
	   	<option value="{{$sender->for}}" selected >{{$sender->for}}</option>
           @foreach($forcompany as $forcomp)
            <option value="{{$forcomp->for_company}}">{{$forcomp->for_company}}</option>
		@endforeach
      <option>other</option>
        </select><br>
		<br>
		<div id="forYes" style="display: none;">
		<input type="text" id="for_other" name="for_other" class="form-control form-control-solid mb-3 mb-lg-0" style="width:45%;" placeholder="other" value=""/>
 </div><br>

 </div>
</div>

<div class="row">
<div class="col">

	 <!--begin::Input group-->
	 <div class="fv-row mb-10 col-md-12" id="catBill" style="display: none;">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2" >Bill No</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="bill" name="bill" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->bill}}" />
        <!--end::Input-->
    </div>
</div>
	 <!--begin::Input group-->
     <div class="col">
	 <div class="fv-row mb-10 col-md-10"  id="catamt" style="display: none;">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Amount</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="amount" name="amount" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->amount}}" style="width:119%;"/>
        <!--end::Input-->
    </div>
</div>

</div>
<div class="row">
<div class="col" id="catfrom" style="display: none;" >

        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">From</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="from" name="from" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->from}}" />
        <!--end::Input-->
   
</div>
	 <!--begin::Input group-->
     <div class="col">
	 <div class="fv-row mb-10 col-md-10" id="catmonth" style="display: none;">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Month</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="month" name="month" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->month}}" style="width:119%;"/>
        <!--end::Input-->
    </div>
</div>
</div>
<div class="row">
<div class="col">
    <div class="fv-row mb-10 col-md-10 editlable" id="catagree" style="display: none;">
       <!--begin::Label-->
       <label class="fw-bold-gray fs-6 mb-2">Financial document</label>
       <!--end::Label-->
       <!--begin::Input-->
       <input type="text" id="financial" name="financial" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->financial}}" style="width:119%;"/>
       <!--end::Input-->
   </div>
    </div>
    <div class="fv-row mb-10 col-md-4" id="catment" style="display: none;">
          <!--begin::Label-->
          <label class="fw-bold-gray fs-6 mb-2 editlable">kyc</label>
          <!--end::Label-->
           <!--begin::Input-->
           <input type="text" id="kyc" name="kyc" class="form-control form-control-solid mb-3 mb-lg-0"      placeholder="" value="{{$sender->kyc}}" />
           <!--end::Input-->
             </div>
   </div>
   <!--end::solid autosize textarea-->
   <div class="row">

   <div class="col"> 
   <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Given To</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="given_to" name="given_to" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->given_to}}" />
        <!--end::Input-->
     </div>
     </div>
     <div class="col"> 
     <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Checked By</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="checked_by" name="checked_by" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$sender->checked_by}}" />
        <!--end::Input-->
     </div>
     </div>
     </div>


		<button type="submit" class="btn btn-danger">Update</button>
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
<script src="{{('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(Session::has('update'))
<script>
	swal("Good job", "Data has been imported successfully!!","success");
</script>
	@endif

@endsection