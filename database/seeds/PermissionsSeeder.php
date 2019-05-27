<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'View Users']);

        Permission::create(['name' => 'View Clients']);
        Permission::create(['name' => 'Create Client']);
        Permission::create(['name' => 'Edit Client']);
        Permission::create(['name' => 'Client Notification Reminder Toggle']);
        Permission::create(['name' => 'Client Visa Application Status']);
        Permission::create(['name' => 'Client Documents Movement']);

        Permission::create(['name' => 'View Employees']);
        Permission::create(['name' => 'Create Employee']);
        Permission::create(['name' => 'Edit Employee']);
        Permission::create(['name' => 'Letter To Employee']);
        Permission::create(['name' => 'Activate/Deactivate Employee']);
        Permission::create(['name' => 'Employee Attendance Status']);
        Permission::create(['name' => 'Employee Salary Slip']);
        Permission::create(['name' => 'Staff Wage management']);

        Permission::create(['name' => 'Expense Entry']);
        Permission::create(['name' => 'Delete Expense']);
        Permission::create(['name' => 'Auto Deduction Expense Entry']);

        Permission::create(['name' => 'View Invoices']);
        Permission::create(['name' => 'Generate Invoice']);
        Permission::create(['name' => 'Edit Invoice']);
        Permission::create(['name' => 'Pay Invoice']);
        Permission::create(['name' => 'Cancel Invoice']);
        Permission::create(['name' => 'View Canceled Invoice']);
        Permission::create(['name' => 'Restore Invoice']);
        Permission::create(['name' => 'Send Reminder For Unpaid Invoice']);

        Permission::create(['name' => 'VAT Updation']);

        Permission::create(['name' => 'Role Management']);

        Permission::create(['name' => 'View/Export Reports']);

        Permission::create(['name' => 'Generate Letter']);

        Permission::create(['name' => 'Direct Chat']);

        Permission::create(['name' => 'Services Registration']);

        Permission::create(['name' => 'Airlines Name Registration']);

        Permission::create(['name' => 'View Departments']);



        $role_admin = Role::create(['name'=>'Admin']);
        $role_admin->givePermissionTo('View Users');
        $role_admin->givePermissionTo('View Clients');
        $role_admin->givePermissionTo('Create Client');
        $role_admin->givePermissionTo('Edit Client');
        $role_admin->givePermissionTo('Client Notification Reminder Toggle');
        $role_admin->givePermissionTo('Client Visa Application Status');
        $role_admin->givePermissionTo('Client Documents Movement');
        $role_admin->givePermissionTo('View Employees');
        $role_admin->givePermissionTo('Create Employee');
        $role_admin->givePermissionTo('Edit Employee');
        $role_admin->givePermissionTo('Letter To Employee');
        $role_admin->givePermissionTo('Activate/Deactivate Employee');
        $role_admin->givePermissionTo('Employee Attendance Status');
        $role_admin->givePermissionTo('Employee Salary Slip');
        $role_admin->givePermissionTo('Staff Wage management');
        $role_admin->givePermissionTo('Expense Entry');
        $role_admin->givePermissionTo('Delete Expense');
        $role_admin->givePermissionTo('Auto Deduction Expense Entry');
        $role_admin->givePermissionTo('View Invoices');
        $role_admin->givePermissionTo('Generate Invoice');
        $role_admin->givePermissionTo('Edit Invoice');
        $role_admin->givePermissionTo('Pay Invoice');
        $role_admin->givePermissionTo('Cancel Invoice');
        $role_admin->givePermissionTo('View Canceled Invoice');
        $role_admin->givePermissionTo('Restore Invoice');
        $role_admin->givePermissionTo('Send Reminder For Unpaid Invoice');
        $role_admin->givePermissionTo('VAT Updation');
        $role_admin->givePermissionTo('View/Export Reports');
        $role_admin->givePermissionTo('Generate Letter');
        $role_admin->givePermissionTo('Role Management');
        $role_admin->givePermissionTo('Direct Chat');
        $role_admin->givePermissionTo('Services Registration');
        $role_admin->givePermissionTo('Airlines Name Registration');
        $role_admin->givePermissionTo('View Departments');

        User::find(1)->assignRole('Admin');
        User::find(2)->assignRole('Admin');

        $role_account_manager = Role::create(['name'=>'Account Manager']);
        $role_account_executive = Role::create(['name'=>'Account Executive']);

        $role_marketing_manager = Role::create(['name'=>'Marketing-Sales Manager']);
        $role_marketing_executive = Role::create(['name'=>'Marketing-sales Executive']);

        $role_hrd_manager = Role::create(['name'=>'HRD Manager']);
        $role_hrd_executive = Role::create(['name'=>'HRD Executive']);

        $role_operations_manager = Role::create(['name'=>'Operations Manager']);
        $role_operations_Executive = Role::create(['name'=>'Operations Executive']);
        
        $role_pso = Role::create(['name'=>'PSO']);
    }
}
