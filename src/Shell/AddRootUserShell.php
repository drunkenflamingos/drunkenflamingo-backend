<?php

namespace App\Shell;

use Cake\Console\Shell;

/**
 * AddRootUser shell command.
 */
class AddRootUserShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());

        $this->loadModel('Users');
        $this->loadModel('Roles');
        $this->loadModel('Organizations');

        $ownerRole = $this->Roles->findByIdentifier('teacher_admin')->firstOrFail();
        $teacherRole = $this->Roles->findByIdentifier('teacher')->firstOrFail();
        $studentRole = $this->Roles->findByIdentifier('student')->firstOrFail();

        $personName = $this->in('Name?');
        $email = $this->in('Email?');
        $password = $this->in('Password?');
        $organizationName = $this->in('Organization name?');

        $user = $this->Users->newEntity([
            'name' => $personName,
            'email' => $email,
            'password' => $password,
            'is_root' => true,
        ]);

        $this->Users->save($user);

        $organization = $this->Users->Organizations->newEntity([
            'name' => $organizationName,
        ]);

        $this->Users->Organizations->save($organization);

        //Teacher admin
        $userRole = $this->Users->UsersRoles->newEntity([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role_id' => $ownerRole->id,
        ]);

        $this->Users->UsersRoles->save($userRole);

        //Teacher
        $userRole = $this->Users->UsersRoles->newEntity([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role_id' => $teacherRole->id,
        ]);

        $this->Users->UsersRoles->save($userRole);

        //Student
        $userRole = $this->Users->UsersRoles->newEntity([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role_id' => $studentRole->id,
        ]);

        $this->Users->UsersRoles->save($userRole);


        $this->success('User made with success');
    }
}
