<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .button-del {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .button:hover {
            background-color: #45a049;
        }

        form {
            margin-top: 20px;
        }

        .input {
            margin-bottom: 15px
        }

        input {
            border: none;
            border-bottom: 1px solid grey;
            padding: 5px
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create Item</h1>

        @if ($errors->any())
        <div>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="input">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="input">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}">
            </div>
            <button type="submit" class="button">Create</button>
        </form>
        <a href="/items">back</a>
    </div>
</body>

</html>