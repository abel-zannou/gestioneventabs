@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Tout Les Evènements</h5>
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
                                <th>Image de l'Evènement</th>
                                <th>Nom Evenement</th>
                                <th>Lieu Evènement</th>
                                <th>Prix de vote</th>
                                <th>Date Debut Evènement</th>
                                <th>Date Fin Evènement</th>
                                <th>Description Evenement</th>
                                <th>Organisateur Evenement</th>
                                <th>Status Evenement</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php($i = 1)
                            @foreach($events as $item)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{ $item->event_image }}" alt="">
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    {{ $item->event_name }}
                                </td>
                                <td>
                                    {{ $item->event_lieu }}
                                </td>
                                <td>
                                    {{ $item->event_prixvote }}
                                </td>
                                <td>
                                    {{ $item->event_datedebut }}
                                </td>
                                <td>
                                    {{ $item->event_datefin }}
                                </td>

                                <td>
                                    {{ strip_tags($item->event_description) }}
                                </td>

                                <td>
                                    {{ $item->email_organisateur }}
                                </td>

                                <td>
                                    {{ $item->event_status }}
                                </td>

                                <td>
                                <a href="{{ route('event.edit', $item->id) }}" class="btn btn-info">Edit</a>
									<a id="delete" href="{{ route('event.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

        {{ $events->links('vendor.pagination.custom') }}

    </div>
</div>

@endsection