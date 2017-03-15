@extends('layouts.app')

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
        $('.delAddressbook').click(function () {
            var id = $(this).val();
            var parent = $('#addressbook-'+id);
            $.ajax({
                type: "delete",
                url: '/customers/addressbooks/'+ $(this).val(),
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
        }
        //form for save
        function viewNewForm(){
            //change HTML display for Save
            var formButton = document.getElementById("formSubmit");
            formButton.removeAttribute('name');
            formButton.removeAttribute('value');
            document.getElementById('modalTitle').innerHTML = 'Create Addressbook';
            document.getElementById('formSubmit').innerHTML = '<i class="fa fa-floppy-o"></i> '+'Save Addressbook';
        }

        //Transfer all data to modal or edit
        function viewData(data) {
            var dataArray = Object.getOwnPropertyNames(data);
            var formData = document.getElementsByClassName('dataField');

            for (var i = 0; i < formData.length; i++) {
                for(var k = 0; k < dataArray.length;k++) {
                    if (dataArray[k] === formData[i].name) {
                        formData[i].value = data[dataArray[k]];
                    }
                }
            }
            var formButton = document.getElementById('formSubmit');
            var checkbox = document.getElementById('primary');
            //checking for checkbox
            (data.primary == 1) ? checkbox.setAttribute('checked', true) : checkbox.removeAttribute('checked', false);
            //Change HTML display for Update
            formButton.value = data.id;
            formButton.setAttribute('name','edit');
            document.getElementById('modalTitle').innerHTML = 'Update Addressbook';
            document.getElementById('formSubmit').innerHTML = '<i class="fa fa-floppy-o"></i> '+ 'Update Addressbook';

        }
        //Save or update data
        function storeData() {
            var list = {};
            var formData = document.getElementsByClassName('dataField');
            for(var i = 0; i< formData.length;i++){
                list[formData[i].name]= formData[i].value;
            }
            // if checkbox is check
            var checkbox = document.getElementById('primary');
            (checkbox.checked) ? list.primary = 1 : list.primary = 0;

            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = this.name;
            var type = 'POST'; //for creating new resource
            var url = '/customers/addressbooks/';

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
                        <li><a href="/customers">Dashboard</a></li>
                        <li class="active">Addressbooks</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Addressbooks</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target="#viewAddressbookModal" class="btn btn-primary" onclick="viewModalForm()">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Addressbooks</button>
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
                                    <td>Name</td>
                                    <td>Type</td>
                                    <td>Address Type</td>
                                    <td>Address</td>
                                    <td>Contact #</td>
                                    <td>Email Address</td>
                                    <td></td>
                                </tr>
                            </tfoot>

                            <thead>
                                <tr>
                                    <th>Id #</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Address Type</th>
                                    <th>Address</th>
                                    <th>Contact #</th>
                                    <th>Email Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($addressbooks as $addressbook)
                                    <tr id="addressbook-{{$addressbook->id}}">
                                        <td>{{$addressbook->id}}</td>
                                        <td>{{$addressbook->first_name}} {{$addressbook->middle_name}} {{$addressbook->last_name}}</td>
                                        <td>{{ ucwords($addressbook->type) }}</td>
                                        <td>{{ ucwords($addressbook->address_type) }}</td>
                                        <td>{{$addressbook->address_line_1}}</td>
                                        <td>{{$addressbook->contact_number}}</td>
                                        <td>{{$addressbook->email}}</td>
                                        <td>
                                            <button class="btn btn-danger delAddressbook" value="{{$addressbook->id}}"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-default"
                                                    data-toggle="modal"
                                                    data-target="#viewAddressbookModal"
                                                    onClick="viewModalForm({{$addressbook}})"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customers.addressbooks.modals.view')
@endsection
