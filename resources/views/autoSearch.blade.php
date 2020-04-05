<ul id="search-list">
    @forelse($itineraries as $itinerary)
        <li class="auto-search-li" onClick="selectResult('{{ $itinerary->title }}')">{{$itinerary->title}}</li>
        @empty
        No result found.
    @endforelse
</ul>
