@extends('layouts.main')

@section('content')
    <div class="grid--horizontal">
        <main class="content content--center">
            <section class="box">
                <header class="box__header">
                    Ideas
                </header>
                <main class="box__content">
                    @foreach ($ideas as $idea)
                        <div class="box__item">
                            <a href="{{ route('idea:view', $idea->slug) }}" class="item--link item--options item--cta">
                                <div class="item__title">
                                    {{ $idea->title }}
                                </div>
                                <div class="item__description">
                                    {{ $idea->excerpt }}
                                </div>
                            </a>
                            <div class="item__controls">
                                <a href="#" class="button item__control">
                                    <i class="button__icon fas fa-comments fa-fw"></i>
                                    {{ $idea->stats->feedbackCount }}
                                </a>
                                <a href="{{ route('category:view', $idea->category->slug) }}"
                                   class="item__info item__control">
                                    <i class="item__info-icon far fa-folder fa-fw"></i>
                                    {{ $idea->category->name }}
                                </a>
                                <time class="item__info item__control">
                                    <i class="item__info-icon far fa-clock fa-fw"></i>
                                    {{ $idea->createdAt->format('jS F Y \a\t g:ia') }}
                                </time>
                            </div>
                            <div class="item__cta">
                                <a href="#" class="item__cta-button">
                                    <i class="item__cta-button-icon fas fa-thumbs-up fa-fw"></i>
                                    {{ $idea->stats->interestCount }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </main>
            </section>

            {{ $ideas->links('components.pagination') }}
        </main>
    </div>
@endsection