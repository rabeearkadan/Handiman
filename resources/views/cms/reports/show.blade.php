@extends('cms.layouts.app')

@section('content')
    <!DOCTYPE html>
<html>
<head>
    <title>Report</title>
</head>
<body>
<h1>Request Report</h1>
<iframe src="{{config('image.path').$request->report}}" width="100%" height="500px">
</iframe>
</body>
</html>
@endsection
