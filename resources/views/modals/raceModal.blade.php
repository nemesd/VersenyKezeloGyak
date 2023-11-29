<!-- Race Modal -->
<div class="modal fade" id="raceModal" tabindex="-1" aria-labelledby="raceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="raceModalLabel">Új verseny felvétele</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger inLineAlert">
                    {{-- Hibaüzenet helye --}}
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="raceName" placeholder="Verseny neve" name="raceName">
                    <label for="raceName">Verseny neve</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="raceYear" placeholder="Verseny éve" name="raceYear">
                    <label for="raceYear">Verseny éve (2023-2050)</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="raceCat" placeholder="Verseny kategóriája" name="raceCat">
                    <label for="raceCat">Verseny kategóriája</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="raceDesc" placeholder="Verseny leírása" name="raceDesc">
                    <label for="raceDesc">Verseny leírása</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                <button type="button" class="btn btn-primary" onclick="addRace()">Mentés</button>
            </div>
        </div>
    </div>
</div>