<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriesTable Test Case
 */
class CategoriesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Categories' => 'app.categories',
        'Posts' => 'app.posts',
        'Users' => 'app.users',
        'Roles' => 'app.roles',
        'Permissions' => 'app.permissions',
        'RolesPermissions' => 'app.roles_permissions',
        'Comments' => 'app.comments',
        'Media' => 'app.media',
        'Queries' => 'app.queries',
        'PostsCategories' => 'app.posts_categories',
        'Tags' => 'app.tags',
        'PostsTags' => 'app.posts_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Categories') ? [] : ['className' => 'App\Model\Table\CategoriesTable'];
        $this->Categories = TableRegistry::get('Categories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Categories);

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
