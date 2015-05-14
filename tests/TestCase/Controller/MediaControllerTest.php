<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MediaController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MediaController Test Case
 */
class MediaControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Media' => 'app.media',
        'Users' => 'app.users',
        'Roles' => 'app.roles',
        'Permissions' => 'app.permissions',
        'RolesPermissions' => 'app.roles_permissions',
        'Comments' => 'app.comments',
        'Posts' => 'app.posts',
        'Categories' => 'app.categories',
        'PostsCategories' => 'app.posts_categories',
        'Tags' => 'app.tags',
        'PostsTags' => 'app.posts_tags'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
