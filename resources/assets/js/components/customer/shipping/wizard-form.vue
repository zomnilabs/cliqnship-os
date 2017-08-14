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

                            <li role="presentation" class="disabled">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Service Add-on">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-tag"></i>
                            </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Shipping Preview">
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
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h3>Step 1</h3>

                                <p>From: </p>

                                <div class="form-group">
                                    <v-select :on-change="bookingSelected" :options="fromOptions"></v-select>
                                </div>

                                <p>To: </p>

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
                                <p>Give us more information for this shipment</p>

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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4>Services</h4>
                                            <label><input type="radio" name="services" id="metro_manila" v-model="service_type" value="metro_manila"> Metro Manila</label>&nbsp;&nbsp;
                                            <label><input type="radio" name="services" id="provincial" v-model="service_type" value="provincial"> Provincial</label>&nbsp;&nbsp;
                                            <label><input type="radio" name="services" id="international" v-model="service_type" value="international"> International</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4>Package Type</h4>
                                            <label><input type="radio" name="package_type" id="own-packaging" v-model="package_type" value="small"> Own Packaging</label>&nbsp;&nbsp;
                                            <label><input type="radio" name="package_type" id="medium" v-model="package_type" value="medium"> Medium</label>&nbsp;&nbsp;
                                            <label><input type="radio" name="package_type" id="large" v-model="package_type" value="large"> Large</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h4>Paid by</h4>
                                            <label><input type="radio" name="charge_to" id="sender" v-model="charge_to" value="sender"> Sender / Shipper</label> &nbsp;&nbsp;
                                            <label><input type="radio" name="charge_to" id="consignee" v-model="charge_to" value="consignee"> Consignee / Receiver</label>
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

                            <div class="tab-pane" role="tabpanel" id="step4">
                                <h3>Step 4</h3>
                                <p>Select extra shipment service</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><input type="checkbox" name="add_ons" id="collect_and_deposit"
                                                      v-model="collect_and_deposit" value="1" @click="cod">
                                            Collect & Deposit (COD) Metro Manila Only</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label><input type="checkbox" name="add_ons" id="insurance_declared_value"
                                                      v-model="insurance_declared_value" value="1" @click="insurance">
                                            Insurance Declared Value</label>
                                    </div>

                                    <div class="cod hide">
                                        <div class="col-md-12">
                                            <hr>
                                            <h4>Collect & Deposit (COD) Metro Manila Only</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="account_name">Account Name</label>
                                                <input type="text" name="account_name"
                                                       @input="inputChange" v-bind:value="account_name"
                                                       id="account_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="account_number">Account Number</label>
                                                <input type="text" name="account_number"
                                                       @input="inputChange" v-bind:value="account_number"
                                                       id="account_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bank">Bank</label>
                                                <input type="text" name="bank"
                                                       @input="inputChange" v-bind:value="bank"
                                                       id="bank" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="collect_and_deposit_amount">Amount to be collected</label>
                                                <input type="text" name="collect_and_deposit_amount"
                                                       @input="inputChange" v-bind:value="collect_and_deposit_amount"
                                                       id="collect_and_deposit_amount" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="insurance hide">
                                        <div class="col-md-12">
                                            <hr>
                                            <h4>Insurance Declared Value</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="insurance_amount">Amount to be collected</label>
                                                <input type="text" name="insurance_amount"
                                                       @input="inputChange" v-bind:value="insurance_amount"
                                                       id="insurance_amount" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-default prev-step" @click="prevTab">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step" @click="nextTab">Next</button></li>
                                </ul>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step5">
                                <h3>Step 5</h3>

                                <div class="preview">
                                    <img src="http://placehold.it/550x150?text=Image+Preview" alt="">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="pickup_address">FROM</label>
                                        <p>{{ addressFromPreview }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pickup_address">TO</label>
                                        <p>{{ addressToPreview }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Package Details</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="quantity">Service:</label>
                                        <p>{{ service_type }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="quantity">Number of Items:</label>
                                        <p>{{ number_of_items }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="item_type">Type of Items:</label>
                                        <p>{{ type_of_items }}</p>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="pickup_date">Length:</label>
                                        <p>{{ length }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="quantity">Width:</label>
                                        <p>{{ width }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="item_type">Height:</label>
                                        <p>{{ height }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="item_type">Weight:</label>
                                        <p>{{ weight }} Kg</p>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="remarks">Remarks:</label>
                                        <p>{{ remarks }}</p>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="remarks">Service Add-on:</label>
                                        <ul>
                                            <li v-if="collect_and_deposit == 'true'">Collect & Deposit (COD)</li>
                                        </ul>
                                    </div>
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
                                    <h4>Here is the tracking number for this shipment: <strong><i>{{ shipment_tracking_no }}</i></strong></h4>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary btn-info-full" @click="refreshPage">Done</button></li>
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
                to: '',
                addressbooks: [],
                from: [],
                fromOptions: [],
                addressbookOptions: [],
                addressFromPreview: '',
                addressToPreview: '',
                shippingImage: '',
                number_of_items: '',
                type_of_items: '',
                length: '',
                width: '',
                height: '',
                weight: '',
                remarks: '',
                quantity: '',
                service_type: 'metro_manila',
                package_type: 'small',
                charge_to: 'sender',
                collect_and_deposit: '',
                insurance_declared_value: '',
                account_name: '',
                account_number: '',
                bank: '',
                collect_and_deposit_amount: '',
                insurance_amount: '',
                user_id: $('#user_id').val(),
                shipment_tracking_no: ''
            }
        },
        mounted() {
            this.user_id = $('#user_id').val();

            this.getAddress()
            this.getBookingAddress()
        },
        methods: {
            refreshPage() {
                location.reload();
            },
            resetForm() {
                this.shippingImage = ''
                this.number_of_items = ''
                this.type_of_items = ''
                this.length = ''
                this.width = ''
                this.height = ''
                this.weight = ''
                this.remarks = ''
                this.quantity = ''
                this.service_type = ''
                this.package_type = ''
                this.charge_to = ''
                this.collect_and_deposit = ''
                this.insurance_declared_value = ''
                this.account_name = ''
                this.account_number = ''
                this.bank = ''
                this.collect_and_deposit_amount = ''
                this.insurance_amount = ''
                this.tabPage = 1
//                this.shipment_tracking_no = ''
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
                this.shippingImage = e.target;
                this.readURL(e.target);
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            addressSelected(val) {
                if (! val) {
                    this.to = 0
                    this.addressToPreview = ''

                    return false
                };

                this.to = val.value
                this.addressToPreview = val.label
            },
            bookingSelected(val) {
                if (! val) {
                    this.from = 0
                    this.addressFromPreview = ''

                    return false
                };

                this.from = val.value
                this.addressFromPreview = val.label
            },
            nextTab() {
                if (! this.to && ! this.from) {
                    this.showError = true;
                    this.errorMessage = 'Please select a pickup address';

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
            getBookingAddress() {
                axios.get(`/api/web/address-books/${this.user_id}?type=booking`).then(response => {
                    let from = response.data;

                    for (let address of from) {
                        this.fromOptions.push({label: `${address.identifier} : ${address.address_line_1}, ${address.barangay}, ${address.city}`, value: address.id});
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            getAddress() {
                axios.get(`/api/web/address-books/${this.user_id}?type=shipment`).then(response => {
                    let addressbooks = response.data;

                    for (let address of addressbooks) {
                        this.addressbookOptions.push({label: `${address.identifier} : ${address.address_line_1}, ${address.barangay}, ${address.city}`, value: address.id});
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            cod() {
                if($('.cod').hasClass('hide')) {
                    $('.cod').removeClass('hide');
                } else {
                    $('.cod').addClass('hide');
                }
            },
            insurance() {
                if($('.insurance').hasClass('hide')) {
                    $('.insurance').removeClass('hide');
                } else {
                    $('.insurance').addClass('hide');
                }
            },
            saveProject(e) {

                let data = {
                    // user_addressbook: {
                        // id: this.user_addressbook_id
                    // },
                    to: this.to,
                    from: this.from,
//                    shippingImage: this.shippingImage,
                    number_of_items: this.number_of_items,
                    item_description: this.type_of_items,
                    length: this.length,
                    width: this.width,
                    height: this.height,
                    weight: this.weight,
                    remarks: this.remarks,
                    user_id: this.user_id,
                    service_type: this.service_type,
                    package_type: this.package_type,
                    charge_to: this.charge_to,
                    collect_and_deposit: this.collect_and_deposit,
                    insurance_declared_value: this.insurance_declared_value,
                    account_name: this.account_name,
                    account_number: this.account_number,
                    bank: this.bank,
                    collect_and_deposit_amount: this.collect_and_deposit_amount,
                    insurance_amount: this.insurance_amount,
                }

                let url = `/api/web/customers/shipments`;
                console.log(data);
                axios.post(url, data).then(response => {
                    console.log(response)
                    this.shipment_tracking_no = response.data.shipment_tracking_no;

//                  this.$events.fire('reload-table')
                    this.resetForm()
                    this.nextTab()

                }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>