@extends('layouts.auth')

@section('content')
    <section id="auth" style="min-height: 100vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Bulk Import</h2>
                </div>
            </div>
            <div class="row">

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <p>Import your shipments and generate waybill</p>
                                <h4>Instructions</h4>
                                <ol>
                                    <li>Download this excel template and fill it up <a href="/templates/customers/shipments-bulk.xlsx">Click Here</a></li>
                                    <li>Upload it here</li>
                                    <li>Then click `import`</li>
                                    <li>Wait for the document to be uploaded and the waybills to be shown on the screen</li>
                                    <li>Click Print Waybill/s`</li>
                                </ol>

                                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <input type="file" name="file" class="form-control"> <br>
                                    <button class="btn btn-primary btn-block" id="import"><i class="fa fa-upload"></i> Import</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    </section>
@endsection