@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-content">
            <div class="page-menu">
              <ul>
                <li>
                  <a href="{{ url('admin/dashboard') }}">
                    <button class="btn btn-default">უკან</button>
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.page.create') }}">
                    <button class="btn btn-success">ახალი</button>
                  </a>
                </li>
                <li>
                    <button class="btn btn-warning btnEdit">რედაქტირება</button>
                </li>
                <li>
                    <button class="btn btn-danger btnDelete">წაშლა</button>
                </li>
              </ul>
            </div>

            <div class="page-filter">
                <form method="GET" action="{{ url('admin/page/filter') }}">
                    <ul>
                        <li>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="დასახელება" value="{{ app('request')->input('title') }}">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <select name="is_published" class="form-control">
                                    <option value="0">აირჩიეთ სტატუსი</option>
                                    <option value="1">აქტიური</option>
                                    <option value="2">პასიური</option>
                                </select>
                            </div> 
                        </li>
                        <li>
                            <button type="submit" class="btn btn-success">ფილტრი</button>
                        </li>
                        <li>
                            <button class="btn btn-warning filterReset">განულება</button>
                        </li>
                    </ul> 
                </form>
            </div>
            
            @if (session('msg'))
                <div class="alert alert-success">
                    {{ session('msg') }}
                </div>
            @endif
            

            @if (count($pages) > 0)

                <div class="tree-pages">
                    <form action="{{ url('admin/page/destroy') }}" method="POST" class="deleteForm">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <?=treePages($pages) ?>
                    </form>
                </div>
            
                @else 
                
                <div class="alert alert-danger" role="alert">გვერდი არ მოიძებნა ბაზაში...</div>
                
            @endif
                    
                
        </div>
    </div>
</div>
@endsection
