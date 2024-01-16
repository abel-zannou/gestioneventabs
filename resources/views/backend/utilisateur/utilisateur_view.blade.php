@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
	<div class="page-content">

		<div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-0">Les Utilisateurs</h5>
					</div>
					<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>
				<hr>
				<div class="table-responsive">
					<table class="table align-middle mb-0">
						<thead class="table-light">
							<tr>
								<th>SL</th>
								<th>Photo</th>
								<th>Nom et Prénom</th>
								<th>email</th>
								<th>Téléphone</th>

								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@php($i = 1)
							@foreach($user as $item)

							<tr>
								<td>{{ $i++ }}</td>
								<td>
									<div class="d-flex align-items-center">
										<div class="recent-product-img">
											<img src="{{ $item->profile_photo_path }}" alt="">
										</div>

									</div>
								</td>

								<td>
									{{ $item->name }}
								</td>

								<td>
									{{ $item->email }}
								</td>

								<td>
									{{ $item->telephone }}
								</td>



								<td>
									<a href="{{ route('user.edit', $item->id) }}" class="btn btn-info">Edit</a>
									<a id="delete" href="{{ route('user.profile.delete', $item->id) }}" class="btn btn-danger">Delete</a>
								</td>

							</tr>

							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>

{{ $user->links('vendor.pagination.custom') }}

	</div>
</div>

@endsection