<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraping Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 40px;
        }

        h2 {
            color: #444;
            font-weight: bold;
            text-align: center;
        }

        table {
            margin-top: 30px;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th i {
            margin-right: 5px;
            font-size: 16px;
        }

        th,
        td {
            vertical-align: middle;
            padding: 12px;
        }

        td {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #f1f3f5;
        }

        td img {
            width: 80px;
            height: auto;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        td img:hover {
            transform: scale(1.1);
        }

        .btn {
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
            padding: 6px 12px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn i {
            margin-right: 5px;
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
                            <th><i class="bi bi-hash"></i>ID</th>
                            <th><i class="bi bi-card-text"></i>Title</th>
                            <th><i class="bi bi-justify-left"></i>Summary</th>
                            <th><i class="bi bi-clock"></i>Time</th>
                            <th><i class="bi bi-image"></i>Image</th>
                            <th><i class="bi bi-gear"></i>Actions</th>
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
                                        <button class="btn btn-primary btn-sm"
                                            onclick="copyLink('{{ $millard['link'][$index] }}')">
                                            <i class="bi bi-clipboard"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-sm"
                                            onclick="viewItem('{{ $millard['link'][$index] }}')">
                                            <i class="bi bi-eye"></i>
                                        </button>
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

    <script>
        function copyLink(link) {
            navigator.clipboard.writeText(link);
            alert('Link copied to clipboard: ' + link);
        }

        function viewItem(link) {
            window.open(link, '_blank');
        }
    </script>

</body>

</html>
