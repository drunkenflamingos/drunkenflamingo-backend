<?php

namespace App\Form;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * ChangePassword Form.
 */
class ChangePasswordForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema
            ->addField('user_id', 'uuid')
            ->addField('current_password', 'string')
            ->addField('new_password', 'string')
            ->addField('new_password_repeat', 'string');
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        return $validator
            ->add('new_password_repeat', 'equalPasswords', [
                'rule' => ['compareWith', 'new_password'],
                'message' => __('Passwords are not equal'),
            ]);
    }

    /**
     * Defines what to execute once the From is being processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data)
    {
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->get($data['user_id']);

        if (empty($user->password)) {
            $user->password = $data['new_password'];

            $usersTable->save($user);

            return true;
        }

        $hasher = new DefaultPasswordHasher();
        if ($hasher->check($data['current_password'], $user->password)) {
            $user->password = $data['new_password'];

            $usersTable->save($user);

            return true;
        }

        return false;
    }
}
