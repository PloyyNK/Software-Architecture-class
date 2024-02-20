<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 2rem;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            justify-content: space-evenly;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        td {
            border-top: 1px solid grey;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-close {
            border: none;
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .button {
            border: none;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0;
        }

        .button-del {
            border: none;
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

        .bill {
            border-radius: 10px;
            border: 1px solid grey;
            padding: 2rem;
            text-align: left;
            margin-top: 1rem;
        }

        .bill table {
            width: 100%;
        }

        .bill th,
        .bill td {
            padding: 8px;
            text-align: left;
        }

        .bill th {
            background-color: #f2f2f2;
        }

        .pay {
            display: grid;
        }
    </style>
</head>

<body>
    <h1>Sale Management</h1>
    <div class="container">
        <div>
            <h2>Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <form action="{{ route('sale.add', ['sale' => $sale->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="itemId" value="{{ $item->id }}">
                                <input type="number" name="quantity" id="quantity" value="0" min="0">
                                <button class="button" type="submit">Add to Sale</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bill">
            <h2>Sale Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($saleLineItems->isEmpty())
                    <tr>
                        <td colspan="3">No items in sale.</td>
                    </tr>
                    @else
                    @foreach ($saleLineItems as $saleLineItem)
                    <tr>
                        <td>{{ $saleLineItem->item->name }}</td>
                        <td>{{ $saleLineItem->quantity }}</td>
                        <td>${{ $saleLineItem->subtotal }}</td>
                        <td>
                            <form action="/sale/delete/{{$saleLineItem->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-del">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <p>Total: ${{$total}}</p>
            <form action="{{ route('sale.close', ['sale' => $sale->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="pay">
                    <div>
                        <input type="checkbox" name="pay" value="true">
                        <label>Paid</label>
                    </div>
                    <button class="btn-close">Close Sale</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>