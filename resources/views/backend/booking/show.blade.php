@extends('layouts.app')
<style>
	.pending,.accepted,.canceled,.completed{
		text-align: center;
		border-radius: 10px;
		color: #fff;
	}
	.pending{
		background: #fc760894;

	}
	.accepted{
		background: #83e405;
	}
	.canceled{
		background: rgb(240, 40, 40);
	}
	.completed{
		background: #0fccee;
	}
</style>
@section('content')
<div class="container p-3">
    <div class="main-body">
        <div class="row">
            {{-- start driver  --}}
            <div class="col-lg-3 mb-3">
                <div class="card mb-3 h-100">
                    <div class="card-body position-relative">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center overflow-hidden">

                            @if ($user->userImage && $user->userImage->profile_image && file_exists('uploads/images/profiles/'.$user->userImage->profile_image))

                                <div class="">
                                    <img src="{{ asset('uploads/images/profiles/'. $user->userImage->profile_image) }}" alt="User"
                                        style="width:100%;height:20rem; object-fit:cover;object-position: center;">

                                </div>
                            @else
                                <img class="" src="{{ asset('assets/logo/user.png') }}" alt="User"
                                    style="width: 10rem;height: 10rem; object-fit: cover; object-position: center;">
                            @endif

                            <div class="mt-3">
                                <h3>{{ $user->name }}</h3>
                            </div>
                        </div>
                        <hr class="my-4">
                            <div class="d-flex justify-content-center w-100">
                                <ul class="list-group list-group-flush w-100">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Driver ID</h6>
                                        <span class="text-muted">{{ $user->driver_id }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                                        <h6 class="mb-0">Phone</h6>
                                        <span class="text-muted"  id="phone_copy">
                                            {{ $user->phone }}
                                            <i class="btn fa-regular fa-clipboard cursor-pointer position-absolute p-0 border-0" style="right: -0.25rem;top:0.75rem;" id="copy_btn" onclick="copyToClipboard('phone_copy')"></i>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Birth Date</h6>
                                        <span class="text-muted">{{ Carbon\Carbon::parse($user->birth_date)->format('F j,Y') }}</span>
                                    </li>
                                </ul>
                            </div>

                    </div>
                </div>
            </div>
            {{-- end driver  --}}


            {{-- start trip detail --}}
            <div class="col-lg-6 mb-3">

                <div class="card mb-6 h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <p>Trip Detail</p>
                            <p>Date : <span>{{ Carbon\Carbon::parse($trip->updated_up)->format('F j,Y h:m A') }}</span></p>
                            {{-- <p>Date : <span>{{ $trip->updated_up->format('F j,Y h:m A') }}</span></p> --}}


                        </div>
                    </div>
                    <div class="card-body position-relative">

                        <div class="d-flex my-2 position-relative">
                            <div class="col-4">Trip ID</div>
                            <div class="col-1">:</div>
                            <div> ID-{{$trip->id}} </div>
                            <div class="position-absolute end-0 {{$trip->status}} px-2">{{$trip->status}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Distance (Km)</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->distance}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Duration (time)</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->distance}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Waiting Time</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->waiting_time}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Waiting Cost</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->waiting_fee}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Normal Cost</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->normal_fee}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Extra Cost</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->extra_fee}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Total Cost</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->total_cost}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Trip From</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->start_address === null ? 'No start address' : $trip->start_address}}</div>
                        </div>
                        <div class="d-flex my-2 ">
                            <div class="col-4">Trip To</div>
                            <div class="col-1">:</div>
                            <div> {{$trip->end_address === null ? 'No start address' : $trip->end_address}}</div>
                        </div>


                    </div>
                </div>
            </div>


            {{-- end trip detail  --}}


            {{-- start customer  --}}
            <div class="col-lg-3 mb-3">
                @if($customer !== null)
                <div class="card mb-3 h-100">
                    <div class="card-body position-relative">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center overflow-hidden">

                            @if ($customer->userImage && $customer->userImage->profile_image && file_exists('uploads/images/profiles/'.$customer->userImage->profile_image))

                                <div class="">
                                    <img src="{{ asset('uploads/images/profiles/'. $customer->userImage->profile_image) }}" alt="User"
                                        style="width:100%;height:20rem; object-fit:cover;object-position: center;">

                                </div>
                            @else
                                <img class="" src="{{ asset('assets/logo/user.png') }}" alt="User"
                                    style="width: 10rem;height: 10rem; object-fit: cover; object-position: center;">
                            @endif

                            <div class="mt-3">
                                <h3>{{ $customer->name }}</h3>
                            </div>
                        </div>
                        <hr class="my-4">
                            <div class="d-flex justify-content-center w-100">
                                <ul class="list-group list-group-flush w-100">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Customer ID</h6>
                                        <span class="text-muted">{{ $customer->driver_id }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                                        <h6 class="mb-0">Phone</h6>
                                        <span class="text-muted"  id="phone_copy">
                                            {{ $customer->phone }}
                                            <i class="btn fa-regular fa-clipboard cursor-pointer position-absolute p-0 border-0" style="right: -0.25rem;top:0.75rem;" id="copy_btn" onclick="copyToClipboard('phone_copy')"></i>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Birth Date</h6>
                                        <span class="text-muted">{{ Carbon\Carbon::parse($customer->birth_date)->format('F j,Y') }}</span>
                                    </li>
                                </ul>
                            </div>

                    </div>
                </div>

                @else
                <div class="card mb-3 h-100 position-relative">
                    <div class="card-body position-relative">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center overflow-hidden">

                                <div class="">
                                    <img class="" src="{{ asset('assets/logo/user.png') }}" alt="User"
                                    style="width: 10rem;height: 10rem; object-fit: cover; object-position: center;">

                                </div>


                            <div class="mt-3">
                                <h3>No search</h3>
                            </div>
                        </div>
                        <hr class="my-4">
                            <div class="d-flex justify-content-center w-100">
                                <ul class="list-group list-group-flush w-100">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Customer ID</h6>
                                        <span class="text-muted">NO search</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                                        <h6 class="mb-0">Phone</h6>
                                        <span class="text-muted"  id="phone_copy">
                                            No search
                                            <i class="btn fa-regular fa-clipboard cursor-pointer position-absolute p-0 border-0" style="right: -0.25rem;top:0.75rem;" id="copy_btn" onclick="copyToClipboard('phone_copy')"></i>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Birth Date</h6>
                                        <span class="text-muted">NO search</span>
                                    </li>
                                </ul>
                            </div>

                    </div>
                    <div class="position-absolute w-100 h-100" style="background:#ffffff98">
                        <div class="position-absolute top-50 shadow-lg" style="transform: translateY(-50%)">
                            <div class="fs-4 text-center text-danger fw-bold" style="transform: rotate(30deg)">
                                Normal trip in user not found !
                            </div>
                        </div>
                    </div>
                </div>

                @endif

            </div>
           
        </div>
       
    </div>
</div>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        const domain = window.location.href;
        let chartInstance = null;

        async function userChart(range,userId) {
            await axios.get(`${domain}/chart/${range}`)
                .then((response) => {
                    const data = response.data.transactions;
                    let arr = Object.keys(data).map((key) => {
                        return {
                            date: data[key].date,
                            topup: data[key].topup,
                            commission: data[key].commission,
                        };
                    });
                    if (!chartInstance) {
                        // Create the chart instance if it doesn't exist
                        const chartElement = document.getElementById("userChart");
                        chartInstance = new Chart(chartElement, {
                            type: 'line',
                            data: {
                                labels: arr.map((row) => row.date),
                                datasets: [
                                    {
                                        label: `Topup per ${range}`,
                                        data: arr.map((row) => row.topup),
                                        borderColor: '#ffc107',
                                        backgroundColor: '#ffc107',
                                        tension: 0.2,
                                    },
                                    {
                                        label: `Commission per ${range}`,
                                        data: arr.map((row) => row.commission),
                                        borderColor: '#00C4FF',
                                        backgroundColor: '#30A2FF',
                                        tension: 0.2,
                                    },
                                ],
                            },
                        });
                    } else {
                        // Update the existing chart instance with new data
                        chartInstance.data.labels = arr.map((row) => row.date);
                        chartInstance.data.datasets[0].label = `Topup per ${range}`;
                        chartInstance.data.datasets[1].label = `Commission per ${range}`;
                        chartInstance.data.datasets[0].data = arr.map((row) => row.topup);
                        chartInstance.data.datasets[1].data = arr.map((row) => row.commission);

                        chartInstance.update();
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
                const ranges = ['day', 'week', 'month', 'year'];
                    ranges.forEach((rag) => {
                        document.querySelector(`#user_${rag}`).classList.remove('btn-dark');
                        document.querySelector(`#user_${rag}`).classList.add('btn-secondary');
                    });

                    document.querySelector(`#user_${range}`).classList.add('btn-dark');
                    document.querySelector(`#user_${range}`).classList.remove('btn-secondary');
        }

        window.onload = function () {
            userChart('month',{{ $user->id }});

        };

        function copyToClipboard(id) {
            const text = document.querySelector(`#${id}`).innerText;
            navigator.clipboard.writeText(text)
                .then(() => {
                console.log('Text copied to clipboard',text);
                 document.querySelector('#copy_btn').classList.remove('fa-clipboard');
                 document.querySelector('#copy_btn').classList.add('fa-copy');
                 setTimeout(() => {
                    document.querySelector('#copy_btn').classList.add('fa-clipboard');
                    document.querySelector('#copy_btn').classList.remove('fa-copy');
                 }, 5000);
                })
                .catch((error) => {
                console.error('Error copying text to clipboard:', error);
                });
        }


     


    </script>
@endpush
