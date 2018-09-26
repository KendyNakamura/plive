@section('sidebar')
<div class="py-4">
    @foreach ($tags as $tag)
        <li style="list-style: none;">{{ $tag->title }}</li>
    @endforeach
</div>
@endsection
