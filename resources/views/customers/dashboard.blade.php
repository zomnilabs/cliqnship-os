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

        .navbar-default {
            border-color: #434343;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
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
