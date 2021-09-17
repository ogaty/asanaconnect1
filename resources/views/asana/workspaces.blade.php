@extends('layouts')

@section('content')

<table border="1">
    <tr>
        <td>
            workspace ID
        </td>
        <td>
            workspace name
        </td>
        <td>
            
        </td>
    </tr>
    @foreach ($workspaces as $workspace)
    <tr>
        <td>{{ $workspace['gid'] }}</td>
        <td>{{ $workspace['name'] }}</td>
        <td><a href="{{ route('asana.projects', $workspace['gid']) }}">プロジェクト</a></td>
    </tr>
    @endforeach
</table>


@endsection

