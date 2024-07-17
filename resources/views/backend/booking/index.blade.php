@extends('layouts.app')
@push('style')
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
@endpush

@section('content')
	<div class="container">
		
		<div class="table-responsive small">
			<table class="table table-striped table-hover">
				<thead class="table-secondary align-top" style="border-bottom:1px solid #ccc">
					<tr class="text-center">
						<th>#</th>
						<th>Trip ID</th>
						<th>Driver Name</th>
						<th>Customer Name</th>
						<th>Distance (Km)</th>
						<th>Duration</th>					
						<th>Total Cost (Ks)</th>
						<th>Status</th>
					
						@role('admin')
							<th>Action</th>
						@endrole
					</tr>
				</thead>
				<tbody class="table-group-divider" style="border-top:10px solid #ffffff">
					{{-- @foreach ($trips as $key => $trip)
					
						<tr class="text-center">
						
							<td>{{$loop->index +1}}</td>
							<td scope="row"><a class="text-dark text-decoration-none" href="{{route('trip.show',$trip->id)}}">
								ID-{{$trip->id }}
							</a></td>
							

							<td>
								<a class="text-dark text-decoration-none"
									href="{{ route('trip.show', $trip->id) }}">
									{{$trip->user->name}}
								</a>
							</td>
							<td>
								@if($trip->user_id === null)
								-
								@else
								<a class="text-dark text-decoration-none"
									href="{{ route('trip.show', $trip->id) }}">
									@foreach($users as $user)
									 	@if($user->id === $trip->user_id)
											{{$user->name}}
										@endif
									@endforeach
								</a>
								@endif
							</td>
							<td>{{ $trip->distance }} </td>
							<td>{{ $trip->duration }} </td>
							
							<td>{{ $trip->total_cost }}</td>
							<td>
								<div class="{{$trip->status}}">
									{{$trip->status}}
								</div>
							</td>
						
							
						
						</tr>
					@endforeach --}}

				</tbody>
			</table>
			

		</div>

	</div>
@endsection
@push('script')
	<script></script>
@endpush
