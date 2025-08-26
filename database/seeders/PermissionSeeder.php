<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


        $insertsData = [
            ['name' => 'manage_dashboard', 'name_slug'=>'manage-dasboard'],
            ['name' => 'dashboard_total_admin_user', 'name_slug'=>'dashboard-total-admin-user'],
            ['name' => 'dashboard_total_user', 'name_slug'=>'dashboard-total-user'],
            ['name' => 'dashboard_total_users', 'name_slug'=>'dashboard-total-users'],
            ['name' => 'dashboard_total_roles', 'name_slug'=>'dashboard-total-roles'],
            ['name' => 'dashboard_total_permissions', 'name_slug'=>'dashboard-total-permissions'],
        
            
            ['name' => 'manage_roles', 'name_slug'=>'manage-roles'],
            ['name' => 'create_roles', 'name_slug'=>'create-roles'],
            ['name' => 'edit_roles', 'name_slug'=>'edit-roles'],
            ['name' => 'delete_roles', 'name_slug'=>'delete-roles'],
            ['name' => 'show_roles', 'name_slug'=>'show-roles'],

            ['name' => 'manage_permissions', 'name_slug'=>'manage-permissions'],
            ['name' => 'create_permissions', 'name_slug'=>'create-permissions'],
            ['name' => 'edit_permissions', 'name_slug'=>'edit-permissions'],
            ['name' => 'delete_permissions', 'name_slug'=>'delete-permissions'],
            ['name' => 'show_permissions', 'name_slug'=>'show-permissions'],

            ['name' => 'manage_users', 'name_slug'=>'manage-users'],
            ['name' => 'create_users', 'name_slug'=>'create-users'],
            ['name' => 'edit_users', 'name_slug'=>'edit-users'],
            ['name' => 'delete_users', 'name_slug'=>'delete-users'],
            ['name' => 'show_users', 'name_slug'=>'show-users'],


            ['name' => 'manage_location', 'name_slug'=>'manage-location'],
            ['name' => 'manage_state', 'name_slug'=>'manage-state'],
            ['name' => 'create_state', 'name_slug'=>'create-state'],
            ['name' => 'edit_state', 'name_slug'=>'edit-state'],
            ['name' => 'delete_state', 'name_slug'=>'delete-state'],
            ['name' => 'show_state', 'name_slug'=>'show-state'],
            

            ['name' => 'manage_service', 'name_slug'=>'manage-service'],
            ['name' => 'create_service', 'name_slug'=>'create-service'],
            ['name' => 'edit_service', 'name_slug'=>'edit-service'],
            ['name' => 'delete_service', 'name_slug'=>'delete-service'],
            ['name' => 'show_service', 'name_slug'=>'show-service'],

            // here is new 
            
                ['name' => 'show_sub_services', 'name_slug' => 'subServices'],
                ['name' => 'create_sub_services', 'name_slug' => 'create-sub-services'],
                ['name' => 'edit_sub_services', 'name_slug' => 'subServices.edit'],

                ['name' => 'show_statement', 'name_slug' => 'statement'],
                ['name' => 'create_statement', 'name_slug' => 'create-statement'],
                ['name' => 'edit_statement', 'name_slug' => 'statements.edit'],
                ['name' => 'save_statement', 'name_slug' => 'save.statement-work'],
                ['name' => 'delete_statement', 'name_slug' => 'statements.destroy'],

                ['name' => 'show_initial_payment_setting', 'name_slug' => 'initial-payment-setting'],
                ['name' => 'create_initial_payment_setting', 'name_slug' => 'create-initial-payment-setting'],
                ['name' => 'edit_initial_payment_setting', 'name_slug' => 'initial-payment-settings.edit'],
                ['name' => 'store_initial_payment_setting', 'name_slug' => 'initial-payment-settings.store'],
                ['name' => 'delete_initial_payment_setting', 'name_slug' => 'initial-payment-settings.destroy'],

                ['name' => 'show_gst_rate', 'name_slug' => 'gst.rate'],
                ['name' => 'create_gst_rate', 'name_slug' => 'create-gst-rate'],
                ['name' => 'edit_gst_rate', 'name_slug' => 'gst-rates.edit'],
                ['name' => 'store_gst_rate', 'name_slug' => 'gst-rates.store'],
                ['name' => 'delete_gst_rate', 'name_slug' => 'gst-rates.destroy'],

                ['name' => 'show_user_profile', 'name_slug' => 'user.profile'],
                ['name' => 'create_user_profile', 'name_slug' => 'create-user-profile'],
                ['name' => 'edit_user_profile', 'name_slug' => 'user-profiles.edit'],
                ['name' => 'store_user_profile', 'name_slug' => 'store.user.profile'],
                ['name' => 'delete_user_profile', 'name_slug' => 'user-profiles.delete'],
                ['name' => 'show_payments', 'name_slug' => 'payments'],

                ['name' => 'show_currency', 'name_slug' => 'currency'],
                ['name' => 'store_currency', 'name_slug' => 'store.currency'],
                ['name' => 'delete_currency', 'name_slug' => 'currencies.destroy'],

                ['name' => 'store_files', 'name_slug' => 'allfiles.store'],

                ['name' => 'store_user', 'name_slug' => 'users.store'],

                ['name' => 'store_sub_services', 'name_slug' => 'subservices.store'],
                ['name' => 'delete_sub_services', 'name_slug' => 'subservices.destroy'],

                ['name' => 'show_projects', 'name_slug' => 'projects'],
                ['name' => 'show_booking', 'name_slug' => 'booking'],
                ['name' => 'update_project_status', 'name_slug' => 'projects.update-status'],
                ['name' => 'project_details', 'name_slug' => 'projects-details'],

                ['name' => 'store_milestone', 'name_slug' => 'milestone.store'],
                ['name' => 'store_task', 'name_slug' => 'task.create'],

                ['name' => 'assign_account_manager', 'name_slug' => 'assign.accountmanager'],
                ['name' => 'assign_employee', 'name_slug' => 'assign.employee'],

                ['name' => 'show_country', 'name_slug' => 'country'],
                ['name' => 'create_country', 'name_slug' => 'create.country'],
                ['name' => 'edit_country', 'name_slug' => 'edit.country'],
                ['name' => 'store_country', 'name_slug' => 'store.country'],
                ['name' => 'delete_country', 'name_slug' => 'countries.destroy'],
            



            
           
        ];


        

        foreach ($insertsData as $insertData) {
            $existingData = Permission::where('name', $insertData['name'])->first();

            if (!$existingData) {
                Permission::create($insertData);
                $this->command->info("Permission '{$insertData['name']}' inserted successfully.");
            } else {
                $this->command->info("Permission '{$insertData['name']}' already exists. Skipping insertion.");
            }
        }
    }
}
