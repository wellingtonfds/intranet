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
        max-height: 200px;
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
            <h4 class="w3-center">My Profile</h4>
            <p class="w3-center"><img src="/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
            <hr>
            <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
            <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
            <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
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
                                <li><a href="/procedures/text/{{$produre->id}}">{{$produre->name}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </li>
                @empty

                @endforelse
                {{--<li><a href="">Home</a></li>--}}
                {{--<li><a href="">About</a></li>--}}
                {{--<li><a href="">Products</a>--}}
                    {{--<ul class="submenu">--}}
                        {{--<li><a href="">Tops</a></li>--}}
                        {{--<li><a href="">Bottoms</a></li>--}}
                        {{--<li><a href="">Footwear</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="">Contact us</a></li>--}}
            </ul>
        </nav>
    </div>
    <br>

    <!-- Accordion -->
    <div class="w3-card-2 w3-round">
        <div class="w3-white">
            <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
            <div id="Demo1" class="w3-hide w3-container">
                <p>Some text..</p>
            </div>
            <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
            <div id="Demo2" class="w3-hide w3-container">
                <p>Some other text..</p>
            </div>
            <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
            <div id="Demo3" class="w3-hide w3-container">
                <div class="w3-row-padding">
                    <br>
                    <div class="w3-half">
                        <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
                    </div>
                    <div class="w3-half">
                        <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
                    </div>
                    <div class="w3-half">
                        <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
                    </div>
                    <div class="w3-half">
                        <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
                    </div>
                    <div class="w3-half">
                        <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
                    </div>
                    <div class="w3-half">
                        <img src="/w3images/fjords.jpg" style="width:100%" class="w3-margin-bottom">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Interests -->
    <div class="w3-card-2 w3-round w3-white w3-hide-small">
        <div class="w3-container">
            <p>Interests</p>
            <p>
                <span class="w3-tag w3-small w3-theme-d5">News</span>
                <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
                <span class="w3-tag w3-small w3-theme-d3">Labels</span>
                <span class="w3-tag w3-small w3-theme-d2">Games</span>
                <span class="w3-tag w3-small w3-theme-d1">Friends</span>
                <span class="w3-tag w3-small w3-theme">Games</span>
                <span class="w3-tag w3-small w3-theme-l1">Friends</span>
                <span class="w3-tag w3-small w3-theme-l2">Food</span>
                <span class="w3-tag w3-small w3-theme-l3">Design</span>
                <span class="w3-tag w3-small w3-theme-l4">Art</span>
                <span class="w3-tag w3-small w3-theme-l5">Photos</span>
            </p>
        </div>
    </div>
    <br>

    <!-- Alert Box -->
    <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
                <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
                    <i class="fa fa-remove"></i>
                </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
    </div>

    <!-- End Left Column -->
</div>
<!-- End Left Column -->