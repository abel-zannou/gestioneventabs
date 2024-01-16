@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Toutes Category</h5>
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
                                <th>Image Categorie</th>
                                <th>Nom Evènement</th>
                                <th>Nom Categorie</th>
                                <th>Description Categorie</th>
                                <th>Organisateur Categorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php($i = 1)
                            @foreach($category as $item)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{ $item->eventcategory_image }}" alt="">
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    {{ $item->evenement->event_name }}
                                </td>

                                <td>
                                    {{ $item->eventcategory_name }}
                                </td>

                                <td>
                                    {{ strip_tags($item->eventcategory_description) }}
                                </td>

                                <td>
                                    {{ $item->email_organisateur }}
                                </td>

                                <td>
                                    <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                    <a id="delete" href="{{ route('category.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $category->links('vendor.pagination.custom') }}

    </div>
</div>

@endsection