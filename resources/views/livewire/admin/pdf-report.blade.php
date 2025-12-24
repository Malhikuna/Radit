<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $type }} Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h2>{{ $type }} Report</h2>
    <table>
        <thead>
            <tr>
                @if($type == 'Users')
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                @elseif($type == 'Posts')
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                @elseif($type == 'Communities')
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    @if($type == 'Users')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                    @elseif($type == 'Posts')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                    @elseif($type == 'Communities')
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
