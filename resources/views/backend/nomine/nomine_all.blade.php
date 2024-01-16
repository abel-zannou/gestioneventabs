@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Tous les Nominés</h5>
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
                                <th>Nom Evènement</th>
                                <th>Nom Categorie</th>
                                <th>Nomine</th>
                                <th>Age</th>
                                <th>telephone</th>
                                <th>Pays</th>
                                <th>Email</th>
                                <th>Attribue</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php($i = 1)
                            @foreach($nomines as $item)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{ $item->photo }}" alt="">
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    {{ $item->evenements->event_name }}
                                </td>

                                <td>
                                    {{ $item->categories->eventcategory_name }}
                                </td>

                                <td>
                                    {{ $item->nom }} {{ $item->prenom }}
                                </td>

                                <td>
                                    {{ $item->age }}
                                </td>

                                <td>
                                    {{ $item->phone }}
                                </td>

                                <td>
                                    {{ $item->pays }}
                                </td>

                                <td>
                                    {{ $item->email_nomine }}
                                </td>

                                <td>
                                    {{ $item->attrib_nomine }}
                                </td>

                                <td>
                                    <a href="{{ route('nomine.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                    <a id="delete" href="{{ route('nomine.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $nomines->links('vendor.pagination.custom') }}

    </div>
</div>

@endsection