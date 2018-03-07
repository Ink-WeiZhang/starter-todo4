<?php
/**
 * Created by PhpStorm.
 * User: Wei
 * Date: 2/28/2018
 * Time: 11:11 AM
 */
class Roles extends Application
{

    public function actor($role = ROLE_GUEST)
    {
        $this->session->set_userdata('userrole',$role);
        redirect($_SERVER['HTTP_REFERER']); // back where we came from
    }

}