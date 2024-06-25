<div class="section section--default">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            @if ($hasOverlayImage())
                <div class="col-lg-5 col-md-6 mb-4 mb-md-0 order-1 order-md-2">
                    <div class="video-wrapper">
                        <img src="{{ $getOverlayImageMedia(attributes: ['alt' => '', 'class' => 'img-fluid', 'loading' => 'lazy']) }}
                            <a class="play-btn
                            video-btn" data-toggle="modal"
                            data-src="{{ $getEmbedSrc() }}
                            data-target="#myModal"
                            href="#">
                        <i class="ti-control-play"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 order-2 order-md-1 text-center text-md-left">

                    <a href="{{ $getEmbedSrc() }}" class="btn btn-primary">Перегляньте на ютубі</a>
                </div>
            @else
                <div class="w-full">
                    {!! $getEmbedCode([
                        'class' => 'w-full h-full aspect-video',
                        'allow' => 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                        'allowfullscreen' => true,
                    ]) !!}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Ensuring the modal is properly managed for video playback
    $('#myModal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var videoSrc = button.data('src');
        var modal = $(this);
        modal.find('iframe').attr('src', videoSrc);
    }).on('hidden.bs.modal', function() {
        $(this).find('iframe').attr('src', '');
    });
</script>
