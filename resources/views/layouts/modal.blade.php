@section('modal')
    <div id="modal" class="modal">
        <form action="#" method="post" class="modal-content">
            <div class="modal-content-header">
                <h3>報告内容を選択</h3>
                <i class="material-icons" id="closeBtn">clear</i>
            </div>
            <div class="radio-contain">
                <label class="check_lb">
                    <input type="radio" name="report-content" value="法令違反">法令違反（著作権侵害、プライバシー侵害、名誉棄損等）
                </label>
                <label class="check_lb">
                    <input type="radio" name="report-content" value="社会的に不適切">社会的に不適切（公的風俗に反する）
                </label>
                <label class="check_lb">
                    <input type="radio" name="report-content" value="宣伝行為">宣伝行為
                </label>
                <label class="check_lb">
                    <input type="radio" name="report-content" value="スパムの疑い">スパムの疑い
                </label>
                <label class="check_lb">
                    <input type="radio" name="report-content" value="その他">それ以外でGTA journalにふさわしくない（ガイドライン違反）
                </label>
            </div>
            <input type="hidden" name="repoeter_id" value="">
            <input type="hidden" name="target_content_id" value="">
            <input type="submit" value="送信">
        </form>
    </div>
@endsection