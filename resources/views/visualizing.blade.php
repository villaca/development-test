@extends("base")

@section("content")

    @if (isset($data))
        <div class="attributeListing">
            @foreach($data["attributes"] as $key => $attribute)
                @if ($key != "id")
                    @if ($key != "created_at")
                        @if ($key != "updated_at")
                            <div>
                                <span class="attributeType">{{ $key }} : </span>
                                <span class="attributeValue"> {{ $attribute }}</span>
                            </div>
                        @endif
                    @endif
                @endif
            @endforeach
        </div>

        <div>
            @php
                $url =  action($controllerName . '@edit', [$data["attributes"]['id']]);
            @endphp
            <button
                    type="button"
                    class="btn btn-default"
                    aria-label="Edit item"
                    onclick="window.location='{{ $url }}'"
            >
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>


            <form
                    action="{{ action($controllerName . "@destroy", [$data["attributes"]['id']]) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                    class="buttonForm"
            >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-default" aria-label="Delete item">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </form>
        </div>



    @endif




@endsection