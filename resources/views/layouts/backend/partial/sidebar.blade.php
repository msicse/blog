<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('storage/user/'.Auth::user()->image) }}" width="50" height="50" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        ><i class="material-icons">input</i>Sign Out</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->

    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @if(Request::is('admin*'))
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
                <a href="{{ route('admin.tags.index') }}">
                    <i class="material-icons">label</i>
                    <span>Tags</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="material-icons">view_comfy</i>
                    <span>Category</span>
                </a>
            </li>
            
            <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                <a href="{{ route('admin.posts.index') }}">
                    <i class="material-icons">event_note</i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/favorite/posts*') ? 'active' : '' }}">
                <a href="{{ route('admin.posts.favorite') }}">
                    <i class="material-icons">event_note</i>
                    <span>Favorite Posts</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/post/all*') ? 'active' : '' }}">
                <a href="{{ route('admin.all.post') }}">
                    <i class="material-icons">event_note</i>
                    <span>All Posts</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/pending/posts*') ? 'active' : '' }}">
                <a href="{{ route('admin.pending.post') }}">
                    <i class="material-icons">event_note</i>
                    <span>Pending Posts</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/comments*') ? 'active' : '' }}">
                <a href="{{ route('admin.comments') }}">
                    <i class="material-icons">comment</i>
                    <span>Comments</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/subcribers*') ? 'active' : '' }}">
                <a href="{{ route('admin.subcribers') }}">
                    <i class="material-icons">subscriptions</i>
                    <span>Subscribers</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/authors*') ? 'active' : '' }}">
                <a href="{{ route('admin.authors') }}">
                    <i class="material-icons">account_circle</i>
                    <span>Authors</span>
                </a>
            </li>
            <li class="header">System</li>

            <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}">
                    <i class="material-icons">build</i>
                    <span>Settings</span>
                </a>
            </li>

            <li>
                <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Logout</span>
                </a>
            </li>

            


            @endif

            @if(Request::is('author*'))
            <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                <a href="{{ route('author.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('author/posts*') ? 'active' : '' }}">
                <a href="{{ route('author.posts.index') }}">
                    <i class="material-icons">event_note</i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="{{ Request::is('author/favorite/posts*') ? 'active' : '' }}">
                <a href="{{ route('author.posts.favorite') }}">
                    <i class="material-icons">event_note</i>
                    <span>Favorite Posts</span>
                </a>
            </li>
            <li class="{{ Request::is('author/comments*') ? 'active' : '' }}">
                <a href="{{ route('author.comments') }}">
                    <i class="material-icons">comment</i>
                    <span>Comments</span>
                </a>
            </li>
            <li class="header">System</li>

            <li class="{{ Request::is('author/settings*') ? 'active' : '' }}">
                <a href="{{ route('author.settings') }}">
                    <i class="material-icons">build</i>
                    <span>Settings</span>
                </a>
            </li>

            <li>
                <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Logout</span>
                </a>
            </li>
            @endif

            

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 - {{ date('Y') }} <a href="/">Blog</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>