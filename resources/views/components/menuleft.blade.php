<div class="w3-col m3">
    <!-- Profile -->
    <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
            <h4 class="w3-center"><strong>Menu</strong></h4>
        </div>
    </div>
    <div class="w3-card-2 w3-round">
        <div class="w3-white">
            <a href="/login" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Login</a>
            <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Centros de custo</button>
            <a href="/document" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-book fa-fw w3-margin-right"></i> Padronização</a>
            <div id="Demo2" class="w3-hide w3-container">
                <a href="/centro-de-custo/gerenciamento" class="w3-bar-item w3-button w3-hide-small w3-hover-white" title="Gerenciamento">
                    <em class="fa fa-globe"></em> Gerenciamento
                </a>
                <a href="/centro-de-custo/Facilities" class="w3-bar-item w3-button w3-hide-small  w3-hover-white" title="Facilities">
                    <em class="fa fa-briefcase"></em> Facilities
                </a>
                <a href="/centro-de-custo/sede" class="w3-bar-item w3-button w3-hide-small  w3-hover-white" title="Facilities">
                    <em class="fa fa-building"></em> Sede
                </a>
            </div>
        </div>
    </div>
    <br>

    <div id='cssmenu'>
        <ul>
            @foreach($categories as $category)
                <li class='has-sub'><a href="">{{$category->name}}</a>
                <ul>
                @forelse($category->procedures as $produre)
                    @if($produre->publish)
                        <li><a href="/documentos/{{$produre->id}}">{{$produre->name}}</a></li>
                        @endif
                        @empty

                @endforelse
                </ul>
                </li>
            @endforeach
        </ul>
    </div>









    <!-- End Left Column -->
</div>
<!-- End Left Column -->