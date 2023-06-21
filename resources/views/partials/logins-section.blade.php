<section class="all-logins-section" id="logins">
    <div class="container">
        <h1 class="fw-bold text-secondary text-center">Logins</h1>
        <div class="row">
            <div class="col-sm-4 mt-3">
                <div class="card border-2 border-success">
                    <img class="card-img-top" src="assets/images/banner/1.jpg" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title text-secondary fw-bold">Patient Login</h5>
                        <a href="{{ route('patientLoginForm') }}" class="btn btn-success my-3">Click Here</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-3">
                <div class="card border-2 border-success">
                    <img class="card-img-top" src="assets/images/banner/2.jpg" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title text-secondary fw-bold">Doctors Login</h5>
                        <a href="{{ route('doctorLoginForm') }}" class="btn btn-success my-3">Click Here</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-3">
                <div class="card border-2 border-success">
                    <img class="card-img-top" src="assets/images/banner/3.jpg" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title text-secondary fw-bold">Admin Login</h5>
                        <a href="{{ route('adminLoginForm') }}" class="btn btn-success my-3">Click Here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
