@extends('layouts.app')

@section('template_title')
	Routing Information
@endsection

@section('content')
	<section class="page-header-title">
        <h4 class="page-title">Routing Information</h4> 
   </section>
	<div class="container-fluid mt-n5">
		<div class="row">
			<div class="col-md-12">

				@include('partials.form-status')

				<div class="card">
					<div class="card-header">
						Routing Information
						<span class="badge badge-primary pull-right">{{ count($routes) }} routes</span>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped  data-table">
								<thead>
									<tr class="success">
					                    <th>URI</th>
					                    <th>Name</th>
					                    <th>Type</th>
					                    <th>Method</th>
									</tr>
								</thead>
								<tbody>
							        @foreach ($routes as $route)
										<tr>
				                        <td>{{$route->uri}}</td>
				                        <td>{{$route->getName()}}</td>
				                        <td>{{$route->getPrefix()}}</td>
				                        <td>{{$route->getActionMethod()}}</td>
										</tr>
							        @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
