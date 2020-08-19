@if(empty($article_data))
    <div class="article-list">
    <p>投稿はありません</p>
    </div>
@else
    @foreach($article_data as $data)
    <a href="/article/{{ $data -> id }}" class="link-btn">
        <div class="article-list">
            <img src="user-icons/{{ Auth::user() -> icon }}" alt="icon">
            <div class="article-supplement">
                <h2>{{ $data -> title }}</h2>
                <div class="favorite-count">
                    <p>{{ date('m月d日 G時i分',strtotime($data -> updated_at)) }}</p>
                    <i class="material-icons">favorite</i>
                    <p>favoCount</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
@endif