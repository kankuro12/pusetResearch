@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.policy.policy_index') }}">Policy</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.setting.policy.policy_add')}}" class="btn btn-primary btn-sm"> Add </a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row p-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($policies as $key => $policy)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $policy->title }}
                            <td>
                                <a href="{{ route('admin.setting.policy.policy_edit', ['policy_id' => $policy->id]) }}"
                                    class="btn btn-primary btn-sm"> Edit</a>
                                <a href="{{ route('admin.setting.policy.policy_del', ['policy_id' => $policy->id]) }}"
                                    class="btn btn-danger btn-sm">Del</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')

@endsection
