@if(count($agendas) > 0)
  @foreach($agendas as $agenda)
    <li class="list-group-item"><a href="{{ route('agenda', Crypt::encrypt($agenda->id)) }}" class="text-dark">{{ $agenda->judul }}</a></li>
  @endforeach
@else
  <li class="list-group-item">No Results Found</li>
@endif