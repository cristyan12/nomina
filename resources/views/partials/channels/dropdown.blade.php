<select name="channel_id" id="channel_id" class="custom-select">
@foreach($channels as $channel)
    <option value="{{ $channel->id }}">
        {{ str_limit($channel->name, 50) }}
    </option>
@endforeach
</select>