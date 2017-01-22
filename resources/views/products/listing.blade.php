@extends("base")

@section("content")
    @if (isset($products))
        @foreach ($products as $product)
            <p>This is product {{ $product->name }}</p>
        @endforeach

        {{ $products->links() }}
    @endif
@endsection