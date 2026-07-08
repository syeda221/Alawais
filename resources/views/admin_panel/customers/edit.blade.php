@extends('admin_panel.layout.app')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="container">
                <h3>Edit Customer</h3>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label><strong>Customer ID:</strong></label>
                            <input type="text" class="form-control" name="customer_id" readonly value="{{ $customer->customer_id }}">
                        </div>
                        <div class="col-md-3">
                            <label><strong>Customer Type :</strong></label>
                            <select class="form-control" name="customer_type">
                                <option value="">Select Customer Type</option>
                                <option value="Main Customer" {{ old('customer_type', $customer->customer_type) == 'Main Customer' ? 'selected' : '' }}>Main Customer</option>
                                <option value="Walking Customer" {{ old('customer_type', $customer->customer_type) == 'Walking Customer' ? 'selected' : '' }}>Walking Customer</option>
                                <option value="Dual Party" {{ old('customer_type', $customer->customer_type) == 'Dual Party' ? 'selected' : '' }}>Dual Party</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label><strong>Customer Name:</strong></label>
                            <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name', $customer->customer_name) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="float-end"><strong>کسٹمر کا نام:</strong></label>
                            <input type="text" class="form-control text-end" dir="rtl" name="customer_name_ur" value="{{ old('customer_name_ur', $customer->customer_name_ur) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>NTN / CNIC no:</label>
                            <input type="text" class="form-control" name="cnic" value="{{ old('cnic', $customer->cnic) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Filer Type:</label>
                            <select class="form-control" name="filer_type">
                                <option value="">Select Filer Type</option>
                                <option value="filer" {{ old('filer_type', $customer->filer_type) == 'filer' ? 'selected' : '' }}>Filer</option>
                                <option value="non filer" {{ old('filer_type', $customer->filer_type) == 'non filer' ? 'selected' : '' }}>Non Filer</option>
                                <option value="exempt" {{ old('filer_type', $customer->filer_type) == 'exempt' ? 'selected' : '' }}>Exempt</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Zone:</label>
                            <select class="form-control" name="zone">
                                <option value="">Select Zone</option>
                                <option value="Hyderabad" {{ old('zone', $customer->zone) == 'Hyderabad' ? 'selected' : '' }}>Hyderabad</option>
                                <option value="Karachi" {{ old('zone', $customer->zone) == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Contact Person:</label>
                            <input type="text" class="form-control" name="contact_person" value="{{ old('contact_person', $customer->contact_person) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Mobile#:</label>
                            <input type="text" class="form-control" name="mobile" value="{{ old('mobile', $customer->mobile) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" name="email_address" value="{{ old('email_address', $customer->email_address) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Contact Person-2:</label>
                            <input type="text" class="form-control" name="contact_person_2" value="{{ old('contact_person_2', $customer->contact_person_2) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Mobile# 2:</label>
                            <input type="text" class="form-control" name="mobile_2" value="{{ old('mobile_2', $customer->mobile_2) }}">
                        </div>
                        <div class="col-md-4">
                            <label>Email Address 2:</label>
                            <input type="email" class="form-control" name="email_address_2" value="{{ old('email_address_2', $customer->email_address_2) }}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label>Opening Balance (Dr):</label>
                            <input type="number" step="any" class="form-control" name="opening_balance" value="{{ old('opening_balance', $customer->opening_balance) }}">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label>Address:</label>
                        <textarea rows="4" class="form-control" name="address">{{ old('address', $customer->address) }}</textarea>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Update Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
