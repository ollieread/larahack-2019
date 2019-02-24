<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryStatsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->statement('CREATE OR REPLACE VIEW `category_stats` (category_id, idea_count, user_count, feedback_count, feedback_user_count) AS (
  SELECT c.id, count(DISTINCT i.id), count(DISTINCT i.user_id), count(DISTINCT f.id), count(DISTINCT f.user_id)
  FROM categories c
         LEFT JOIN ideas i on c.id = i.category_id
         LEFT JOIN idea_feedback f on i.id = f.idea_id
  GROUP BY c.id
);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::getConnection()->statement('DROP VIEW IF EXISTS `category_stats`');
    }
}
