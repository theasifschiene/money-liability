<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

public function up()
{
Schema::table('users', function (Blueprint $table) {
$table->boolean('notifications_enabled')->default(true);
$table->string('push_token')->nullable();
});
}

public function down()
{
Schema::table('users', function (Blueprint $table) {
$table->dropColumn(['notifications_enabled','push_token']);
});
}

};