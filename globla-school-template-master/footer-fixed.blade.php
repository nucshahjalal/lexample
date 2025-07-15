<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="false"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen" id="fullscreen" onclick="openFullscreen()">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="false"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-globe" aria-hidden="false"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <form method="POST" action="{{ route('logout') }}" style="background: #172d44;">
            @csrf
            <button type="submit" class="glyphicon glyphicon-off logout-btn" aria-hidden="true" style="background: #172d44;border:0;color: #787e7f;"></button>
        </form>
    </a>
</div>



