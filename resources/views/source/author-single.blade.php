@extends('layouts.main')


@section('content')
@include('source.partials.blocks.page-header', ['title' => $category->title, 'page' => $category->title, 'subtitle' => $category->subtitle])

<section class="section-sm" id="post">
	<div class="container">
		<div class="row">

			<div class="col-lg-8 mx-auto">
				<article class="card mb-4">

					<div class="post-slider">
						<img src="https://picsum.photos/300/100" class="card-img-top" alt="post-thumb">
					</div>

					<div class="card-body">
						<h3 class="mb-3"><a class="post-title" href="post-details.html">Advice From a Twenty Something</a></h3>
						<ul class="card-meta list-inline">
							<li class="list-inline-item">
								<a href="author-single.html" class="card-meta-author">
									<img src="https://picsum.photos/50/50">
									<span>Charls Xaviar</span>
								</a>
							</li>
							<li class="list-inline-item">
								<i class="ti-timer"></i>2 Min To Read
							</li>
							<li class="list-inline-item">
								<i class="ti-calendar"></i>14 jan, 2020
							</li>
							<li class="list-inline-item">
								<ul class="card-meta-tag list-inline">
									<li class="list-inline-item"><a href="tags.html">Color</a></li>
									<li class="list-inline-item"><a href="tags.html">Recipe</a></li>
									<li class="list-inline-item"><a href="tags.html">Fish</a></li>
								</ul>
							</li>
						</ul>
						<p>It’s no secret that the digital industry is booming. From exciting startups to global brands, companies are reaching out to digital agencies, responding to the new possibilities available.</p>
						<a href="post-details.html" class="btn btn-outline-primary">Read More</a>
					</div>
				</article>
			</div>
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

							<p class="h4 text-muted font-weight-light mb-3">{!! $activity->description !!}</p>

							{{ $activity->description }}

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