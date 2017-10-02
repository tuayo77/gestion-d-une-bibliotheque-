@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Ajouter des livres</h3>
        </div>
        <div class="module-body">
            <form class="form-horizontal row-fluid">
                <div class="control-group">
                    <label class="control-label">Tritre du livre</label>
                    <div class="controls">
                        <input type="text" data-form-field="title" placeholder="Enter the title of the book here..." class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Nom de l'auteur</label>
                    <div class="controls">
                        <input type="text" data-form-field="author" placeholder="Enter the name of author for the book here..." class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="basicinput">Description du livre</label>
                    <div class="controls">
                        <textarea class="span8" data-form-field="description" rows="5" placeholder="Enter few lines about the book here"></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="basicinput">Categorie</label>
                    <div class="controls">
                        <select tabindex="1" data-form-field="category" data-placeholder="Select category.." class="span8">
                            @foreach($categories_list as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Nombres de copies</label>
                    <div class="controls">
                        <input type="number" data-form-field="number" placeholder="How many issues are there?" class="span8">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="button" class="btn btn-inverse" id="addbooks">Ajouter le livre</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>
@stop

@section('custom_bottom_script')

    <script type="text/javascript" src="{{ Config::get('view.custom.js') }}/script.addbook.js"></script>

@stop