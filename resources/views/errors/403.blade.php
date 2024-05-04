<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403 Access Denied</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the error page */
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .error-container {
            text-align: center;
        }
        .error-heading {
            color: #dc3545; /* Bootstrap's 'danger' color */
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="display-4 error-heading font-weight-bold">Oops! 403</h1>
        <p class="lead">{{ $exception->getMessage() }}</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>
</body>
</html>
