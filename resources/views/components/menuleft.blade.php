<!-- Left Column -->
<style>
    html, body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* define a fixed width for the entire menu */


    /* reset our lists to remove bullet points and padding */
    .mainmenu, .submenu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* make ALL links (main and submenu) have padding and background color */
    .mainmenu a {
        display: block;
        /*background-color: #CCC;*/
        text-decoration: none;
        padding: 10px;
        color: #000;
    }

    /* add hover behaviour */
    .mainmenu a:hover {
        background-color: #a07261;
    }


    /* when hovering over a .mainmenu item,
      display the submenu inside it.
      we're changing the submenu's max-height from 0 to 200px;
    */

    .mainmenu li:hover .submenu {
        display: block;
        max-height: 800px;
    }

    /*
      we now overwrite the background-color for .submenu links only.
      CSS reads down the page, so code at the bottom will overwrite the code at the top.
    */

    .submenu a {
        background-color: #a07261;
    }

    /* hover behaviour for links inside .submenu */
    .submenu a:hover {
        background-color: #7f5644;
    }

    /* this is the initial state of all submenus.
      we set it to max-height: 0, and hide the overflowed content.
    */
    .submenu {
        overflow: hidden;
        max-height: 0;
        -webkit-transition: all 0.5s ease-out;
    }
</style>
<div class="w3-col m3">
    <!-- Profile -->
    <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
            <h4 class="w3-center">Menu Fixo</h4>
        </div>
    </div>
    <div class="w3-card-2 w3-round">
        <div class="w3-white">
            <a href="/login" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Login</a>
            <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Centros de custo</button>
            <div id="Demo2" class="w3-hide w3-container">
                <a href="/centro-de-custo/gerenciamento" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Gerenciamento">
                    <i class="fa fa-globe"></i> Gerenciamento
                </a>
                <a href="/centro-de-custo/Facilities" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Facilities">
                    <i class="fa fa-briefcase"></i> Facilities
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="w3-card-2 w3-round w3-white">
        <nav class="navigation">
            <ul class="mainmenu">
                @forelse($categories as $category)
                    <li><a href="">{{$category->name}}</a>
                        <ul class="submenu">
                            @forelse($category->procedures as $produre)
                                @if($produre->publish)
                                    <li><a href="/documentos/{{$produre->id}}">{{$produre->name}}</a></li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </li>
                @empty

                @endforelse
            </ul>
        </nav>
    </div>
    <br>







    <!-- End Left Column -->
</div>
<!-- End Left Column -->