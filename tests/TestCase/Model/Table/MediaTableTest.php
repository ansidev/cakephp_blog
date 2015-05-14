<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MediaTable Test Case
 */
class MediaTableTest extends TestCase
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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Media') ? [] : ['className' => 'App\Model\Table\MediaTable'];
        $this->Media = TableRegistry::get('Media', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Media);

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
