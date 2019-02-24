<?php

use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Larahack\Entities\Ideas\Categories\Category;
use Larahack\Entities\Ideas\Categories\CategoryRepository;

class CategorySeeder extends Seeder
{
    protected $categories = [
        [
            'name'        => 'Web App',
            'slug'        => 'web-app',
            'description' => 'Home of all ideas relating to web applications as a whole.
            
A web application would be a functionality driven website, whether a SaaS app or a free to use one.',
            'children'    => [],
        ],
        [
            'name'        => 'Mobile App',
            'slug'        => 'mobile-app',
            'description' => 'Home of all ideas relating to mobile applications as a whole.
            
A mobile application would be on for Android and/or iOS, be it a game or something more.',
            'children'    => [],
        ],
        [
            'name'        => 'Software',
            'slug'        => 'software',
            'description' => 'Home of all ideas relating to software as a whole.
            
A piece of software would be either a desktop application or something that you can download and run yourself.',
            'children'    => [],
        ],
        [
            'name'        => 'Library',
            'slug'        => 'library',
            'description' => 'Home of all ideas relating to libraries as a whole.
            
A library would be a collection of code that is intended to be implemented into another codebase to provide functionality and/or features.',
            'children'    => [],
        ],
    ];

    /**
     * @var \Larahack\Entities\Ideas\Categories\CategoryRepository
     */
    private $repository;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->repository = Container::getInstance()->make(CategoryRepository::class);
        $this->seedCategories($this->categories);
    }

    private function seedCategories(array $categories, ?Category $parent = null)
    {
        foreach ($categories as $categoryData) {
            $category              = $this->repository->findOneBySlug($categoryData['slug']) ?? new Category;
            $category->name        = $categoryData['name'];
            $category->slug        = $categoryData['slug'];
            $category->description = $categoryData['description'];
            $category->active      = $categoryData['active'] ?? true;

            if ($parent) {
                $category->parent = $parent;
            }

            if ($this->repository->persist($category)) {
                if ($categoryData['children']) {
                    $this->seedCategories($categoryData['children'], $category);
                }
            }
        }
    }
}
