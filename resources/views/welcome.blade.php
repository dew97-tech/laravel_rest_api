<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        .welcome-container {
            text-align: center;
            padding: 50px;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .welcome-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #6c757d;
        }

        .welcome-buttons a {
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1 class="welcome-title">Welcome to Our Application</h1>
        <p class="welcome-subtitle">Your gateway to an amazing experience</p>
        <div class="welcome-buttons">
            <a href="{{ route("login") }}" class="btn btn-primary btn-lg">Login</a>
            <a href="{{ route("register") }}" class="btn btn-success btn-lg">Register</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
