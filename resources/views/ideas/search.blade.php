<h4 class="title text-center">SEARCH</h4>
<div class="card my-lg-3">
    <div class="card-body ">
        <form action="">
            <div>
                <label class="form-label" for="searchUsingKey">Key:</label>
                <input type="search" class="form-control" id="searchUsingKey" aria-describedby="search-addon" name="search" value="{{ request()->input('search') }}">
            </div>
            <div style="padding: 10px 0px 0px 0px;">
                <label for="selectMission" class="form-label">Mission:</label>
                <select class="form-select" id="selectMission" name="mission_id">
                    <option value="0">All</option>
                    @foreach($all_missions as $mission)
                    @if ($request->mission_id == $mission->id)
                    <option value="{{ $mission->id }}" selected>{{ $mission->name }}</option>
                    @else
                    <option value="{{ $mission->id }}">{{ $mission->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div style="padding: 10px 0px 0px 0px;">
                <label for="selectFilter" class="form-label">Filter:</label>
                <select class="form-select" id="selectFilter" name="filter" value="{{ request()->get('filter') }}">
                    <option value="none" {{($request->filter == "none") ? "selected" : ""}}>None</option>
                    <option value="views" {{($request->filter == "views") ? "selected" : ""}}>Views (Decreased)</option>
                    <option value="likes" {{($request->filter == "likes") ? "selected" : ""}}>Likes (Decreased)</option>
                    <option value="dislikes" {{($request->filter == "dislikes") ? "selected" : ""}}>Dislikes (Decreased)</option>
                    <option value="comments" {{($request->filter == "comments") ? "selected" : ""}}>Comments (Decreased)</option>
                    <option value="recently" {{($request->filter == "recently") ? "selected" : ""}}>Created time (Decreased)</option>
                    <option value="views_asc" {{($request->filter == "views_asc") ? "selected" : ""}}>Views (Increased)</option>
                    <option value="likes_asc" {{($request->filter == "likes_asc") ? "selected" : ""}}>Likes (Increased)</option>
                    <option value="dislikes_asc" {{($request->filter == "dislikes_asc") ? "selected" : ""}}>Dislikes (Increased)</option>
                    <option value="comments_asc" {{($request->filter == "comments_asc") ? "selected" : ""}}>Comments (Increased)</option>
                    <option value="recently_asc" {{($request->filter == "recently_asc") ? "selected" : ""}}>Created time (Increased)</option>
                </select>
            </div>
            <div style="padding: 15px 0px 0px 0px;">
                <center><button class="btn btn-success d-grid" type="submit">Search</button></center>
            </div>
        </form>
    </div>
</div>