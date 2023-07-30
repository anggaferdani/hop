<div>
  <div class="input-group justify-content-center">
    <div class="input-group-text bg-white border-0 rounded-end ps-2 ps-md-3 rounded-pill"><i class="fa-solid fa-magnifying-glass fs-4 text-muted"></i></div>
    <input type="search" autocomplete="off" class="p-2 pe-3 border-0 rounded-start py-2 py-md-3 rounded-pill" id="search" name="search"
    placeholder="Cari Aja..."
    style="width: 50%; height: 50%;"
    wire:model="query"
    wire:keydown.escape="reset2"
    wire:keydown.tab="reset2"
    wire:keydown.arrow-up="decrementHighlight"
    wire:keydown.arrow-down="incrementHighlight"
    wire:keydown.enter="selectContact"
    >
  </div>
  @if(!empty($query))
    @if(!empty($agendas))
    <ul class="list-group mx-auto" style="width: 50%; height: 50%;">
      @foreach($agendas as $i => $agenda)
        <li class="list-group-item {{ $highlightIndex === $i ? 'bg-primary' : '' }}">
          <a href="{{ route('agenda', Crypt::encrypt($agenda['id'])) }}">{{ $agenda['judul'] }}</a>
        </li>
      @endforeach
    </ul>
    @else
      <ul class="list-group mx-auto" style="width: 50%; height: 50%;">
        <li class="list-group-item">No results</li>
      </ul>
    @endif
  @endif
</div>
