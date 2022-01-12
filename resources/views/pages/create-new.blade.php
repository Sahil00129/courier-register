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
                <h3><b><u>Sender Details</u></b></h3>
  <form id="newSender" method="post">
      @csrf
      <div class="row">
   <div class="col">
		<div class="fv-row mb-10">
        <!--begin::Label-->
       
        <label class="fw-bold fs-6 mb-2">From</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="search" name="name_company" class="form-control form-control-solid mb-3 mb-lg-0" style="width:95%;" placeholder="" value="" />
        <!--end::Input-->
       </div>
</div>
<div class="col">
       <label for="" class="form-label">Address</label>
    <textarea id="address" name="address" class="form-control form-control form-control-solid" data-kt-autosize="true" style="width:99%;" rows="1" cols="1"></textarea>
</div>



    
    <div class="col">
	 <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">City</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="city" name="city" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
    </div>
</div>
</div>
<div class="row">
<div class="col">
	 <!--begin::Input group-->
	 <div class="fv-row mb-10 col-md-12">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Distt</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="distt" name="distt" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
    </div>
</div>
	 <!--begin::Input group-->
     <div class="col">
	 <div class="fv-row mb-10 col-md-10">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Pin Code</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="pin_code" name="pin_code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" style="width:119%;"/>
        <!--end::Input-->
    </div>
</div>

<div class="fv-row mb-10 col-md-4">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Telephone No.</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" id="telephone_no" name="telephone_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
    </div>
</div>
    <h3><b><u>Courier Details</u></b></h3>
	<div class="row">
    <div class="col">
	 <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Docket No.</label>
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
        <label class="fw-bold fs-6 mb-2">Docket Date</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="date" id="docket_date" name="docket_date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
        <!--end::Input-->
    </div>
</div>
</div>

	   <!--begin::solid autosize textarea-->
    <label for="" class="form-label">Document Details</label>
    <textarea  id="document" name="document" class="form-control form-control form-control-solid" data-kt-autosize="true" ></textarea><br>
	<br>

<!--end::solid autosize textarea-->
<div class="row">
   <div class="col"> 
        <label for="" class="form-label">Courier Name</label>
        <select class="form-select form-select-solid" id="slct" name="slct" data-control="select2" data-placeholder="~~Select~~" onchange="yesnoCheck(this);" > 
		<option>select..</option>
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
        <label class="fw-bold fs-6 mb-2">Given To</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="given_to" name="given_to" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
        <!--end::Input-->
    </div>
</div>
</div>

		<button type="submit" class="btn btn-danger">Add</button>
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

@endsection
