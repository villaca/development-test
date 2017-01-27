@extends("base")

@section("content")



    @if (isset($data))
        <div class="attributeListing">
            @foreach($data["attributes"] as $key => $attribute)
                <div>
                    <span class="attributeType">{{ $key }} : </span>
                    <span class="attributeValue"> {{ $attribute }}</span>
                </div>
            @endforeach

        </div>



        <table class="listingTable table">
            @if (isset($tableCaption))
                <caption><h3>{{ $tableCaption }}</h3></caption>
            @endif

            <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity Ordered</th>
                <th>Parcial Price</th>

            </tr>
            </thead>

            <tbody>
                @foreach ($data->products as $item)
                    <tr>
                        <td>
                            <a
                                    href="{{ action(
                                            $controllerName . '@' . 'show',
                                                [$item['id']]) }}">
                                {{$item->name}}
                            </a>
                        </td>
                        <td>{{$item->pivot->productQuantity}}</td>
                        <td>{{$item->pivot->price}}</td>
                    </tr>

                @endforeach
            </tbody>


        </table>




    @endif

@endsection