<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield("title")</title>

        @include("links")
    </head>

    <body>
        <div class="container">
            @yield("content")
        </div>

        @include("scripts")
    </body>
</html>