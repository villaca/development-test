<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield("title")</title>

        @include("links")
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="{{ action('ProductController@index') }}">Products</a></li>
                <li><a href="{{ action('OrderController@index') }}">Orders</a></li>
            </ul>
        </nav>

        <div class="container">
            @yield("content")
        </div>

        @include("scripts")
    </body>
</html>