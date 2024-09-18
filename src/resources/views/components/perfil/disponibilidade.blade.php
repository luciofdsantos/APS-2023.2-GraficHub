@if(auth()->id() == $user['id'])

    <form action="{{route('user.updateDisp', $user['id'])}}" method="post">
        @csrf
        @endif
        <div class="d-flex gap-2 align-items-center">
        @if($user['disponivel'])

            <button  type="submit" class="d-flex  disp-btn green-disp-btn">Disponível </button>
             @else
            <button  type="submit" class="disp-btn red-disp-btn">Indisponível </button>
        @endif
            <i style="margin-left: 10px;" type="button" class="bi bi-info-circle-fill" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content=@if(auth()->id() == $user['id']) "O estado de disponibilidade informa a outros usuários a sua disponibilidade em aceitar trabalhos. Clique para alterar." @else "O estado de disponibilidade informa a outros usuários a  disponibilidade deste usuário em aceitar trabalhos." @endif> </i>

        </div>
        @if(auth()->id() == $user['id'])
        <div id="disp-info-text" title="self">
        </div>
    </form>

@else
    <div id="disp-info-text" title="">
    </div>
@endif



