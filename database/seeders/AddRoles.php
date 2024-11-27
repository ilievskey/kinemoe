<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'admin',
                'can_post' => true,
                'can_comment' => true,
                'can_like' => true,
                'can_crud_other_profiles' => true,
                'can_crud_other_posts' => true,
                'can_crud_other_comments' => true,
                'can_access_admin_dash' => true,
                'can_highlight_posts' => true,
                'can_verify_others' => true,
                'can_action_others' => true,
                'can_upload_content' => true,
                'can_modify_site' => true,
            ],
            [
                'role_name' => 'moderator',
                'can_post' => true,
                'can_comment' => true,
                'can_like' => true,
                'can_crud_other_profiles' => false,
                'can_crud_other_posts' => true,
                'can_crud_other_comments' => true,
                'can_access_admin_dash' => false,
                'can_highlight_posts' => true,
                'can_verify_others' => false,
                'can_action_others' => true,
                'can_upload_content' => false,
                'can_modify_site' => false,
            ],
            [
                'role_name' => 'artist',
                'can_post' => true,
                'can_comment' => true,
                'can_like' => true,
                'can_crud_other_profiles' => false,
                'can_crud_other_posts' => false,
                'can_crud_other_comments' => false,
                'can_access_admin_dash' => false,
                'can_highlight_posts' => false,
                'can_verify_others' => false,
                'can_action_others' => false,
                'can_upload_content' => true,
                'can_modify_site' => false,
            ],
            [
                'role_name' => 'regular',
                'can_post' => true,
                'can_comment' => true,
                'can_like' => true,
                'can_crud_other_profiles' => false,
                'can_crud_other_posts' => false,
                'can_crud_other_comments' => false,
                'can_access_admin_dash' => false,
                'can_highlight_posts' => false,
                'can_verify_others' => false,
                'can_action_others' => false,
                'can_upload_content' => false,
                'can_modify_site' => false,
            ],
            [
                'role_name' => 'guest',
                'can_post' => false,
                'can_comment' => false,
                'can_like' => false,
                'can_crud_other_profiles' => false,
                'can_crud_other_posts' => false,
                'can_crud_other_comments' => false,
                'can_access_admin_dash' => false,
                'can_highlight_posts' => false,
                'can_verify_others' => false,
                'can_action_others' => false,
                'can_upload_content' => false,
                'can_modify_site' => false,
            ],
        ]);
    }
}
