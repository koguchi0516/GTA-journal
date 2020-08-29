<div id="modal" class="modal">
    <form action="/report/{{ $article_title_id }}" method="post" class="modal-content material">
        {{ csrf_field() }}
        <div class="modal-content-header">
            <h3>報告内容を選択</h3>
            <i class="material-icons" id="closeBtn">clear</i>
        </div>
        
        <div class="radio-contain">
            <label class="check_lb">
                <input type="radio" name="report_content" value="1">法令違反（著作権侵害、プライバシー侵害、名誉棄損等）
            </label>
            <label class="check_lb">
                <input type="radio" name="report_content" value="2">社会的に不適切（公的風俗に反する）
            </label>
            <label class="check_lb">
                <input type="radio" name="report_content" value="3">宣伝行為
            </label>
            <label class="check_lb">
                <input type="radio" name="report_content" value="4">スパムの疑い
            </label>
            <label class="check_lb">
                <input type="radio" name="report_content" value="5">それ以外でGTA journalにふさわしくない（ガイドライン違反）
            </label>
        </div>
        <input type="hidden" name="target_content_id" id="target_content_id" value="">
        <input class="btn-flat-logo" type="submit" value="送信">
    </form>
</div>