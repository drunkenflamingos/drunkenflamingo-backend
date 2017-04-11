<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * ShowOrganization cell
 */
class ShowOrganizationCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('Organizations');

        $organization = $this->Organizations
            ->findById($this->request->session()->read('Auth.User.active_organization_id'))
            ->first();

        $this->set(compact('organization'));
    }
}
