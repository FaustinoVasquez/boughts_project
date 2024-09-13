<?php
/**
 * Created by PhpStorm.
 * User: fvasquez
 * Date: 14/01/19
 * Time: 02:56 PM
 */

namespace Tests;


use App\User;

trait TestHelpers
{
    protected $user;
    protected $adminUser;
    protected $employeeUser;

    public function createUser(array $attr=[])
    {
        if ($this->user) {
            return $this->user;
        }
        $this->user = User::create($attr);
        return $this->user;
    }

    public function employeeUser()
    {
        if ($this->employeeUser) {
            return $this->employeeUser;
        }
        $this->employeeUser = factory(User::class)->create([
            'role'=>'employee'
        ]);
        return $this->employeeUser;
    }


    public function adminUser()
    {
        if ($this->adminUser) {
            return $this->adminUser;
        }
        $this->adminUser = factory(User::class)->create([
            'role'=>'admin'
        ]);
        return $this->adminUser;
    }
}