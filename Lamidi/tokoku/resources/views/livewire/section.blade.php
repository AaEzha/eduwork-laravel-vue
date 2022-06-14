<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#addsection" class="btn btn-primary" data-bs-toggle="modal">
                                <i class="fa fa-plus-circle fa-lg"></i> Add Section
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('sections.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sections.create')
</div>