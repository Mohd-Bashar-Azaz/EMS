@extends('layouts.navbar')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('employees.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Fill Employee Personal Details</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('datas.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Phone Number</label>
                                <input value="{{ old('phone') }}" type="text"
                                    class="@error('phone') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Enter your phone number" phone="phone">
                                @error('phone')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Email</label>
                                <input value="{{ old('email') }}" type="text"
                                    class="@error('email') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Enter your Email id" name="email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Address</label>
                                <input value="{{ old('address') }}" type="text"
                                    class="@error('address') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Address" name="address">
                                @error('address')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Experience</label>
                                <textarea class="form-control" name="experience" cols="30" rows="5">{{ old('experience') }}</textarea>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
