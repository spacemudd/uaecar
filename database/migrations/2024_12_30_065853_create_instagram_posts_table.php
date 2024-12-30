<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_instagram_posts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramPostsTable extends Migration
{
    public function up()
    {
        Schema::create('instagram_posts', function (Blueprint $table) {
            $table->id(); // عمود المفتاح الأساسي
            $table->string('url'); // عمود الرابط
            $table->timestamps(); // أعمدة التاريخ (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('instagram_posts');
    }
}
