<!-- Round Modal -->
<div class="modal fade" id="roundModal" tabindex="-1" aria-labelledby="roundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roundModalLabel">Új forduló felvétele</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger inLineAlert">
                    {{-- Hibaüzenet helye --}}
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="roundName" placeholder="Forduló neve" name="roundName">
                    <label for="roundName">Forduló neve</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                <button type="button" class="btn btn-primary" onclick="addRound()">Mentés</button>
            </div>
        </div>
    </div>
</div>