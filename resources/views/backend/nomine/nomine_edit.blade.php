@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Editer Un Nominé</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Nomine</li>
                    </ol>
                </nav>
            </div>

        </div>

        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">




                    <div class="col-lg-8">

                        <form method="post" action="{{ route('nomine.update') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $nomine->id }}">

                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Evènement</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            <select name="evenement_id" class="form-select mb-3" aria-label="Default select example" disabled>
                                                
                                                <option selected="" value="{{ $nomine->evenements->id }}">{{ $nomine->evenements->event_name }}</option>
                                                

                                            </select>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">

                                            <select name="categoryevent_id" class="form-select mb-3" aria-label="Default select example" disabled>
                                             
                                                <option selected="" value="{{ $nomine->categories->id }}">{{ $nomine->categories->eventcategory_name }}</option>
                                                

                                            </select>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nom Nomine</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="nom" type="text" class="form-control" value="{{ $nomine->nom }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Prenom Nomine</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="prenom" type="text" class="form-control" value="{{ $nomine->prenom }}">

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Age Nomine</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="age" type="text" class="form-control" value="{{ $nomine->age }}">

                                            
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Pays Nomine</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="pays" type="text" class="form-control" value="{{ $nomine->pays }}">

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email Nomine</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="email_nomine" type="email" class="form-control" value="{{ $nomine->email_nomine }}">

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone Nomine</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="phone" type="text" class="form-control" value="{{ $nomine->phone }}">

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Image Categorie</label>
                                        <input name="photo" class="form-control" type="file" id="image">
                                        
                                    </div>

                                    <div class="mb-3">
                                        <img id="showImage" src="{{ asset( $nomine->photo ) }}" style="width: 150px; height: 100px;" alt="">


                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="MAJ Nominé">
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


@endsection