@if ($errors->any())
  <div class="message-box">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (Session::has('info'))
    <div class="message-box">
        <ul>
            @if(Session::has('info'))
                <li>{{ Session('info') }}</li>
            @endif
        </ul>
    </div>
@endif

@if (Session::has('info-'.$report_id))
    <div class="message-box">
        <ul>
            @if(Session::has('info-'.$report_id))
                <li>{{ Session('info-'.$report_id) }}</li>
            @endif
        </ul>
    </div>
@endif