<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/Signup.css">
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Form Registrasi</h3>
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="firstName">Nama Depan</label>
                                            <input type="text" id="firstName" class="form-control form-control-lg" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="lastName">Nama Belakang</label>
                                            <input type="text" id="lastName" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="mb-2 pb-1">Gender: </h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="femaleGender" value="option1" checked />
                                            <label class="form-check-label" for="femaleGender">Cewek</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="maleGender" value="option2" />
                                            <label class="form-check-label" for="maleGender">Lanang</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="emailAddress">Email</label>
                                            <input type="email" id="emailAddress"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="phoneNumber">Nomor Handphone</label>
                                            <input type="tel" id="phoneNumber" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 d-flex justify-content-start mt-4 pt-2 back">
                                        <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="button" value="Back" />
                                    </div>
                                    <div class="col-md-6 d-flex mt-4 pt-2 submit">
                                        <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="button" value="Registrasi" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>