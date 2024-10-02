<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrapping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        h2 {
            color: #333;
        }

        table {
            margin-top: 20px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .btn {
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table {
                font-size: 14px;
            }

            td img {
                width: 60px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "order": [
                    [0, "asc"]
                ] // Default sorting by the first column (ID)
            });
        });
    </script>
</head>

<body>

    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <h2 class="mb-4">Scraping Data</h2>
                <table id="example" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Summary</th>
                            <th>Time</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($millard)
                            @foreach ($millard['title'] as $index => $title)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $title }}</td>
                                    <td>{{ $millard['summary'][$index] ?? 'No summary available.' }}</td>
                                    <td>{{ $millard['time'][$index] ?? 'No time available.' }}</td>
                                    <td>
                                        <img src="{{ $millard['image'][$index] ?? '' }}" alt="Sample Image">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-info btn-sm">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No data available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
