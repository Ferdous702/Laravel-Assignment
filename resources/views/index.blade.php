<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Contacts</h1>
    <a href="{{url('/contacts/create')}}" class="btn btn-primary">ADD New Contact</a>
    <form method="GET" action="{{ url('/contacts') }}">
        <input class="form-control mr-sm-2" type="text" placeholder="search" name="search" aria-label="Search" class="form-control" value="{{request('search')}}">
        <button type="submit" class="btn btn-outline-success">Search</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{$contact->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td>{{$contact->address}}</td>
                <td>{{$contact->created_at}}</td>
                <td>
                    <a href="{{url('/contacts/'. $contact->id)}}" class="btn btn-info">View</a>
                    <a href="{{url('/contacts/'. $contact->id.'/edit')}}" class="btn btn-danger">edit</a>
                    <form method="POST" action="{{ url('/contacts/'. $contact->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>