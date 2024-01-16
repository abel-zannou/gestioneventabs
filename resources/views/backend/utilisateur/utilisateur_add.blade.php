@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">ABS BENIN</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Créer un Utilisateur</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Créer un Utilisateur</h5>
                <hr>
                <div class="form-body mt-4">

                    <form method="post" action="{{ route('user.store') }}" >
                        @csrf

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Nom Organisateur</label>
                                        <input type="text" name="name" class="form-control" id="inputProductTitle" placeholder="Entrer le nom de l'Organisateur">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Telephone Organisateur</label>
                                        <input type="text" name="telephone" class="form-control" id="inputProductTitle" placeholder="Entrer le telephone de l'Organisateur">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Email de l'Organisateur</label>
                                        <input name="email" type="email" class="form-control" id="inputProductTitle" placeholder="Entrer l'email de l'Organisateur">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Mot de passe de l'Organisateur</label>
                                        <input name="password" type="password" class="form-control" id="inputProductTitle" placeholder="Entrer un mot de passe pour l'Organisateur">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Confirmation du mot de l'Organisateur</label>
                                        <input name="password_confirmation" type="password" class="form-control" id="inputProductTitle" placeholder="Confirmer le mot de passe de l'Organisateur">
                                    </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save User</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection