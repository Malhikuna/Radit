<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserRoleTest extends TestCase
{
    /** @test */
    public function admin_role_returns_true_for_is_admin()
    {
        $user = new User(['role' => 'admin']);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isMember());
    }

    /** @test */
    public function member_role_returns_true_for_is_member()
    {
        $user = new User(['role' => 'member']);
        $this->assertTrue($user->isMember());
        $this->assertFalse($user->isAdmin());
    }
}
