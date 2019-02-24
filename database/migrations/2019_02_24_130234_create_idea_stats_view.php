<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateIdeaStatsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->statement('CREATE OR REPLACE VIEW `idea_stats` (idea_id, feedback_count, interest_count, would_pay_count,
                                     would_newsletter_count) AS (
  SELECT i.id,
       count(DISTINCT f.id),
       IFNULL(ii.total, 0),
       IFNULL(ii.would_pay, 0),
       IFNULL(ii.would_newsletter, 0)
FROM ideas i
       LEFT JOIN idea_feedback f on i.id = f.idea_id
       LEFT JOIN (SELECT count(idea_interest.id)             total,
                         idea_interest.idea_id,
                         SUM(idea_interest.would_pay)        would_pay,
                         SUM(idea_interest.would_newsletter) would_newsletter
                  FROM idea_interest
                  GROUP BY idea_interest.idea_id) ii on i.id = ii.idea_id
GROUP BY f.idea_id
);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::getConnection()->statement('DROP VIEW IF EXISTS `idea_stats`');
    }
}
