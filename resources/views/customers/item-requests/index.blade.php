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

        $(function() {
            
            var deleteId;

            var table = $('#requestsTable').DataTable();

            var $that;

            $(document).on('click', '.delRequest', function(e){
                deleteId = $(this).attr('data-item');
                $that = $(this);
            });

            $('.deleteBtn').click(function () {
                var rowSelected = $that.parent().parent();
                
                $.ajax({
                    type: "delete",
                    url: '/customers/item-requests/'+ deleteId,
                    beforeSend: function() {
                        rowSelected.css('backgroundColor','#fb6c6c');
                    },
                    success: function(){
                        rowSelected.fadeOut(400,function() {
                            that.remove();
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
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
            document.getElementById('modalTitle').innerHTML = 'Create Item Request';
            document.getElementById('formSubmit').innerHTML = '<i class="fa fa-floppy-o"></i> '+'Save Item Request';
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
            //Change HTML display for Update
            formButton.value = data.id;
            formButton.setAttribute('name','edit');
            document.getElementById('modalTitle').innerHTML = 'Update Item Request';
            document.getElementById('formSubmit').innerHTML = '<i class="fa fa-floppy-o"></i> '+ 'Update Item Request';

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
            var url = '/customers/item-requests/';

            if (state == "edit"){
                type = 'PUT';
                url += this.value;
            }

            console.log(list)
            $.ajax({
                type: type,
                url: url,
                data: list,
                success: function (data) {
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
                        case 'Status':
                            let selectHTML = '<select class="form-control filter" style="width: 100%">';
                            selectHTML += '<option value="">Filter Status</option>';
                            selectHTML += '<option value="pending">Pending</option>';
                            selectHTML += '<option value="approved">Approved</option>';
                            selectHTML += '<option value="completed">Completed</option>';
                            selectHTML += '</select>';

                            $(this).html(selectHTML);
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
                        <li class="active">Item Requests</li>
                    </ol>
                </div>
                <div class="header-title pull-left">
                    <h1>Item Requests</h1>
                </div>

                <div class="page-actions pull-right">
                    <button data-toggle="modal" data-target="#viewItemRequest" class="btn btn-primary" onclick="viewModalForm()">
                        <i class="glyphicon glyphicon-plus"></i>
                        New Item Requests</button>
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

                        <table class="table table-bordered" style="width: 100%" id="requestsTable">
                            <tfoot class="filter-footer">
                                <tr class="searchable">
                                    <td>Id #</td>
                                    <td>Address</td>
                                    <td>Item</td>
                                    <td>Quantity</td>
                                    <td>Status</td>
                                    <td></td>
                                </tr>
                            </tfoot>

                            <thead>
                                <tr>
                                    <th>Id #</th>
                                    <th>Address</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($itemRequests as $itemRequest)
                                    <tr id="itemRequests-{{$itemRequest->id}}">
                                        <td>{{$itemRequest->id}}</td>
                                        <td>{{ $itemRequest->address->getFullAddress() }}</td>
                                        <td>{{ ucwords($itemRequest->item->name) }}</td>
                                        <td>{{$itemRequest->quantity}}</td>
                                        <td>{{$itemRequest->status}}</td>
                                        <td>
                                            <button class="btn btn-danger delRequest" data-item="{{$itemRequest->id}}"
                                                data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-default"
                                                    data-toggle="modal"
                                                    data-target="#viewItemRequest"
                                                    onClick="viewModalForm({{$itemRequest}})"><i class="fa fa-edit"></i></button>
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

    @include('customers.item-requests.modals.view')
    @include('customers.item-requests.modals.delete')
@endsection
