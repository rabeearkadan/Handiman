@extends('cms.layouts.app')

@section('content')
    <!DOCTYPE html>
<html>
<head>
    <title>Title of the document</title>
</head>
<body>
<h1>PDF Example with iframe</h1>
<iframe src="http://www.orimi.com/pdf-test.pdf" width="100%" height="500px">
</iframe>
</body>
</html>
@endsection
