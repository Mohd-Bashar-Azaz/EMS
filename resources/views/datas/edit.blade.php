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
                        <h3 class="text-white">Edit Employee Personal Details</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('datas.update',['id'=> $datas->id])}}"
                        method="post">
                        @method('put');
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Phone</label>
                                <input value="{{ old('phone', $datas->phone) }}" type="text"
                                    class="@error('phone') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Phone" name="phone">
                                @error('phone')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Email</label>
                                <input value="{{ old('email', $datas->email) }}" type="text"
                                    class="@error('email') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Email" name="email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Address</label>
                                <input value="{{ old('address', $datas->address) }}" type="text"
                                    class="@error('address') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Address" name="address">
                                @error('address')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Experience</label>
                                <textarea class="form-control" name="experience" cols="30" rows="5">{{ old('experience', $datas->experience) }}</textarea>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection





