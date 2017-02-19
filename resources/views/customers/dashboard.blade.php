@extends('layouts.app')

@section('stylesheets')
    <style>
        .cards .panel .panel-body{
            font-size: 2em;
        }
        .cards .panel .panel-body a{
            color: #636b6f;
            cursor: pointer;
            text-decoration: none;
        }
        .cards .panel .panel-body:hover{
            color: #B1CE52;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="active"> <i class="glyphicon glyphicon-home"></i> Dashboard</li>
                </ol>

                <div class="row text-center cards">
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-tags"></i>
                                <p><a href="#">New Products</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-tags"></i>
                                <p><a href="#">New Products</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-tags"></i>
                                <p><a href="#">New Products</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-tags"></i>
                                <p><a href="#">New Products</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-tags"></i>
                                <p><a href="#">New Products</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-tags"></i>
                                <p><a href="#">New Products</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
