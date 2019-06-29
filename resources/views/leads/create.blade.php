@extends('layouts.frontend')
@section('title')
Lead Registration
@endsection
@section('header')
	<section class="content-header">
      <h1>
        Add Lead
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('leads')}}"><i class="fa fa-user-circle"></i> Leads</a></li>
        <li class="active">Add Lead</li>
      </ol>
    </section>
@stop
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('lead.store')}}" method="post">
    @csrf
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name='first_name' value="{{old('first_name')}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name='last_name' value="{{old('last_name')}}" required class="form-control">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Street</label>
                    <input type="text" name='address' value="{{old('address')}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <input id="city" type="text" name='city' value="{{old('city')}}" required class="form-control">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label for="county">County</label>
                    <input id="county" type="text" name='county' value="{{old('county')}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input id="postal_code" type="text" name='postal_code' value="{{old('postal_code')}}" required class="form-control" onkeyup="fun()">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input id="country" type="text" name='country' value="{{old('country')}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name='phone' value="{{old('phone')}}" required class="form-control" maxlength="10">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name='email' value="{{old('email')}}" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="DOB">DOB</label>
                    <input type="date" name='DOB' value="{{Carbon\Carbon::now()->toDateString()}}" required class="form-control">
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="text-center">
            <button class="btn btn-success" type="submit">Add Lead</button>
        </div>
    </div>
</form>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    function fun() {
        var x = document.forms["myForm"]["postal_code"].value;

        var Url = "https://api.postcodes.io/postcodes?q=" + x;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', Url, true);
        xhr.send();
        xhr.onreadystatechange = processRequest;
        function processRequest(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
            // alert(xhr.responseText);
            var response1 = JSON.parse(xhr.responseText);
            console.log(response1);

            document.getElementById("city").value = response1.result[0].admin_ward;
            document.getElementById("country").value = response1.result[0].country;
            document.getElementById("county").value = response1.result[0].admin_county;
            }
        }
    }
</script>
@stop