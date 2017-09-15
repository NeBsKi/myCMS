<?php use App\Http\Controllers\admin\PageController; ?>

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
                    <button type="submit" class="btn btn-success btnUpdate">შენახვა</button>
                </li>
                <li>
                  <a href="{{ url('admin/page/destroy/'.$page->id) }}">
                    <button type="submit" class="btn btn-danger btnDeleteInside">წაშლა</button>
                  </a>
                </li>
              </ul>
            </div>
            <div class="container">
                <div class="row">
                    
                    
                    {{ Form::model($page, ['route' => ['admin.page.update', $page->id], 'method' => 'POST', 'id' => 'updateForm']) }}
                    
                        <div class="post-body">

                            <div id="tabs">
                                <ul>
                                  @foreach ($languages as $lang)
                                       <li><a href="#{{ $lang->slug }}">{{ $lang->title }}</a></li>
                                  @endforeach
                                </ul>
                                
                                @foreach ($languages as $lang)
                                <div id="{{ $lang->slug }}">
                   
                                    <input type="hidden" name="lang_id_{{ $lang->slug }}" value="{{ $lang->slug }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group">
                                        <label for="title">სათაური:</label>
                                        <input type="text" class="form-control" id="title" placeholder="სათაური" name="title_{{ $lang->slug }}" value="{{ PageController::dataPages('title', $page->id, $lang->slug) }}">
                                    </div>
                                    @if ($lang->slug == 'ge')
                                    <div class="form-group">
                                        <label for="parent_id">გვერდები:</label>
                                        <select name="parent_id" class="form-control" id="parent_id">
                                          <option value="0">- აირჩიეთ გვერდი</option>
                                          {!! data_for_select_tree_edit('parent_id', $pages, $page->parent_id) !!}
                                        </select>
                                    </div> 
                                    @endif
                                    <div class="form-group">
                                        <label for="body">ტექსტი:</label>
                                        <textarea class="form-control" id="body" placeholder="ტექსტი" name="body_{{ $lang->slug }}">{{ PageController::dataPages('body', $page->id, $lang->slug) }}</textarea>
                                    </div>
                                    
                                    @if ($lang->slug == 'ge')
                                    <h1 class="settings-heading">Settings</h1>
                                    <div class="settings-panel">
                                        <div class="form-group">
                                            <label for="filter">Filter:</label>
                                            <input type="text" class="form-control" id="filter" placeholder="Filter" name="filter" value="{{ $page->filter }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug:</label>
                                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{ $page->slug }}">
                                        </div>
                                    </div>
                                    @endif


                                    <h1 class="meta-heading">Meta Information</h1>
                                    <div class="meta-panel">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title:</label>
                                            <input type="text" class="form-control" id="meta_title" placeholder="Meta Title" name="meta_title_{{ $lang->slug }}" value="{{ PageController::dataPages('meta_title', $page->id, $lang->slug) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_desc">Meta Description:</label>
                                            <input type="text" class="form-control" id="meta_desc" placeholder="Meta Description" name="meta_desc_{{ $lang->slug }}" value="{{ PageController::dataPages('meta_desc', $page->id, $lang->slug) }}">
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                            </div>

                        </div>
                    
                    {{ Form::close() }}

                </div>
                
                <div class="row">
                    <div class="post-body">
                        <form action="{{ url('/admin/page/gallery/'.$page->id) }}"
                              class="dropzone"
                              method="post"
                              id="addPagesGallery"
                              enctype="multipart/form-data"
                        >

                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row">
                    <div class="post-body">
                        @foreach ($gallery as $image)
                            <div class="col-xs-6 col-md-3">
                                <a href="#" class="thumbnail">
                                  <img src='{{ asset($image->path) }}' alt=''>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection


