@extends('layouts.admin')

@section('stylesheets')
    <style>
        .mcontent{
            padding:15px;
        }
        .pull-right button{
            margin-right:20px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Prepare reset.
        function resetModalFormErrors() {
            $('.form-group').removeClass('has-error');
            $('.form-group').find('.help-block').remove();
        }
        //Prepare clearing fields
        function clearformData(classNameFields) {
            var len = document.getElementsByClassName(classNameFields);
            for(i = 0; i <len.length; i++){
                len[i].value = '';
            }
        }
        //Reset and clear textfields everytime modal closed
        $('.modal').on('hidden.bs.modal', function(){
            resetModalFormErrors();
            clearformData('dataField');
        });
        //deleting data
        $('.delRider').click(function () {
            var id = $(this).val();
            var parent = $('#rider-'+id);
            $.ajax({
                type: "delete",
                url: '/admin/riders/'+ $(this).val(),
                beforeSend: function() {
                    parent.css('backgroundColor','#fb6c6c');
                },
                success: function(){
                    parent.fadeOut(400,function() {
                        parent.remove();
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        //checking if what modal will use
        function viewModalForm(data = false){
            (data) ? viewData(data) : viewNewForm();
            console.log(data);
        }
        //form for save
        function viewNewForm(){
            //change HTML display for Save
            var row = document.getElementsByClassName('row');
            row[6].classList.remove("hide");
            var formButton = document.getElementById("formSubmit");
            formButton.removeAttribute('name');
            formButton.removeAttribute('value');
            document.getElementById('modalTitle').innerHTML = 'Create New Rider';
            document.getElementById('formSubmit').innerHTML = '<i class="fa fa-floppy-o"></i> '+'Save New Rider';
        }

        //Transfer all data to modal or edit
        function viewData(data) {
            var dataArray = Object.getOwnPropertyNames(data);
            var formData = document.getElementsByClassName('dataField');
            var arr = Object.getOwnPropertyNames(data['profile']);
            var profile = Object.values(data['profile']);

            for (var i = 0; i < formData.length; i++) {
                for(var k = 0; k < dataArray.length;k++) {
                    if (dataArray[k] === formData[i].name) {
                        formData[i].value = data[dataArray[k]];
                    }
                }
                if(arr){
                    for(var j= 0; j < arr.length;j++){
                        if(arr[j] === formData[i].name){
                            formData[i].value = profile[j];
                        }
                    }
                }
            }
            //Change HTML display for Update
            var formButton = document.getElementById('formSubmit');
            var row = document.getElementsByClassName('row');
            row[6].classList.add("hide");
            formButton.value = data.id;
            formButton.setAttribute('name','edit');
            document.getElementById('modalTitle').innerHTML = 'Update Rider';
            document.getElementById('formSubmit').innerHTML = '<i class="fa fa-floppy-o"></i> '+ 'Update Rider';

        }
        //Save or update data
        function storeData() {
            var list = {};
            var formData = document.getElementsByClassName('dataField');
            for(var i = 0; i< formData.length;i++){
                list[formData[i].name]= formData[i].value;
            }
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = this.name;
            var type = 'POST'; //for creating new resource
            var url = '/admin/riders/';

            if (state == "edit"){
                type = 'PUT';
                url += this.value;
            }
            console.log(list);
            $.ajax({
                type: type,
                url: url,
                data: list,
                success: function () {
                    location.reload();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            }).always(function(err){
                resetModalFormErrors();
                //checking for errors and display it
                if (err.status == 422) {
                    var errors = $.parseJSON(err.responseText);
                    var arr = Object.keys(errors);
                    $.each(errors, function(field, message) {
                        console.error(field + ': ' + message);
                        var formGroup = $('[name='+field+']').closest('.form-group');
                        formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                    });
                    $('[name='+arr[0]+']').focus();
                }
            });
        }

        (function() {
            $('.table tfoot tr.searchable td').each( function () {
                let title = $(this).text();
                if (title) {
                    switch (title) {
                        case 'Type':
                            let selectHTML = '<select class="form-control filter" style="width: 100%">';
                            selectHTML += '<option>Filter Type</option>';
                            selectHTML += '<option value="booking">Booking</option>';
                            selectHTML += '<option value="shipment">Shipment</option>';
                            selectHTML += '</select>';

                            $(this).html(selectHTML);

                            break;
                        case 'Address Type':
                            let selectHTML2 = '<select class="form-control filter" style="width: 100%">';
                            selectHTML2 += '<option>Filter Address Type</option>';
                            selectHTML2 += '<option value="office">Office</option>';
                            selectHTML2 += '<option value="residential">Residential</option>';
                            selectHTML2 += '</select>';

                            $(this).html(selectHTML2);
                            break;
                        default:
                            $(this).html( '<input class="form-control filter" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                    }
                }
            });

            let table = $('.table').DataTable();

            // Apply the search
            table.columns().every( function () {
                let that = this;
                $( '.filter', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        console.log(that.data());
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }())
    </script>
@endsection
@section('content')
    <div class="header-info container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li class="active">Riders</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Riders</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target="#viewRiderModal" class="btn btn-primary" onclick="viewModalForm()">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Riders</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('components.errors')
                        <table class="table table-bordered">
                            <tfoot class="filter-footer">
                                <tr class="searchable">
                                    <td>Id #</td>
                                    <td>Account Id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Actions</td>
                                </tr>
                            </tfoot>

                            <thead>
                                <tr>
                                    <th>Id #</th>
                                    <th>Account Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            @if($riders)
                                @foreach($riders as $rider)
                                    <tr id="rider-{{$rider->id}}">
                                        <td>{{$rider->id}}</td>
                                        <td>{{$rider->account_id or ''}}</td>
                                        <td>{{$rider->profile->full_name}}</td>
                                        <td>{{$rider->email or ''}}</td>
                                        <td>
                                            <button class="btn btn-danger delRider" value="{{$rider->id}}"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-default"
                                                    data-toggle="modal"
                                                    data-target="#viewRiderModal"
                                                    onClick="viewModalForm({{$rider}})"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.riders.modals.view')
@endsection
