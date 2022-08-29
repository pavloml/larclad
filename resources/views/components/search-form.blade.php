@props(['subcategory' => '', 'city' => ''])
<nav class="row bg-light p-2 search-form justify-content-center mb-1">
        <form class="col-12 form-inline" role="search" action="/search/all/all" id="searchForm">
            <label class="sr-only" for="subcategoryDropdown">Category</label>
            <x-categories-dropdown class="form-control col-12 col-md-3" :selectedSubcategory="$subcategory"/>
            <label class="sr-only" for="searchField">Search</label>
            <input type="search"
                   class="form-control input-search col-12 col-md-4"
                   placeholder="Search"
                   name="q"
                   id="searchField"
                   value="{{request('q')}}">
            <label class="sr-only" for="cityDropdown">City</label>
            <x-cities-dropdown class="form-control col-12 col-md-3" :selectedCity="$city"/>
            <button class="btn btn-info col-12 col-md-2" type="submit"><i class="fas fa-search"></i> Search</button>
        </form>
</nav>
