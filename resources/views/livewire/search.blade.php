<div>
  <div class="input-group justify-content-center">
    <input type="search" autocomplete="off" class="py-3 rounded-pill mb-0" id="myInput" name="search"
    placeholder="Search"
    wire:model="query"
    wire:keydown.escape="reset2"
    wire:keydown.tab="reset2"
    wire:keydown.arrow-up="decrementHighlight"
    wire:keydown.arrow-down="incrementHighlight"
    wire:keydown.enter="selectContact"
    >
  </div>
  <div class="d-flex justify-content-center">
    @if(!empty($query))
      @if(!empty($agendas))
        <ul class="position-absolute" id="myUL">
          @foreach($agendas as $i => $agenda)
            <li>
              <a href="{{ route($agenda['from_table'], $agenda['slug']) }}" class="{{ $highlightIndex === $i ? 'color4' : '' }}">{{ $agenda['judul'] ?? $agenda['nama_tempat'] ?? 'judul' }}</a>
            </li>
          @endforeach
        </ul>
      @else
        <ul class="position-absolute" id="myUL">
          <li><a href="">No results</a></li>
        </ul>
      @endif
    @endif
  </div>
</div>