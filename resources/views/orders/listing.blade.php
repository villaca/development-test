@extends("base")

@section("content")
    @if (isset($data))


        <table class="listingTable table">
            @if (isset($tableCaption))
                <caption><h3>{{ $tableCaption }}</h3></caption>
            @endif

            <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Creation Date</th>
                <th>Last Update Date</th>


            </tr>
            </thead>

            <tbody>
            @foreach ($data as $item)
                @php
                    $printedKeys = 0;
                @endphp

                <tr>
                    @foreach ($item['attributes'] as $key => $attribute)
                        @if ($printedKeys == 0)
                            <td>
                                <a
                                    href="{{ action(
                                        $controllerName . '@' . 'show',
                                            [$item['id']]) }}">
                                    {{ $attribute }}
                                </a>
                            </td>
                            @php
                                $printedKeys = 1;
                            @endphp
                        @else
                            <td> {{ $attribute }}</td>
                        @endif
                    @endforeach

                </tr>
            @endforeach
            </tbody>


        </table>




    @endif
@endsection