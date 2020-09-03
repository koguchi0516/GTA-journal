@if (Session::has('info-'.$report_id))
    <div class="message-box">
        <ul>
            @if(Session::has('info-'.$report_id))
                <li>{{ Session('info-'.$report_id) }}</li>
            @endif
        </ul>
    </div>
@endif