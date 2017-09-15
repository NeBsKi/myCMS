@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-content">
            <ul class="dashboard-list">
                <li>
                  <a href="{{ url('admin/page') }}">
                      გვერდი
                  </a>
                </li>
                <li>
                  <a href="">
                      ფოლდერი
                  </a>
                </li>
                <li>
                  <a href="">
                      ფაილი
                  </a>
                </li>
            </ul>
        <div>
    </div>
</div>
@endsection
