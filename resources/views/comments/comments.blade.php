<style>
    .form {
        padding-left: 20px;
        padding-top: 10px;
        border-color: #EBEBEB;
        border-left: 1px solid rgb(166, 166, 171);
        background-color: #F9F9F9;
        min-width: 300px;
    }

    .media-body {
        min-width: 250px;
    }
</style>
</style>
@foreach ($comments as $comment)
<div class="d-sm-flex my-3 form mr-2" style="margin-left: {{ min($level * 20, 80) }}px; min-width: 300px;">

    <a class="d-inline-block mr-2 mb-3 mb-md-0" style="text-decoration: none;" href="#">
        <div class="user-icon rounded-circle" style="min-width:30px; min-height:30px; background-color: {{'hsl(' . hexdec(substr(md5($comment->username), 0, 2)) . ', 60%, 50%)'}}">
            <center><span class="initial" style="line-height:30px;color: white; text-transform: uppercase;">{{ mb_substr($comment->username, 0, 1) }}</span>
                <center>
        </div>

    </a>

    <div class="media-body pr-3" style="min-width: 250px; word-wrap: break-word; overflow-wrap: break-word;">
        <div class="d-flex justify-content-between align-items-center">
            <h4 id="data-user-id-{{ $comment->id }}" data-user-id="{{ $comment->username }}">{{ $comment->username }}</h4>
            {{ \Carbon\Carbon::parse($comment->created_at)->locale('uk')->isoFormat('H:mm DD/MM/YY') }}

        </div>
        <div>{{ $comment->comment }}</div>
        <div class="d-flex justify-content-between align-items-center mb-lg-3">
            @if ($comment->replies !== null && count($comment->replies) > 0)
            <a class="text-primary font-weight-600" href="#!" data-toggle="collapse" data-target="#replies-{{ $comment->id }}">
                Відповіді ({{ count($comment->replies) }})
            </a>
            @endif
            <div class="d-flex justify-content-between">
                <a class="text-primary font-weight-600 reply-btn mr-3" href="#!" data-parent-id="{{ $comment->id }}">Відповісти</a>
                @if ($comment->user_id == auth()->id())
                <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <a type="" class="delete-comment-btn" data-comment-id="{{ $comment->id }}">
                        <i class="bi bi-trash"></i>
                    </a>
                </form>
                @endif
            </div>

        </div>
    </div>
</div>

@if ($comment->replies !== null && count($comment->replies) > 0)
<div class="collapse" id="replies-{{ $comment->id }}">
    @include('comments.comments', ['comments' => $comment->replies, 'level' => $level + 1])
</div>
@endif
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var replyButtons = document.querySelectorAll('.reply-btn');
        var form = document.querySelector('#comment-form');

        replyButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var form = document.querySelector('#comment-form');
                form.scrollIntoView({
                    behavior: 'smooth'
                });
                var parentId = this.getAttribute('data-parent-id');
                var userId = document.getElementById('data-user-id-' + parentId).getAttribute('data-user-id'); // Використовуємо унікальний ідентифікатор для кожного коментаря
                console.log('Parent ID:', parentId);
                console.log('User ID:', userId);
                var parentIdInput = form.querySelector('input[name="parent_id"]');
                parentIdInput.value = parentId;
                var commentInput = form.querySelector('textarea[name="comment"]');
                commentInput.value = '@' + userId + ', ';
            });
        });

        if (!$._data(document, 'events') || !$._data(document, 'events')['click'] || !$._data(document, 'events')['click'].some(event => event.selector === '.delete-comment-btn')) {
            $(document).on('click', '.delete-comment-btn', function(e) {
                e.preventDefault();
                var commentId = $(this).data('comment-id');
                if (confirm("Ви впевнені, що хочете видалити цей коментар?")) {
                    $('#delete-comment-form-' + commentId).submit();
                } else {
                    return false;
                }
            });
        }
    });
</script>