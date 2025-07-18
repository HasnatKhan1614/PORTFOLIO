@extends('layouts.app')

@section('content')
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
                <!-- resources/views/livewire/gateways-create-or-edit.blade.php -->
                <div class="row">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing layout-top-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Create Gateway</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form id="createGatewayForm">
                                    <div class="form-row mb-4">
                                        <label for="name">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="stripe">Stripe</option>
                                            <option value="paypal">Paypal</option>
                                        </select>
                                        <span class="text-danger error-message" id="name_error"></span>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="First Name">
                                            <span class="text-danger error-message" id="name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="key1">KEY 1</label>
                                            <input type="text" class="form-control" id="key1" name="key1"
                                                placeholder="First Name">
                                            <span class="text-danger error-message" id="key1_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="key2">KEY 2</label>
                                            <input type="text" class="form-control" id="key2" name="key2"
                                                placeholder="First Name">
                                            <span class="text-danger error-message" id="key2_error"></span>
                                        </div>
                                    </div>
                                    <button type="button" id="CreateGetwaySubmitBtn" class="btn btn-primary mt-3">Save
                                        Gateway</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ env('ASSET_URL') }}/custom/custom.js"></script>
@endsection
