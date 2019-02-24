@extends('layouts.main')

@section('content')
    <main class="content content--center">
        <form action="{{ route('idea:store') }}" method="post">
            {!! csrf_field() !!}
            <section class="box">

                <header class="box__header--primary">
                    Add Your Idea
                </header>

                <main class="box__content">
                    <div class="field__container">
                        <label for="idea-title" class="field__label">Title</label>
                        <input type="text"
                               class="field__input {{ $errors->has('title') ? 'field__input--invalid' : '' }}"
                               name="title" id="idea-title" value="{{ old('title') }}">
                        {!! $errors->first('title', '<div class="field__feedback">:message</div>') !!}
                        <div class="field__feedback">
                            The title needs to describe enough to draw peoples attention, but not so much that it's too
                            long.
                        </div>
                    </div>

                    <div class="field__container">
                        <label for="idea-category" class="field__label">Category</label>
                        <select class="field__input {{ $errors->has('category') ? 'field__input--invalid' : '' }}"
                                name="category" id="idea-category">
                            <option value="">Select One</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('category', '<div class="field__feedback">:message</div>') !!}
                        <div class="field__feedback">
                            Categories are used to roughly categorise ideas.
                        </div>
                    </div>

                    <div class="field__container">
                        <label for="idea-excerpt" class="field__label">Excerpt</label>
                        <textarea class="field__input {{ $errors->has('excerpt') ? 'field__input--invalid' : '' }}"
                                  name="excerpt" id="idea-excerpt" rows="5">{{ old('excerpt') }}</textarea>
                        {!! $errors->first('excerpt', '<div class="field__feedback">:message</div>') !!}
                        <div class="field__feedback">
                            The excerpt is a short description used on listing pages. It's longer than a title, but shorter than content.
                        </div>
                    </div>

                    <div class="field__container">
                        <label for="idea-content" class="field__label">Content</label>
                        <textarea class="field__input {{ $errors->has('content') ? 'field__input--invalid' : '' }}"
                                  name="content" id="idea-content" rows="10">{{ old('content') }}</textarea>
                        {!! $errors->first('content', '<div class="field__feedback">:message</div>') !!}
                        <div class="field__feedback">
                            Describe your idea in as much detail as possible. You can use markdown for formatting.
                        </div>
                    </div>
                </main>

                <footer class="box__footer--secondary box__footer">
                    <button type="submit" class="button button--large">
                        <i class="button__icon fas fa-check fa-fw"></i>
                        Post
                    </button>
                </footer>
            </section>

            </section>
        </form>
    </main>
    </div>
@endsection