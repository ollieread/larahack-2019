<?php

return [

    'mappers' => [
        \Larahack\Entities\Users\UserMapper::class,
        \Larahack\Entities\Ideas\Categories\CategoryMapper::class,
        \Larahack\Entities\Ideas\Tags\TagMapper::class,
        \Larahack\Entities\Ideas\IdeaMapper::class,
        \Larahack\Entities\Ideas\Feedback\FeedbackMapper::class,
    ],

    'attributes' => [
        'bool'      => \Sprocketbox\Articulate\Attributes\BoolAttribute::class,
        'entity'    => \Sprocketbox\Articulate\Attributes\EntityAttribute::class,
        'int'       => \Sprocketbox\Articulate\Attributes\IntAttribute::class,
        'json'      => \Sprocketbox\Articulate\Attributes\JsonAttribute::class,
        'string'    => \Sprocketbox\Articulate\Attributes\StringAttribute::class,
        'timestamp' => \Sprocketbox\Articulate\Attributes\TimestampAttribute::class,
        'float'     => \Sprocketbox\Articulate\Attributes\FloatAttribute::class,
        'text'      => \Sprocketbox\Articulate\Attributes\TextAttribute::class,
        'array'     => \Sprocketbox\Articulate\Attributes\ArrayAttribute::class,
        'uuid'      => \Sprocketbox\Articulate\Attributes\UuidAttribute::class,
    ],

    'sources' => [
        \Sprocketbox\Articulate\Sources\Illuminate\Source::class,
    ],

];