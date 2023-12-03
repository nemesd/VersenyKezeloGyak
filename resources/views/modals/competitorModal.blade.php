<!-- Competitor Modal -->
<div class="modal fade" id="compModal" tabindex="-1" aria-labelledby="compModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compModalLabel">Új versenyző felvétele</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger inLineAlert">
                    {{-- Hibaüzenet helye --}}
                </div>
                <select class="form-select" id="competitors">
                    <!-- Ide kerülnek a versenyzők -->
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                <button type="button" class="btn btn-primary" onclick="addCompetitor()">Mentés</button>
            </div>
        </div>
    </div>
</div>