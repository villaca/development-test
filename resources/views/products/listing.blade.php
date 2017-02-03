@extends("base")

@section("content")
    @if (isset($data))

        <table class="listingTable table">
            @if (isset($tableCaption))
                <caption><h3>{{ $tableCaption }}</h3></caption>
            @endif

            <thead>
                <tr>
                    @foreach ($data[0]['attributes'] as $key => $attribute)
                        @if ($key != "id")
                            @if ($key != "created_at")
                                @if ($key != "updated_at")
                                    <th> {{ $key }}</th>
                                @endif
                            @endif
                        @endif
                    @endforeach

                    <th>Edit Information</th>
                    <th>Delete</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    @php
                        $printedKeys = 0;
                    @endphp

                    <tr>
                        @foreach ($item['attributes'] as $key => $attribute)
                            @if ($key != "id")
                                @if ($key != "created_at")
                                    @if ($key != "updated_at")
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
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        <td>
                            @php
                                $url =  action($controllerName . '@edit', [$item['id']]);
                            @endphp
                            <button
                                    type="button"
                                    class="btn btn-default"
                                    aria-label="Edit item"
                                    onclick="window.location='{{ $url }}'"
                            >
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td>

                            <form
                                    action="{{ action($controllerName . "@destroy", [$item['id']]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                            >
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default" aria-label="Delete item">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}

        <div>
            @php
                $url = action($controllerName . '@create');
            @endphp

            <button
                    type="button"
                    class="btn btn-default"
                    aria-label="New item"
                    onclick="window.location='{{ $url }}'"
            >
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                <span> New Item</span>
            </button>
        </div>
    @endif
@endsection