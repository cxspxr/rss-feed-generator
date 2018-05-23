
<div class="card-header">{!! $article->title !!}</div>
<div class="card-body">
    <p>{!! $article->description !!}</p>
    <p class="label label-info">{{ $article->date }}</p>

    <div>
        <b>
            Source:
            <span class="text-info">
                {{ $article->link }}
            </span>
        </b>
    </div>
</div>
