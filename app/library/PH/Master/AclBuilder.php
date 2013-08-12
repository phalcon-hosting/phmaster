<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master;
use Phalcon\Acl;
use Phalcon\Config;
use Phalcon\DI;
use Phalcon\Exception;
use Phalcon\Mvc\User\Plugin;


/**
 * The ACLBuilder builds the given acl configuration and applies it to the given ACL object.
 *
 * @todo improve documentation
 *
 * @package Hosting
*/
class AclBuilder extends Plugin {

    const PUBLIC_RESOURCE = 'public';

    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_GUEST = 'guest';

    /**
     * @var Acl\Adapter\Memory
     */
    protected $_acl;

    /**
     * @var \Phalcon\Config
     */
    protected $_config;

    /**
     * @var array
     */
    protected $_roles = array();


    /**
     * Method for adding the acl to the di container
     */
    public function addAclToDi() {
        $this->di->setShared('acl', $this->_acl);
    }

    /**
     * @return array
     */
    public function getRoles() {
        return $this->_roles;
    }

    /**
     * @param Acl\Adapter\Memory $acl
     * @param \Phalcon\Config $config
     * @return \PH\Master\AclBuilder
     */
    protected  function __construct(Acl\Adapter\Memory $acl, Config $config) {

        $this->_config = $config;
        $this->_acl = $acl;

    }

    /**
     *
     */
    protected function _addRoles() {
        foreach($this->_config->roles as $role) {
            $this->_acl->addRole($this->_roles[strtolower($role)] = new Acl\Role($role));
        }
    }

    /**
     * Sets access rights for public controllers
     * @return bool
     * @throws \Phalcon\Acl\Exception
     */
    protected function _processPublicControllers() {
        $publicControllers = $this->_config->publiccontrollers;

        // if the public resources config does not exist, or is not a valid array, skip processing it.
        if(!$publicControllers) {
            return false;
        }

        foreach ($publicControllers as $controller) {

            if(!is_string($controller)) {
                throw new Acl\Exception('Invalid controller specified as public');
            }

            foreach($this->_roles as $role) {
                $this->_processActions($role, $controller, '*');
            }
        }

        return true;
    }

    /**
     *
     */
    protected function _processResources() {
        if(count($this->_roles) == 0) {
            throw new Exception('Add the roles before processing the resources');
        }

        // We iterate over the role list backwards because the highest should inherit the lowest rights
        $resourcesList = $this->_config->resources->toArray();
        $inheritedResources = array();
        $reversedRoleList = array_reverse($this->_roles);

        // set all the rights for the users according to the ACL
        foreach ($reversedRoleList as $role) {
            $roleName = $role->getName();


            if(array_key_exists($roleName,$resourcesList)) {

                // the resource has to be a valid resource
                if(!is_array($resourcesList[$roleName])) {
                    throw new Acl\Exception(sprintf('Invalid resource defined: %s', $resourcesList[$roleName]));
                }
                $inheritedResources[] = $resourcesList[$roleName];

                foreach($inheritedResources as $resources) {

                    if(!is_array($resources)) {
                        throw new Acl\Exception('Invalid resource type specified');
                    }

                    foreach($resources as $controller => $actions) {
                        if(!is_string($controller)) {
                            throw new Acl\Exception(sprintf('Invalid controller defined: %s (array expected)',
                                $controller));
                        }

                        // deny actions for all roles first
                        foreach ($this->_roles as $denyRole) {
                            $this->_processActions($denyRole, $controller, $actions, 'deny');
                        }

                        // allow actions for this specific role
                        $this->_processActions($role, $controller, $actions);

                    }

                }
            }
        }

    }

    /**
     * @param Acl\Role $role
     * @param $controller
     * @param $actions
     * @param string $method
     * @throws \Phalcon\Acl\Exception
     */
    protected function _processActions(Acl\Role $role, $controller, $actions, $method = 'allow')
    {
        if(!in_array($method, array('allow', 'deny'))){
            throw new Acl\Exception(sprintf('Invalid %s method: %s. Allowed methods: allow, deny', __FUNCTION__, $method));
        }

        $this->_acl->addResource(new Acl\Resource($controller), $actions);

        if(is_string($actions)) {
            $this->_acl->$method($role->getName(), $controller, $actions);
        } elseif(is_array($actions)) {
            foreach($actions as $action) {
                $this->_acl->$method($role->getName(), $controller, $action);
            }
        }

    }

    /**
     * @param \Phalcon\Acl\Adapter\Memory $acl
     * @param Config $config
     */
    public static function build(Acl\Adapter\Memory $acl, Config $config) {
        $obj = new self($acl, $config);

        // add the roles to the acl
        $obj->_addRoles();

        // process the public controllers
        $obj->_processPublicControllers();

        // process the resources
        $obj->_processResources();

    }

}