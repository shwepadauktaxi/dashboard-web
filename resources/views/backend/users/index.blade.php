@extends('layouts.app')

@section('content')
	<div class=" container">
		<div class="col-md-3">
			<form id="searchform">
				@csrf
				<div class="input-group mb-3">
					<button class="btn btn-outline-secondary text-dark" type="submit" style="border:1px solid #ced4da"><i
							class="fa-solid fa-magnifying-glass">
						</i>
					</button>
					<input class="form-control" name="key" type="text" id="search" placeholder="Search">
				</div>
			</form>
		</div>
		<div class="table-responsive small loader-container">
			<table class="table table-striped table-hover" id="mytable" height="100%">
				<thead class=" table-secondary" style="border-bottom:1px solid #ccc">
					<tr class="">
						
						<th>Driver ID</th>
						<th>Driver Name</th>
						<th>Vehicle number</th>
						<th>Phone number</th>
						<th>Address</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="table-group-divider"  style="border-top:10px solid #ffffff">


				</tbody>
			</table>
            <div class="loader">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>



			{{-- <div class="row m-0 justify-content-between">
				<div class="col-md-2 ps-0">
					<p class=" text-muted">Total: {{ $usersCount }}</p>
				</div>
				
			</div> --}}

		</div>

	</div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>

        $(document).ready(function (){
            const gettbody = document.querySelector('#mytable tbody');
            const getloader = document.querySelector('.loader');
            // console.log(gettbody)
            let page = 1;

           async function fetchalldatasbypaginate(){
            const url = `/admin/drivers?page=${page}`;

                        let results;

                        await fetch(url).then(response=>{
                            // console.log(response);
                            return response.json();
                        }).then(data=>{
                            // console.log(data);
                            results = data.data;
                            // console.log(results);
                        }).catch(err=>{
                            console.log(err);
                        });

                        return results;
            }


            async function alldatastodom(){
                const getresults = await fetchalldatasbypaginate();
                // console.log(getresults)
                

                getresults.forEach((driver, idx) => {
                   
                    let newtr = document.createElement('tr');
                         newtr.id = `delete_${driver.id}`;
                         newtr.innerHTML = `
                                        
                                            
                                            <td>${driver.driver_id}</td>
                                            <td>
                                                <a class="text-dark text-decoration-none" href="/users/${driver.id}">${driver.name}</a>
                                            </td>
                                            <td>${ driver.vehicle ? driver.vehicle: '' }</td>
                                            <td>${ driver.phone }</td>
                                            <td>${ driver.address }</td>
                                            <td>${driver.status === 'active' ? '<span class="text-success">' + driver.status + '</span>' : '<span class="text-danger">' + driver.status + '</span>'}</td>
                                            <td>
                                                    <a href="/users/${driver.id}/edit" class="text-decoration-none text-success mx-1"><i class="fas fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="delete-btns text-decoration-none text-danger" data-idx="${driver.id}" data-id="${driver.id}"><i class="fas fa-trash"></i></a>
                                            </td>

                                    
                        `;


                        gettbody.appendChild(newtr);

                                });

                          
                       
                                
            }


            alldatastodom();



            document.addEventListener('scroll',()=>{
                // console.log(document.documentElement.scrollTop);
                // console.log(document.documentElement.scrollHeight);
                // console.log(document.documentElement.clientHeight);

                const {scrollTop,scrollHeight,clientHeight} = document.documentElement;

                if(scrollTop + clientHeight >= scrollHeight - 5){
                    // console.log('hay');
                    showloader();
                }

            });

            // Show loader & fetch more datas.
            function showloader(){
                    getloader.classList.add('show');

                    setTimeout(() => {
                        
                        getloader.classList.remove('show');
                  
                        setTimeout(()=>{
                            page++;
                            alldatastodom();
                        },300);

                    }, 1000);
            }
            // Show loader & fetch more datas

//start Delete item
            $(document).on('click', '.delete-btns', function () {

                const getidx = $(this).attr('data-idx');
                const getid = $(this).data('id');
                // console.log(getid);

                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert id ${getidx} !`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {

                    if (result.isConfirmed) {

                        // data remove
                        $.ajax({
                            url: `admin/drivers/${getid}`,
                            type: "DELETE",
                            data:{
                                    _token:'{{csrf_token()}}'
                                 },
                            dataType: "json",

                            success: function (response) {
                                // console.log(response); // 1
                                if (response) {
                                    // ui remove
                                    $(`#delete_${getid}`).remove();

                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your item has been deleted.",
                                        icon: "success"
                                    });
                                }

                            },
                            error: function (response) {
                                console.log("Error : ", response);
                            }
                        });

                    }

                });

            });


//end Delete item

//start search item  

            $('#searchform').submit(function(e){
                e.preventDefault();
                // console.log($('#searchform input[name="key"]').val());
                const data = $('#searchform input[name="key"]').val();
                if(data == ''){
                    page = 1;
                    showloader();
                }else{
                    searchdata(data)
                }
    
            })


            async function searchdata(params) {

                

                 $.ajax({
                    url : "/admin/drivers/search",
                    method : 'POST',
                    data : {
                        search : params,
                        _token:'{{csrf_token()}}'
                    },
                    success:(data=>{
                        // console.log(response)

                        gettbody.innerHTML= '';
                        let newtr = document.createElement('tr');
                         newtr.id = `delete_${data.id}`;
                         newtr.innerHTML = `
                                        
                                            
                                            <td>${data.driver_id}</td>
                                            <td>
                                                <a class="text-dark text-decoration-none" href="/users/${data.id}">${data.name}</a>
                                            </td>
                                            <td>${ data.vehicle ? data.vehicle: '' }</td>
                                            <td>${ data.phone }</td>
                                            <td>${ data.address }</td>
                                            <td>${data.status === 'active' ? '<span class="text-success">' + data.status + '</span>' : '<span class="text-danger">' + data.status + '</span>'}</td>
                                            <td>
                                                    <a href="/users/${data.id}/edit" class="text-decoration-none text-success mx-1"><i class="fas fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="delete-btns text-decoration-none text-danger" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash"></i></a>
                                            </td>

                                    
                        `;


                        gettbody.appendChild(newtr);
                    }),
                    error:error=>{
                        console.log(error)
                    }

                 })

                        
                
            }

//end search item 

        })

    </script>
@endpush
