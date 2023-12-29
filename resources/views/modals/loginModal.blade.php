<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Bejelentkezés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loginModalBody">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="emailLogin" placeholder="Email" name="email">
                    <label for="email">Email</label>
                  </div>
                  <div class="form-floating mt-3 mb-3">
                    <input type="password" class="form-control" id="pwdLogin" placeholder="Jelszó" name="pswd">
                    <label for="pwd">Jelszó</label>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="login()">Bejelentkezés</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
            </div>
        </div>
    </div>
</div>