@extends('layouts.main')


@section('content')
@include('source.partials.blocks.page-header', ['title' => $category->title, 'page' => $category->title, 'subtitle' => $category->subtitle])

<section class="section-sm" id="post">
	<div class="container">
		<div class="row">
			<p>{!! ($category->description) !!}</p>
		</div>

		<div class="row">
			@foreach($category->activities as $activity)
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card border-0 rounded-0 text-center shadow-none overflow-hidden">
					<a href="#!">
						<span class="badge badge-primary">NEW</span>
						<img src="https://picsum.photos/80/80" alt="" class="card-img-top rounded-0">
						<div class="card-body">
							<h4 class="text-uppercase mb-3">{{$activity->title}}</h4>
							<p class="h4">{{$activity->price}} ₴</p>
						</div>
					</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection