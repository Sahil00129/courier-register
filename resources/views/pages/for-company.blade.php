@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

	<!--begin::Toolbar-->
	
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body pt-0">     
					<!--begin::Table-->
					<table class="table align-middle table-row-dashed" id="comp">
						<!--begin::Table head-->
						<thead>
							<!--begin::Table row-->
							<tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">For</th>
								<th class="min-w-125px">Action</th>
								
							</tr>
							<!--end::Table row-->
						</thead>
						<!--end::Table head-->
						<!--begin::Table body-->
                       
						<tbody class="fw-bold text-gray-600">
                        @foreach ($forcompanys as $forcompany)
							<tr>
                            <td>{{$forcompany->for_company}}</td>
							<td><button type= "button" class="btn btn-warning editbtn btn-sm"  value="{{$forcompany->id }}">Edit</button></td>
                           </tr>
                         @endforeach
						
						</tbody>
						<!--end::Table body-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div> 
		<!--end::Container-->
	</div>
	 <!--begin::Modal - New Card-->
	 <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Modal header-->
											<div class="modal-header">
												<!--begin::Modal title-->
												<h2>Update Company</h2>
												<!--end::Modal title-->
												<!--begin::Close-->
												<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</div>
												<!--end::Close-->
											</div>
											<!--end::Modal header-->
											<!--begin::Modal body-->
											<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
												<!--begin::Form-->
                                                <form action="{{ url('updated-company')}}" method="POST" >
												@csrf
												@method('PUT')
												<input type="hidden" name="for_id" id="for_id" value=""/>
                                                        <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                  <label class="fw-bold fs-6 mb-2">Department</label>
                                                  <!--end::Label-->
      
                                               <!--begin::Input-->
                                                <input type="text" id="for_company" name="for_company" class="form-control" style="width:95%;" placeholder="" value="" />
                                               <!--end::Input-->
                                                   </div>			
														<button type="submit"  class="btn btn-primary">
															Update
														</button>	
                                                    </form>

											<!--end::Form-->
											</div>
											<!--end::Modal body-->
										</div>
										<!--end::Modal content-->
									</div>
									<!--end::Modal dialog-->
								</div>
								<!--end::Modal - New Card-->
								
	<script>
	$(document).ready(function(){
		//alert('h'); die;
		$(document).on('click','.editbtn', function(){
			var for_id = $(this).val();
			//alert(for_id ); 
			$('#editModal').modal('show');
			$.ajax({
				type: "GET",
				url: "/edit-company/"+for_id,
				success: function(response){
					//console.log(response.nw);
					$('#for_company').val(response.forcomp.for_company);
					$('#for_id').val(for_id);
				}
			});
			
		});
	});
</script>
<script>
	$(document).ready( function () {
    $('#comp').DataTable();
} );
	</script>

@endsection
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>