<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new post</div>
                <div class="card-body">
                    <form action="#">
                        @include('partials.channels.dropdown')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>