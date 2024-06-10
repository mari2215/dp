@extends('layouts.main')


@section('content')
@include('source.partials.blocks.page-header', ['title' => $category->title, 'page' => $category->title, 'subtitle' => $category->subtitle])
<style>
	.square-image {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.col-6 {
		max-width: 50%;
	}
</style>
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

						@if(isset($activity->image))

						<!-- <span class="badge badge-primary">NEW</span> -->

						<div class="post-slider">
							@if(is_array($activity->image))
							@foreach ($activity->image as $image)
							<div class="card-img {{ $loop->first ? 'active' : '' }}">
								<img src="{{ asset($image) }}" class="img-fluid" alt="Image Description">
							</div>
							@endforeach
							@else
							{{-- Якщо це не масив, обробіть це як одне зображення --}}
							@if(!empty($activity->image))
							<div class="card-img active">
								<img src="{{ asset($activity->image) }}" class="img-fluid" alt="Image Description">
							</div>
							@endif
							@endif

						</div>
						@endif
						<!-- <img src="https://picsum.photos/80/80" alt="" class="card-img-top rounded-0"> -->
						<div class="card-body">
							<a class="text-uppercase mb-3" href="/activity/{{ $activity->id }}">{{$activity->title}}</a>
							<p class="h4">{{$activity->price}} ₴</p>
						</div>
					</a>
				</div>
			</div>
			@endforeach
		</div>

		@if(isset($category->image))
		<div class="my-4 container row justify-content-center">
			<h3>Галерея <mark>{{$category->title}}</mark></h3>
		</div>

		<div class="container">
			<div class="row justify-content-center">
				@if (is_array($category->image) && count($category->image) > 0)
				@foreach(array_slice($category->image, 0, 4) as $image)
				<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
					<a href="{{ asset($image) }}" data-toggle="lightbox" data-gallery="category-gallery" class="d-block mb-4 h-100">
						<img src="{{ asset($image) }}" class="img-fluid img-thumbnail square-image" alt="Image Description">
					</a>
				</div>
				@endforeach
				@foreach(array_slice($category->image, 4) as $image)
				<div data-toggle="lightbox" data-gallery="category-gallery" data-src="{{ asset($image) }}" data-title="Hidden item"></div>
				@endforeach
				@else
				<p>No images available.</p>
				@endif
			</div>
		</div>
		@endif
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endsection