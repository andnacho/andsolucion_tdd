@if ($errors->{$bag ?? 'default'}->any())

    <ul class="field mt-6 list-reset text-red">
        @foreach ($errors->{$bag ?? 'default'}->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

@endif