<div class="dropdown" id="sort-by">
    <button id="open-btn" type="button" class="btn dropdown-toggle" data-toggle="dropdown">Sort by </button>
    <form class="dropdown-menu p-3" id="form">
        <div class="form-check">
            <input type="radio" class="form-check-input" id="tokens" value="tokens" name="type" checked>
            <label class="form-check-label" for="tokens">Rating</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="date" value="date" name="type">
            <label class="form-check-label" for="date">Date posted</label>
        </div>
        <div class="dropdown-divider"></div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="asc" value="ASC" name="direction">
            <label class="form-check-label" for="asc">Ascending</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="desc" value="DESC" name="direction" checked>
            <label class="form-check-label" for="desc">Descending</label>
        </div>


        <div class="dropdown-divider"></div>
        <input type="button" value="Refresh" id="refresh-btn" class="btn" onclick="fja1()">
    </form>

    <script>
        function fja1(){
            fja(<?= json_encode($reviews) ?>)
        }

    </script>
</div>