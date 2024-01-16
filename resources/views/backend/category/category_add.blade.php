@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ajouter Une Categorie</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                    </ol>
                </nav>
            </div>

        </div>

        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">




                    <div class="col-lg-8">

                        <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nom Evènement</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            <select name="event_id" class="form-select mb-3" aria-label="Default select example">
                                                <option selected="">Choisi évènement</option>

                                                @foreach($event as $item)
                                                <option value="{{ $item->id }}">{{ $item->event_name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nom Categorie</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="eventcategory_name" type="text" class="form-control" value="">

                                            @error('eventcategory_name')
                                            <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Description</label>
                                        <textarea id="mytextarea" name="eventcategory_description">Decrire votre categorie</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Image Categorie</label>
                                        <input name="eventcategory_image" class="form-control" type="file" id="image">
                                        @error('eventcategory_image')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" style="width: 150px; height: 100px;" alt="">

                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Ajouter Categorie">
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);

        });
    });
</script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>


@endsection