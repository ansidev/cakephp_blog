<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostsTagsTable Test Case
 */
class PostsTagsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'PostsTags' => 'app.posts_tags',
        'Posts' => 'app.posts',
        'Users' => 'app.users',
        'Roles' => 'app.roles',
        'Permissions' => 'app.permissions',
        'RolesPermissions' => 'app.roles_permissions',
        'Comments' => 'app.comments',
        'Categories' => 'app.categories',
        'PostsCategories' => 'app.posts_categories',
        'Tags' => 'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PostsTags') ? [] : ['className' => 'App\Model\Table\PostsTagsTable'];
        $this->PostsTags = TableRegistry::get('PostsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostsTags);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
