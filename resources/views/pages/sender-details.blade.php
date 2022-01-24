@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<style>
div#itemList_filter {
    width: 70%;
    float: left;
}
 .dt-buttons.btn-group.flex-wrap {
    float: right;
    margin-top: 10px;
}
select.cfilter {
    border: 1px solid #cccccc54;
    width: 100%;
}
th {
    color: #000 !important;
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
				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Sender</h1>
				<!--end::Title-->
				<!--begin::Separator-->	<span class="h-20px border-gray-200 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">	<a href="#" class="text-muted text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">	<span class="bullet bg-gray-200 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Add Sender</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">	<span class="bullet bg-gray-200 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-dark"></li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center py-1">
				<!--begin::Wrapper-->
				<div class="me-4">
                     
				</div>
				<!--end::Wrapper-->
				<!--begin::Button-->
                <a href="{{url('importExportView') }}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Import</a>
				<!--end::Button-->
			</div>
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
    
    <form id="sender" method="post">
    @csrf
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body pt-0" style="margin: 15px; padding:39px;">
					<!--begin::Table-->
					 <!--begin::Input group-->

                     <div class="row">
   <div class="col">
    <div class="fv-row mb-10">
        <!--begin::Label-->
       
        <label class="fw-bold fs-6 mb-2">Name</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="name" name="name" class="form-control form-control-solid mb-3 mb-lg-0" style="width:81%;" placeholder="" value="" required/>
        <!--end::Input-->
</div>
    </div>
	<!--begin::Input group-->
    <div class="col">
    <div class="mb-10">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-5">Type</label><br>
        <!--end::Label-->

        <!--begin::Input row-->
       
            <!--begin::Radio-->

            <div class="form-check form-check-inline">
                <!--begin::Input-->
                <input class="form-check-input me-3" name="type" type="radio" value="vendor" id="kt_docs_formvalidation_radio_option_1"/>
                <!--end::Input-->

                <!--begin::Label-->
                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_1">
                    <div class="fw-bolder text-gray-800">Vendor</div>
                </label>
                <!--end::Label-->
            </div>
            <!--end::Radio-->

            <!--begin::Radio-->
            <div class="form-check form-check-inline">
                <!--begin::Input-->
                <input class="form-check-input me-3" name="type" type="radio" value="government department" id="kt_docs_formvalidation_radio_option_2" />
                <!--end::Input-->

                <!--begin::Label-->
                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_2">
                    <div class="fw-bolder text-gray-800">Government Department</div>
                </label>
                <!--end::Label-->
            </div>
            <!--end::Radio-->

            <!--begin::Radio--> 
            <div class="form-check form-check-inline">
                <!--begin::Input-->
                <input class="form-check-input me-3" name="type" type="radio" value="Customer" id="kt_docs_formvalidation_radio_option_3" />
                <!--end::Input-->

                <!--begin::Label-->
                <label class="form-check-label" for="kt_docs_formvalidation_radio_option_3">
                    <div class="fw-bolder text-gray-800">Customer</div>
                </label>
                <!--end::Label-->
            </div>
            <!--end::Radio-->
            <!--begin::Radio-->
            <div class="form-check form-check-inline">
                <!--begin::Input-->
                <input class="form-check-input me-3" name="chkPassPort" type="radio" onclick="ShowHideDiv()" value="other" id="chkYes" />
                <!--end::Input-->

                <!--begin::Label-->
                <label class="form-check-label" for="chkYes">
                    <div class="fw-bolder text-gray-800">Other</div>
                </label>
                <!--end::Label-->
            </div>
            <div id="dvPassport" style="display: none">
        other:
        <input type="text" id="txtPassportNumber" />
    </div>
            <!--end::Radio-->
        </div>
</div>
        <!--end::Input row-->
    </div>

    <!--end::Input group-->
	<div class="row">
    <div class="col">
	 <div class="fv-row mb-10 col-md-16">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Location</label>
        <!--end::Label-->

        <!--begin::Input-->
        <textarea id="location" name="location" class="form-control form-control form-control-solid" data-kt-autosize="true" style="width:99%;" rows="1" cols="1"></textarea>
        <!--end::Input-->
    </div>
</div>
<div class="col">
	 <!--begin::Input group--> 
	 <div class="fv-row mb-10 col-md-12">
        <!--begin::Label-->
        <label class="fw-bold fs-6 mb-2">Telephone No</label>
        <!--end::Label-->

        <!--begin::Input-->
        <input type="text" id="telephone_no" name="telephone_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
        <!--end::Input-->
    </div>
     </div>
    </div>
	<button type="submit" class="btn btn-danger"><span class="indicator-label">Save</span>
		<span class="indicator-progress">Please wait...
		<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span></button>                 
     </form>      


						<!--end::Table body-->
					
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->

		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<script src="{{('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
<script>
  
     $(document).ready(function(){
			//alert('h'); die;
			$('#sender').submit(function(e) {
		    e.preventDefault();
			//alert (this); die;
       
  
				$.ajax({
					  url: "/save-sender", 
					  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					  type: 'POST',  
					  data:new FormData(this),
					  processData: false,
					  contentType: false,
                      beforeSend: function(){
                      $(".indicator-progress").show(); 
                      $(".indicator-label").hide();
                       },
					  success: (data) => {
                        $(".indicator-progress").hide();
                        $(".indicator-label").show();
                       $('#sender').trigger('reset');
                        //this.reset();
                        //console.log(data.ignoredItems); 
                        //console.log(data.ignoredcount);
                        if(data.success === true) { 
                          
                           
                            swal("Success!", "Data has been Submitted successfully", "success");
                            
                          }
                        
                        else{
                        swal("Error!", data.messages, "error");
                        
                        }
                    
                        }
                        
				}); 
			});	

		});
    </script>
    <script>
        function ShowHideDiv() {
            var chkYes = document.getElementById("chkYes");
            var dvPassport = document.getElementById("dvPassport");
            dvPassport.style.display = chkYes.checked ? "block" : "none";
        }
   </script>

@endsection