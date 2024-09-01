@if(auth()->id() == $user['id'])
    <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
        @csrf
        @endif
        @if($user['disponivel'])
            <button type="submit" class="disp-btn green-disp-btn">Disponível <img class="disp-info-icon" src="/img/info-icon.png" onmouseover="showMessage()" onmouseout="hideMessage()"></button>
        @else
            <button  type="submit" class="disp-btn red-disp-btn">Indisponível <img class="disp-info-icon" src="/img/info-icon.png"  onmouseover="showMessage()" onmouseout="hideMessage()"> </button>
        @endif
        <div id="disp-info-text">
        </div>
        @if(auth()->id() == $user['id'])
    </form>
@endif
