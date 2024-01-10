<nav class="navbar navbar-dark bg-dark mb-2">
    <div class="container-fluid">
        <div class="navbar-brand">Verseny Kezelő</div>
        <div class="nav-item" id="loggedOut">
            <input type="button" class="btn btn-primary" value="Bejelentkezés" data-bs-toggle="modal" data-bs-target="#loginModal">
        </div>
        <div id="loggedIn">
            <span class="navbar-brand" id="userDetails" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoUser()">admin</span>
            <input type="button" class="btn btn-danger" value="Kijelentkezés" onclick="logout()">
        </div>
    </div>
</nav>