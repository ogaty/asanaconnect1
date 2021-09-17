@extends('layouts')

@section('content')

<table border="1">
    <tr>
        <td>
            project ID
        </td>
        <td>
            project name
        </td>
        <td>
            
        </td>
    </tr>
    @foreach ($projects as $project)
    <tr>
        <td>{{ $project['gid'] }}</td>
        <td>{{ $project['name'] }}</td>
        <td></td>
    </tr>
    @endforeach
</table>


@endsection

