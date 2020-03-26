<ul class="list-group list-group-flush">
@foreach($channels as $channel)
    <li class="list-group-item">{{ $channel->name }}</li>
@endforeach
</ul>
