<template>
    <div class="container-fluid">
        <div class="row">
            <section>
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Select address">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Add Image">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Add more details">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                </a>
                            </li>

                            <!--<li role="presentation" class="disabled">-->
                                <!--<a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Pouch Request">-->
                            <!--<span class="round-tab">-->
                                <!--<i class="glyphicon glyphicon-tag"></i>-->
                            <!--</span>-->
                                <!--</a>-->
                            <!--</li>-->

                            <li role="presentation" class="disabled">
                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Booking Preview">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <form role="form">
                        <div class="alert alert-danger" v-show="showError">{{ errorMessage }}</div>

                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h3>Step 1</h3>
                                <p>Which address would you like to set for this booking / pickup? (<span class="text-danger text-capitalize">required</span>)</p>

                                <div class="form-group">
                                    <v-select :on-change="addressSelected" :options="addressbookOptions"></v-select>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary next-step" @click="nextTab">Next</button></li>
                                </ul>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step2">
                                <h3>Step 2</h3>
                                <p>Select an image for this booking / pickup (<span class="text-primary text-capitalize">not required</span>)</p>

                                <div class="form-group">
                                    <input type="file" id="bookingImage" class="form-control"
                                           @change="fileSelected">
                                </div>

                                <div class="preview">
                                    <img ref="imagePreview" src="http://placehold.it/550x150?text=Image+Preview" alt="">
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step" @click="prevTab">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary next-step" @click="nextTab">Next</button></li>
                                </ul>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step3">
                                <h3>Step 3</h3>
                                <p>Give us more information for this booking</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_of_items">Number of Items</label>
                                            <input type="text" name="number_of_items"
                                                   @input="inputChange" v-bind:value="number_of_items"
                                                   id="number_of_items" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type_of_items">Type of Items</label>
                                            <input type="text" name="type_of_items"
                                                   @input="inputChange" v-bind:value="type_of_items"
                                                   id="type_of_items" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="length">Length</label>
                                            <input type="text" name="length"
                                                   @input="inputChange" v-bind:value="length"
                                                   id="length" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="width">Width</label>
                                            <input type="text" name="width"
                                                   @input="inputChange" v-bind:value="width"
                                                   id="width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="height">Height</label>
                                            <input type="text" name="height"
                                                   @input="inputChange" v-bind:value="height"
                                                   id="height" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="weight">Weight</label>
                                            <input type="text" name="weight"
                                                   @input="inputChange" v-bind:value="weight"
                                                   id="weight" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pickup_date">Pickup Date <span class="text-danger">*</span></label>
                                            <input type="date" name="pickup_date"
                                                   @input="inputChange" v-bind:value="pickup_date"
                                                   id="pickup_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" id="remarks"
                                                      @input="inputChange" v-bind:value="remarks"
                                                      class="form-control" rows="5"
                                                      style="resize: none"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step" @click="prevTab">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary next-step" @click="nextTab">Next</button></li>
                                </ul>
                            </div>

                            <!--<div class="tab-pane" role="tabpanel" id="step4">-->
                                <!--<h3>Step 4</h3>-->
                                <!--<p>Would you like to request a pouch?</p>-->

                                <!--<div class="row">-->
                                    <!--<div class="col-md-5">-->
                                        <!--<div class="form-group">-->
                                            <!--<label for="pouch_size">Pouch Size</label>-->
                                            <!--<select name="pouch_size" id="pouch_size" class="form-control">-->
                                                <!--<option value="1">Small</option>-->
                                                <!--<option value="2">Medium</option>-->
                                                <!--<option value="3">Large</option>-->
                                                <!--<option value="4">Extra Large</option>-->
                                            <!--</select>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-5">-->
                                        <!--<div class="form-group">-->
                                            <!--<label for="quantity">Quantity</label>-->
                                            <!--<input type="number" name="quantity"-->
                                                   <!--@input="inputChange" v-bind:value="quantity"-->
                                                   <!--id="quantity" class="form-control">-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-2">-->
                                        <!--<button class="btn btn-success" type="button" style="margin-top: 26px;"><i class="fa fa-plus"></i> Add</button>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-12">-->
                                        <!--<div class="form-group">-->
                                            <!--<label for="remarks">Pouch Requested</label>-->
                                            <!--<table class="table table-hover">-->
                                                <!--<thead>-->
                                                <!--<tr>-->
                                                    <!--<th>Pouch Size</th>-->
                                                    <!--<th>Quantity</th>-->
                                                <!--</tr>-->
                                                <!--</thead>-->
                                                <!--<tbody>-->
                                                <!--<tr>-->
                                                    <!--<td>Medium</td>-->
                                                    <!--<td>2</td>-->
                                                <!--</tr>-->
                                                <!--<tr>-->
                                                    <!--<td>Large</td>-->
                                                    <!--<td>10</td>-->
                                                <!--</tr>-->
                                                <!--</tbody>-->
                                            <!--</table>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<ul class="list-inline pull-right">-->
                                    <!--<li><button type="button" class="btn btn-default prev-step" @click="prevTab">Previous</button></li>-->
                                    <!--<li><button type="button" class="btn btn-primary btn-info-full next-step" @click="nextTab">Next</button></li>-->
                                <!--</ul>-->
                            <!--</div>-->

                            <div class="tab-pane" role="tabpanel" id="step5">
                                <h3>Step 5</h3>

                                <div class="preview">
                                    <img src="http://placehold.it/550x150?text=Image+Preview" alt="">
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Pickup Address</label>
                                        <p>{{ addressPreview }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Pickup Date:</label>
                                        <p>{{ pickup_date }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Number of Items:</label>
                                        <p>{{ number_of_items }} Items</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Type of Items:</label>
                                        <p>{{ type_of_items }}</p>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Length:</label>
                                        <p>{{ length }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Width:</label>
                                        <p>{{ width }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Height:</label>
                                        <p>{{ height }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Weight:</label>
                                        <p>{{ weight }} Kg</p>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Remarks:</label>
                                        <p>{{ remarks }}</p>
                                    </div>

                                    <!--<div class="col-md-12">-->
                                        <!--<label>Pouch Request:</label>-->
                                        <!--<ul>-->
                                            <!--<li>2x Medium</li>-->
                                            <!--<li>10x Large</li>-->
                                        <!--</ul>-->
                                    <!--</div>-->
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step" @click="prevTab">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step" @click="saveProject">Save and Continue</button></li>
                                </ul>
                            </div>


                            <div class="tab-pane" role="tabpanel" id="complete">
                                <div class="text-center">
                                    <i class="fa fa-check-circle text-success" style="font-size: 10em; padding: 15px"></i>
                                    <h2>You have successfully completed all steps.</h2>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary btn-info-full" data-dismiss="modal">Done</button></li>
                                </ul>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect);

    export default {
        data() {
            return {
                showError: false,
                errorMessage: '',
                tabPage: 1,
                user_addressbook_id: '',
                addressbooks: [],
                addressbookOptions: [],
                addressPreview: '',
                bookingImage: '',
                number_of_items: '',
                type_of_items: '',
                length: '',
                width: '',
                height: '',
                weight: '',
                pickup_date: '',
                remarks: '',
                quantity: '',
                user_id: $('#user_id').val()
            }
        },
        mounted() {
            this.user_id = $('#user_id').val();

            this.getAddress()
        },
        methods: {
            resetForm() {
                this.bookingImage = ''
                this.number_of_items = ''
                this.type_of_items = ''
                this.length = ''
                this.width = ''
                this.height = ''
                this.weight = ''
                this.pickup_date = ''
                this.remarks = ''
                this.quantity = ''
                this.tabPage = 1
            },
            readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.preview img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            },
            fileSelected(e) {
                this.bookingImage = e.target;
                this.readURL(e.target);
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            addressSelected(val) {
                if (! val) {
                    this.user_addressbook_id = 0
                    this.addressPreview = ''

                    return false
                };

                this.user_addressbook_id = val.value
                this.addressPreview = val.label
            },
            nextTab() {
                if (! this.user_addressbook_id) {
                    this.showError = true;
                    this.errorMessage = 'Please select a pickup address';

                    return false
                }

                if (! this.pickup_date && this.tabPage >= 3) {
                    this.showError = true;
                    this.errorMessage = 'Please select a pickup date';

                    return false
                }

                let $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                $($active).next().find('a[data-toggle="tab"]').click();

                this.showError = false;
                this.errorMessage = '';
                this.tabPage++;
            },
            prevTab() {
                let $active = $('.wizard .nav-tabs li.active');
                $($active).prev().find('a[data-toggle="tab"]').click();

                this.tabPage--;
            },
            getAddress() {
                axios.get(`/api/v1/address-books/${this.user_id}`).then(response => {
                    let addressbooks = response.data;

                    for (let address of addressbooks) {
                        this.addressbookOptions.push({label: `${address.address_line_1}, ${address.barangay}, ${address.city}`, value: address.id});
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            saveProject(e) {

                let data = {
                    user_addressbook_id: this.user_addressbook_id,
//                    bookingImage: this.bookingImage,
                    number_of_items: this.number_of_items,
                    type_of_items: this.type_of_items,
                    length: this.length,
                    width: this.width,
                    height: this.height,
                    weight: this.weight,
                    pickup_date: this.pickup_date,
                    remarks: this.remarks,
                    user_id: this.user_id,
                }

                let url = `/api/v1/customers/bookings`;
                axios.post(url, data).then(response => {
                    console.log(response)

//                this.$events.fire('reload-table')
                this.resetForm()
                this.nextTab()
            }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>