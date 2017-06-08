<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\Datasource\RulesChecker;
use Cake\Event\Event;
use Cake\ORM\Behavior;

/**
 * CreatedBy behavior
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBy
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBy
 */
class CreatedModifiedByBehavior extends Behavior
{

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

    public function buildRules(Event $event, RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));
        $rules->add($rules->existsIn(['modified_by_id'], 'ModifiedBy'));

        return $rules;
    }
}
