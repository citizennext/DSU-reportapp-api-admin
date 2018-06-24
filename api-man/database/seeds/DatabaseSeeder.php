<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class DatabaseSeeder extends Seeder
{
  use Seedable;

  protected $seedersPath = __DIR__.'/';

  /**
   * Run the database seeds.
   *
   * @return void
   */

    public function run()
    {

      $this->seed('DataTypesTableSeeder');
      $this->seed('DataRowsTableSeeder');
      $this->seed('MenusTableSeeder');
      $this->seed('MenuItemsTableSeeder');
      $this->seed('RolesTableSeeder');
      $this->seed('PermissionsTableSeeder');
      $this->seed('PermissionRoleTableSeeder');
      $this->seed('SettingsTableSeeder');

      //dummy data
      $this->seed('CategoriesTableSeeder');
      $this->seed('UsersTableSeeder');
      $this->seed('PostsTableSeeder');
      $this->seed('PagesTableSeeder');
      $this->seed('TranslationsTableSeeder');
    }
}
