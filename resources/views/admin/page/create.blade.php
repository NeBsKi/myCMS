@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="page-content">
            <div class="page-menu">
              <ul>
                <li>
                  <a href="{{ url('admin/page') }}">
                    <button class="btn btn-default">უკან</button>
                  </a>
                </li>
                <li>
                    <button class="btn btn-success savePage">შენახვა</button>
                </li>
              </ul>
            </div>
            <div class="container">
                <div class="row">
                    
                    <form class="savePageForm" action="{{ action('admin\PageController@store') }}" method="post">
                    
                        <div class="post-body">

                            <div id="tabs">
                                <ul>
                                  @foreach ($languages as $lang)
                                       <li><a href="#{{ $lang->slug }}">{{ $lang->title }}</a></li>
                                  @endforeach
                                </ul>
                                
                                @foreach ($languages as $lang)
                                <div id="{{ $lang->slug }}">
                                    
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    
                                    <input type="hidden" name="lang_id_{{ $lang->slug }}" value="{{ $lang->slug }}">
                            
                                    <div class="form-group">
                                        <label for="title">სათაური:</label>
                                        <input type="text" class="form-control" id="title" placeholder="სათაური" name="title_{{ $lang->slug }}">
                                    </div>
                                    @if ($lang->slug == 'ge')
                                    <div class="form-group">
                                        <label for="parent_id">გვერდები:</label>
                                        <select name="parent_id" class="form-control" id="parent_id">
                                          <option value="0">- აირჩიეთ გვერდი</option>
                                          {!! treePagesCreate($pages) !!}
                                        </select>
                                    </div> 
                                    @endif
                                    <div class="form-group">
                                        <label for="body">ტექსტი:</label>
                                        <textarea class="form-control" id="body" placeholder="ტექსტი" name="body_{{ $lang->slug }}"></textarea>
                                    </div>
                                    @if ($lang->slug == 'ge')
                                    <h1 class="settings-heading">Settings</h1>
                                    <div class="settings-panel">
                                        <div class="form-group">
                                            <label for="filter">Filter:</label>
                                            <input type="text" class="form-control" id="filter" placeholder="Filter" name="filter">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug:</label>
                                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug">
                                        </div>
                                    </div>
                                    @endif

                                    <h1 class="meta-heading">Meta Information</h1>
                                    <div class="meta-panel">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title:</label>
                                            <input type="text" class="form-control" id="meta_title" placeholder="Meta Title" name="meta_title_{{ $lang->slug }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_desc">Meta Description:</label>
                                            <input type="text" class="form-control" id="meta_desc" placeholder="Meta Description" name="meta_desc_{{ $lang->slug }}">
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                            </div>

                        </div>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
