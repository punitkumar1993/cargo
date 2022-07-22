<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // posts
        $read_posts = Permission::create(['name' => 'read-posts', 'alias' => 'read-posts']);
        $add_posts = Permission::create(['name' => 'add-posts', 'alias' => 'add-posts']);
        $update_posts = Permission::create(['name' => 'update-posts', 'alias' => 'update-posts']);
        $delete_posts = Permission::create(['name' => 'delete-posts', 'alias' => 'delete-posts']);

        // categories
        $read_categories = Permission::create(['name' => 'read-categories', 'alias' => 'read-categories']);
        $add_categories = Permission::create(['name' => 'add-categories', 'alias' => 'add-categories']);
        $update_categories = Permission::create(['name' => 'update-categories', 'alias' => 'update-categories']);
        $delete_categories = Permission::create(['name' => 'delete-categories', 'alias' => 'delete-categories']);

        // tags
        $read_tags = Permission::create(['name' => 'read-tags', 'alias' => 'read-tags']);
        $add_tags = Permission::create(['name' => 'add-tags', 'alias' => 'add-tags']);
        $update_tags = Permission::create(['name' => 'update-tags', 'alias' => 'update-tags']);
        $delete_tags = Permission::create(['name' => 'delete-tags', 'alias' => 'delete-tags']);

        // pages
        $read_pages = Permission::create(['name' => 'read-pages', 'alias' => 'read-pages']);
        $add_pages = Permission::create(['name' => 'add-pages', 'alias' => 'add-pages']);
        $update_pages = Permission::create(['name' => 'update-pages', 'alias' => 'update-pages']);
        $delete_pages = Permission::create(['name' => 'delete-pages', 'alias' => 'delete-pages']);

        // contacts
        $read_contacts = Permission::create(['name' => 'read-contacts', 'alias' => 'read-contacts']);
        $add_contacts = Permission::create(['name' => 'add-contacts', 'alias' => 'add-contacts']);
        $update_contacts = Permission::create(['name' => 'update-contacts', 'alias' => 'update-contacts']);
        $delete_contacts = Permission::create(['name' => 'delete-contacts', 'alias' => 'delete-contacts']);

        // menus
        $read_menus = Permission::create(['name' => 'read-menus', 'alias' => 'read-menus']);
        $add_menus = Permission::create(['name' => 'add-menus', 'alias' => 'add-menus']);
        $update_menus = Permission::create(['name' => 'update-menus', 'alias' => 'update-menus']);
        $delete_menus = Permission::create(['name' => 'delete-menus', 'alias' => 'delete-menus']);

        // galleries
        $read_galleries = Permission::create(['name' => 'read-galleries', 'alias' => 'read-galleries']);
        $add_galleries = Permission::create(['name' => 'add-galleries', 'alias' => 'add-galleries']);
        $update_galleries = Permission::create(['name' => 'update-galleries', 'alias' => 'update-galleries']);
        $delete_galleries = Permission::create(['name' => 'delete-galleries', 'alias' => 'delete-galleries']);

        // filemanager
        $read_filemanager = Permission::create(['name' => 'read-filemanager', 'alias' => 'read-filemanager']);
        $add_filemanager = Permission::create(['name' => 'add-filemanager', 'alias' => 'add-filemanager']);
        $update_filemanager = Permission::create(['name' => 'update-filemanager', 'alias' => 'update-filemanager']);
        $delete_filemanager = Permission::create(['name' => 'delete-filemanager', 'alias' => 'delete-filemanager']);

        // ad
        $read_ad = Permission::create(['name' => 'read-ad', 'alias' => 'read-ad']);
        $add_ad = Permission::create(['name' => 'add-ad', 'alias' => 'add-ad']);
        $update_ad = Permission::create(['name' => 'update-ad', 'alias' => 'update-ad']);
        $delete_ad = Permission::create(['name' => 'delete-ad', 'alias' => 'delete-ad']);

        // video youtube
        $read_yt = Permission::create(['name' => 'read-video-youtube', 'alias' => 'read-video-youtube']);
        $add_yt = Permission::create(['name' => 'add-video-youtube', 'alias' => 'add-video-youtube']);
        $update_yt = Permission::create(['name' => 'update-video-youtube', 'alias' => 'update-video-youtube']);
        $delete_yt = Permission::create(['name' => 'delete-video-youtube', 'alias' => 'delete-video-youtube']);

        // users
        $read_users = Permission::create(['name' => 'read-users', 'alias' => 'read-users']);
        $add_users = Permission::create(['name' => 'add-users', 'alias' => 'add-users']);
        $update_users = Permission::create(['name' => 'update-users', 'alias' => 'update-users']);
        $delete_users = Permission::create(['name' => 'delete-users', 'alias' => 'delete-users']);

        // roles
        $read_roles = Permission::create(['name' => 'read-roles', 'alias' => 'read-roles']);
        $add_roles = Permission::create(['name' => 'add-roles', 'alias' => 'add-roles']);
        $update_roles = Permission::create(['name' => 'update-roles', 'alias' => 'update-roles']);
        $delete_roles = Permission::create(['name' => 'delete-roles', 'alias' => 'delete-roles']);

        // permissions
        $read_permissions = Permission::create(['name' => 'read-permissions', 'alias' => 'read-permissions']);
        $add_permissions = Permission::create(['name' => 'add-permissions', 'alias' => 'add-permissions']);
        $update_permissions = Permission::create(['name' => 'update-permissions', 'alias' => 'update-permissions']);
        $delete_permissions = Permission::create(['name' => 'delete-permissions', 'alias' => 'delete-permissions']);

        // social-media
        $read_social_media = Permission::create(['name' => 'read-social-media', 'alias' => 'read-social-media']);
        $add_social_media = Permission::create(['name' => 'add-social-media', 'alias' => 'add-social-media']);
        $update_social_media = Permission::create(['name' => 'update-social-media', 'alias' => 'update-social-media']);
        $delete_social_media = Permission::create(['name' => 'delete-social-media', 'alias' => 'delete-social-media']);

        // settings
        $read_settings = Permission::create(['name' => 'read-settings', 'alias' => 'read-settings']);
        $add_settings = Permission::create(['name' => 'add-settings', 'alias' => 'add-settings']);
        $update_settings = Permission::create(['name' => 'update-settings', 'alias' => 'update-settings']);
        $delete_settings = Permission::create(['name' => 'delete-settings', 'alias' => 'delete-settings']);

        // env
        $read_env = Permission::create(['name' => 'read-env', 'alias' => 'read-env']);
        $add_env = Permission::create(['name' => 'add-env', 'alias' => 'add-env']);
        $update_env = Permission::create(['name' => 'update-env', 'alias' => 'update-env']);
        $delete_env = Permission::create(['name' => 'delete-env', 'alias' => 'delete-env']);

        // Role 
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleSuperAdmin->givePermissionTo(Permission::all());

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all()->except([61, 62, 63, 64]));

        $roleMember = Role::create(['name' => 'member']);
        $roleMember->givePermissionTo($read_posts);
        $roleMember->givePermissionTo($add_posts);
        $roleMember->givePermissionTo($update_posts);
        $roleMember->givePermissionTo($delete_posts);
        $roleMember->givePermissionTo($update_users);
    }
}
