<?php

namespace App\Model\Behavior;

use Cake\Datasource\RulesChecker;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * CreatedBy behavior
 */
class CreatedModifiedByBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->_table->belongsTo('CreatedBy', [
            'foreignKey' => 'created_by_id',
            'joinType' => 'INNER',
            'className' => 'users',
            'finder' => 'withTrashed',
        ]);

        $this->_table->belongsTo('ModifiedBy', [
            'foreignKey' => 'modified_by_id',
            'joinType' => 'INNER',
            'className' => 'users',
            'finder' => 'withTrashed',
        ]);
    }

    public function buildRules(Event $event, RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));
        $rules->add($rules->existsIn(['modified_by_id'], 'ModifiedBy'));

        return $rules;
    }
}
