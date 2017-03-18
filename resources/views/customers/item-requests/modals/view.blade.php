<div class="modal fade" id="viewItemRequest" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content mcontent">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modalTitle">Item Request</h4>
            </div>
            <form id="viewForm">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('user_addressbook_id') ? ' has-error' : '' }}">
                                <label for="type">Address <span class="text-danger">*</span></label>
                                <select name="user_addressbook_id" class="form-control dataField" id="user_addressbook_id">
                                    @foreach($address as $a)
                                        <option value="{{ $a->id }}">{{ $a->getFullAddress() }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('user_addressbook_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_addressbook_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                                <label for="size">Size <span class="text-danger">*</span></label>
                                <select name="size" class="form-control dataField" id="size">
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                </select>
                                @if ($errors->has('size'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control dataField" name="quantity" id="quantity"/>
                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-success" id="formSubmit" onclick="storeData.call(this)"><i class="fa fa-floppy-o"></i> Update Item Request</button>
                </div>
            </form>
        </div>
    </div>
</div>