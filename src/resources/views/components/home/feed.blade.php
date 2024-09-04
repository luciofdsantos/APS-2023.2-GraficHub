<!--<div class="feed mainhome">
    <div class="box-options mainhome">
        <div class="box-intern">
            <div id ="descobrir-box" class="options"><a  id="descobrir"  >Descobrir</a></div>

            <div id="seguindo-box" class="options" ><a   id="seguindo">Seguindo</a></div>
        </div>
    </div>
        <x-projeto.grid-projetos :projects="$projects"/>
        <div class="empt">{{ $projects->links() }}</div>
    <x-projeto.grid-projetos :projects="$projects"/>
    <div class="empt">{{ $projects->links() }}</div>
</div>
-->
<div class="container d-flex flex-column justify-content-center align-items-center pt-3 ">
    <div class="btn-group pb-3">
        <a href="{{ route('home') }}" class="btn btn-primary active" aria-current="page"  onclick="discBGcolor()"> <i class="bi bi-globe"></i> Descobrir </a>
        <a href="{{ route('home.personalizado') }}"  class="btn btn-primary"  @if(auth()->check())onclick="followBGcolor()" @else  onclick="setOut()" @endif> <i class="bi bi-box"></i> Seguindo </a>
    </div>
    <div class="container">

    </div>
</div>
