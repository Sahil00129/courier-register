	

<!--begin::Scrolltop-->

<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">

			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->

			<span class="svg-icon">

				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">

					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />

					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />

				</svg>

			</span>

			<!--end::Svg Icon-->

		</div>

		<!--end::Scrolltop-->

		<!--datatables-->
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
        

        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
	<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">   -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
		<script src="{{ asset('js/import.js') }}"></script>
        

       <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $(document).ready(function(){
       //alert('h'); die;


       $('#search').on('keyup',function () {
                var query = $(this).val();
                $.ajax({
                    url:'{{ url('autocomplete-search') }}',
                    type:'GET',
                    data:{'search':query},
                    success:function (data) {
                        $('#product_list').html(data);
                    }
                });
            });
            $(document).on('click', 'li', function(){
                var value = $(this).text();        
                var location = value.split('-');         //break value in js split
                for(var i = 0; i < location.length; i++){
           

                $('#search').val(value);
                $('#location').val(location[1]);
                $('#telephone_no').val(location[2]);
                $('#product_list').html("");
                }
            });
  /*  $("#search").autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{ url('autocomplete-search') }}",
            type: 'get',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           // Set selection
           $('#search').val(ui.item.label); // display the selected text
           $('#location').val(ui.item.value); // save selected id to input
           $('#telephone_no').val(ui.item.num);
           return false;
        }
      });   */
});
//
	function yesnoCheck(that) {
    if (that.value == "other") {
        document.getElementById("ifYes").style.display = "block";
    } else {
        document.getElementById("ifYes").style.display = "none";
    }
}
//
function depCheck(that) {
    if (that.value == "Agreement") {
        document.getElementById("catagree").style.display = "block";
        document.getElementById("catment").style.display = "block";
    } else if (that.value == "Rent Agreement"){
        document.getElementById("catagree").style.display = "block";
        document.getElementById("catment").style.display = "block";
     } else if (that.value == "Distributor Agreement"){
        document.getElementById("catagree").style.display = "block";
        document.getElementById("catment").style.display = "block";
    } else{
        document.getElementById("catagree").style.display = "none";
        document.getElementById("catment").style.display = "none";   
    }

    if(that.value == "Transport Bills"){
        document.getElementById("catBill").style.display = "block";
        document.getElementById("catamt").style.display = "block";
        document.getElementById("catfrom").style.display = "block";
        document.getElementById("catmonth").style.display = "block";
    }else if (that.value == "Courier Bills"){
        document.getElementById("catBill").style.display = "block";
        document.getElementById("catamt").style.display = "block";
        document.getElementById("catfrom").style.display = "block";
        document.getElementById("catmonth").style.display = "block";
    }else{
        document.getElementById("catBill").style.display = "none";
        document.getElementById("catamt").style.display = "none"; 
        document.getElementById("catfrom").style.display = "none";
        document.getElementById("catmonth").style.display = "none";
    }

    if(that.value == "Other"){
        document.getElementById("catYes").style.display = "block";
    }else{
        document.getElementById("catYes").style.display = "none";
    }
}
//
//////new section/////
//document.getElementById("newsectionbtn").onclick = function() {
 // var container = document.getElementById("container");
// var section = document.getElementById("mainsection");
 // container.appendChild(section.cloneNode(true));
//}
///



///////////////////////////////////////////////////////////
  function rowCheck(that) {
      if (that.value == "Agreement") {
        document.getElementById("nfinancial").style.display = "block";
        document.getElementById("nkyc").style.display = "block";
      } else if (that.value == "Rent Agreement"){
        document.getElementById("nfinancial").style.display = "block";
        document.getElementById("nkyc").style.display = "block";
      } else if (that.value == "Distributor Agreement"){
        document.getElementById("nfinancial").style.display = "block";
        document.getElementById("nkyc").style.display = "block";
     } else{
        document.getElementById("nfinancial").style.display = "none";
        document.getElementById("nkyc").style.display = "none";   
     }

    if(that.value == "Transport Bills"){
        document.getElementById("newbill").style.display = "block";
        document.getElementById("newAmt").style.display = "block";
        document.getElementById("newFrom").style.display = "block";
        document.getElementById("newMonth").style.display = "block";
    }else if (that.value == "Courier Bills"){
        document.getElementById("newbill").style.display = "block";
        document.getElementById("newAmt").style.display = "block";
        document.getElementById("newFrom").style.display = "block";
        document.getElementById("newMonth").style.display = "block";
    }else{
        document.getElementById("newbill").style.display = "none";
        document.getElementById("newAmt").style.display = "none"; 
        document.getElementById("newFrom").style.display = "none";
        document.getElementById("newMonth").style.display = "none";
    }
    if(that.value == "Other"){
        document.getElementById("rowYes").style.display = "block";
    }else{
        document.getElementById("rowYes").style.display = "none";
    }
}


////////////////////////////////////////////////////////////
function forCheck(that) {
    if (that.value == "other") {
        document.getElementById("forYes").style.display = "block";
    } else {
        document.getElementById("forYes").style.display = "none";
    }
}
////////////////////////////

///////////////////////////

			//alert('h'); die;
			$('#newSender').submit(function(e) {
		    e.preventDefault();
        var slct = jQuery('#slct').val();
        if (!slct) {
        swal("Error!", "Please select courier name", "error");
        return false;
       }
			//alert (this); die;
				$.ajax({
					  url: "/save-newSender", 
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
                        $('#newSender').trigger('reset');       
                        //this.reset();
                        //console.log(data.ignoredItems);
                        //console.log(data.ignoredcount);
                        if(data.success === true) { 
                          
                           
                            swal("Success!", "Data has been Saved", "success");
                          }
                        
                        else{
                        swal("Error!", data.messages, "error");
                        }
                        }
				}); 
			});	
 </script>
    @if(Session::has('deleted'))
<script>
	swal("Deleted", "Data has been Deleted","success");
</script>
	@endif


  </script>
    @if(Session::has('update'))
<script>
	swal("Updated", "Data has been successfully updated","success");
</script>
	@endif

    