@extends('layouts.frontend')
@section('title')
VAT
@stop
@section('header')
	<section class="content-header">
      <h1>
        Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">VAT</li>
      </ol>
    </section>
@stop
@section('content')
<form action="{{route('tax.update')}}" method="post">
	@csrf
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body">
					<table class="table table-hover mb-0">
						<tbody>
							<div class="row">
								<tr>
									<td><strong>VAT:</strong></td>
									<td>
										<input type="radio" name="enable" value="yes" {{($tax[0]->enable == 'yes')?'checked':''}}>Enable
										<input type="radio" name="enable" value="no" {{($tax[0]->enable == 'no')?'checked':''}}>Diasble
										<input type="text" name="tax" value="{{$tax[0]->tax}}">
									</td>
								</tr>
							</div>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><div class="text-center">
	<button class="btn btn-sm btn-info" type="submit">Save</button>
	</div>
</form>
@stop