<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        Permission::create(['name' => 'Edit Client']);
        Permission::create(['name' => 'Client Notification Reminder Toggle']);
        Permission::create(['name' => 'Client Visa Application Status']);
        Permission::create(['name' => 'Client Documents Movement']);

        Permission::create(['name' => 'View Employees']);
        Permission::create(['name' => 'Edit Employee']);
        Permission::create(['name' => 'Letter To Employee']);
        Permission::create(['name' => 'Assign Tasks To Employee']);
        Permission::create(['name' => 'Activate/Deactivate Employee']);
        Permission::create(['name' => 'Employee Attendance Status']);
        Permission::create(['name' => 'Employee Salary Slip']);
        Permission::create(['name' => 'Staff Wage management']);

        Permission::create(['name' => 'Expense Entry']);
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

        Permission::create(['name' => 'View/Export Reports']);

        Permission::create(['name' => 'Assigments']);

        Permission::create(['name' => 'Generate Letter']);

        Permission::create(['name' => 'Direct Chat']);

        Permission::create(['name' => 'Services Registration']);

        Permission::create(['name' => 'Airlines Name Registration']);
        
    }
}
