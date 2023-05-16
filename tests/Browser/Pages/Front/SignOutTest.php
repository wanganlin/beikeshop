<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Data\Admin\LoginData;
use Tests\Data\Catalog\AccountPage;
use Tests\Data\Catalog\CataLoginData;
use Tests\Data\Catalog\LoginPage;
use Tests\DuskTestCase;
use Tests\Data\Catalog\IndexPage;

class SignOutTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     * @return void
     */

//场景1 email不合法
    public function testSignOut()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit(LoginPage::Login['login_url'])
                //1.用户登录
                ->type(LoginPage::Login['login_email'], CataLoginData::True_Login['email'])
                ->type(LoginPage::Login['login_pwd'], CataLoginData::True_Login['password'])
                ->press(LoginPage::Login['login_btn'])
                ->pause(5000)
                //2.退出
                ->click(AccountPage::Account['SignOut'])
                ->pause(3000)
                ->assertSee(CataLoginData::False_Login['false_assert']);
        });
    }
}
