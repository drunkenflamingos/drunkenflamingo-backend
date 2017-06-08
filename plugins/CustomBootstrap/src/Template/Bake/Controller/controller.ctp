<%
use Cake\Utility\Inflector;

$defaultModel = $name;
%>
<?php
declare(strict_types=1);
namespace <%= $namespace %>\Controller<%= $prefix %>;

use <%= $namespace %>\Controller\AppController;

/**
 * <%= $name %> Controller
 *
 * @property \<%= $namespace %>\Model\Table\<%= $defaultModel %>Table $<%= $defaultModel %>
<%
foreach ($components as $component):
$classInfo = $this->Bake->classInfo($component, 'Controller/Component', 'Component');
%>
 * @property <%= $classInfo['fqn'] %> $<%= $classInfo['name'] %>
<% endforeach; %>
 */
class <%= $name %>Controller extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
    }

    <% echo $this->Bake->arrayProperty('helpers', $helpers, ['indent' => false]);
    echo $this->Bake->arrayProperty('components', $components, ['indent' => false]);
    foreach ($actions as $action) {
        echo $this->element('Controller/' . $action);
    } %>
}



