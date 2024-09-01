<div class="feed mainhome">
    <div class="box-options mainhome">
        <div class="box-intern">
            <div id ="descobrir-box" class="options"><a  id="descobrir"  href="{{ route('home') }}" onclick="discBGcolor()">Descobrir</a></div>

            <div id="seguindo-box" class="options" ><a   id="seguindo" href="{{ route('home.personalizado') }}" @if(auth()->check())onclick="followBGcolor()" @else  onclick="setOut()" @endif>Seguindo</a></div>
        </div>
    </div>

    <x-projeto.grid-projetos :projects="$projects"/>
    <div class="empt">{{ $projects->links() }}</div>
</div>
