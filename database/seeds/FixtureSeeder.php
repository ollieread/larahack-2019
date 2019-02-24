<?php

use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Larahack\Entities\Ideas\Categories\Category;
use Larahack\Entities\Ideas\Categories\CategoryRepository;
use Larahack\Entities\Ideas\Feedback\Feedback;
use Larahack\Entities\Ideas\Feedback\FeedbackRepository;
use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Ideas\IdeaRepository;
use Larahack\Entities\Ideas\Interests\Interest;
use Larahack\Entities\Ideas\Interests\InterestRepository;
use Larahack\Entities\Users\User;
use Larahack\Entities\Users\UserRepository;

class FixtureSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $container   = Container::getInstance();
        $this->faker = \Faker\Factory::create('en_gb');

        /*$categories = $this->createCategories($container->make(CategoryRepository::class), random_int(10, 50));
        $users      = $this->createUsers($container->make(UserRepository::class), random_int(10, 50));
        $ideas      = $this->createIdeas($container->make(IdeaRepository::class), $categories, $users);
        $this->createFeedback($container->make(FeedbackRepository::class), $ideas, $users);*/
        $ideas = $container->make(IdeaRepository::class)->getAll();
        $users = $container->make(UserRepository::class)->getAll();
        $this->createInterest($container->make(InterestRepository::class), $ideas, $users);
    }

    private function createCategories(CategoryRepository $repository, int $count): Collection
    {
        $this->command->info(sprintf('Creating %s categories', $count));
        $categories = new Collection;

        for ($i = 0; $i < $count; $i++) {
            $category = (new Category)->create([
                'parent'      => $categories->count() && $this->faker->boolean ? $categories->random() : null,
                'name'        => $this->faker->words(3, true),
                'slug'        => $this->faker->slug,
                'description' => $this->faker->realText(100),
                'active'      => true,
            ]);

            if ($repository->persist($category)) {
                $categories->push($category);
                $this->command->info(sprintf('Added category %s (%s)', $category->name, $category->id));
            }
        }

        return $categories;
    }

    private function createUsers(UserRepository $repository, int $count): Collection
    {
        $this->command->info(sprintf('Creating %s users', $count));
        $users = new Collection;

        for ($i = 0; $i < $count; $i++) {
            $user = (new User)->create([
                'display_name' => $this->faker->userName,
                'first_name'   => $this->faker->firstName,
                'last_name'    => $this->faker->lastName,
                'email'        => $this->faker->email,
                'password'     => $this->faker->password,
                'active'       => true,
                'verified_at'  => \Carbon\Carbon::now(),
            ]);

            if ($repository->persist($user)) {
                $users->push($user);
                $this->command->info(sprintf('Added user %s (%s)', $user->name, $user->id));
            }
        }

        return $users;
    }

    /**
     * @param \Larahack\Entities\Ideas\IdeaRepository $repository
     * @param \Illuminate\Support\Collection          $categories
     * @param \Illuminate\Support\Collection          $users
     *
     * @return \Illuminate\Support\Collection
     */
    private function createIdeas(IdeaRepository $repository, Collection $categories, Collection $users): Collection
    {
        $ideas = new Collection;
        $categories->each(function (Category $category) use ($repository, $users, $ideas) {
            $count = random_int(5, 25);
            $this->command->info(sprintf('Creating %s ideas for category %s', $count, $category->name));

            for ($i = 0; $i < $count; $i++) {
                $user = $users->random();
                $idea = (new Idea)->create([
                    'user'     => $user,
                    'category' => $category,
                    'title'    => $this->faker->words(10, true),
                    'slug'     => $this->faker->slug,
                    'excerpt'  => $this->faker->realText(100),
                    'content'  => $this->faker->realText(500),
                    'active'   => true,
                ]);

                if ($repository->persist($idea)) {
                    $ideas->push($idea);
                    $this->command->info(sprintf('Added idea %s (%s)', $idea->title, $idea->id));
                }
            }
        });

        return $ideas;
    }

    private function createFeedback(FeedbackRepository $repository, Collection $ideas, Collection $users)
    {
        $ideas->each(function (Idea $idea) use ($repository, $users) {
            $count = random_int(5, 25);

            for ($i = 0; $i < $count; $i++) {
                $user     = $users->random();
                $feedback = (new Feedback)->create([
                    'user'    => $user,
                    'idea'    => $idea,
                    'content' => $this->faker->realText(),
                ]);
                if ($repository->persist($feedback)) {
                    $this->command->info(sprintf('Added feedback for idea %s (%s) from user %s (%s)', $idea->title, $idea->id, $user->name, $user->id));
                }
            }
        });
    }

    /**
     * @param \Larahack\Entities\Ideas\Interests\InterestRepository $repository
     * @param \Illuminate\Support\Collection                        $ideas
     * @param \Illuminate\Support\Collection                        $users
     */
    private function createInterest(InterestRepository $repository, Collection $ideas, Collection $users)
    {
        $ideas->each(function (Idea $idea) use ($users, $repository) {
            $ideaUsers = $users->random(random_int(1, $users->count()));

            $ideaUsers->each(function (User $user) use ($idea, $repository) {
                $interest = (new Interest)->create([
                    'idea'             => $idea,
                    'user'             => $user,
                    'would_pay'        => $this->faker->boolean,
                    'would_newsletter' => $this->faker->boolean,
                    'subscribe'        => $this->faker->boolean,
                ]);
                if ($repository->persist($interest)) {
                    $this->command->info(sprintf('Added interest for idea %s (%s) from user %s (%s)', $idea->title, $idea->id, $user->name, $user->id));
                }
            });
        });
    }
}
