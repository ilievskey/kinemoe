<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');

            $table->boolean('can_post')->default(false);
            $table->boolean('can_comment')->default(false);
            $table->boolean('can_like')->default(false);
            
            $table->boolean('can_crud_other_profiles')->default(false);
            $table->boolean('can_crud_other_posts')->default(false);
            $table->boolean('can_crud_other_comments')->default(false);

            $table->boolean('can_access_admin_dash')->default(false);
            $table->boolean('can_highlight_posts')->default(false);
            $table->boolean('can_verify_others')->default(false);
            $table->boolean('can_action_others')->default(false);
            $table->boolean('can_upload_content')->default(false);

            $table->boolean('can_modify_site')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
