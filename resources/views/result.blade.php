@if(count($agendas) > 0)
  @foreach($agendas as $agenda)
      <li class="list-group-item">{{ $agenda->token }}</li>
  @endforeach
@else
  <li class="list-group-item">No Results Found</li>
@endif