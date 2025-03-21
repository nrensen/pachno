<?php

    namespace pachno\core\entities\common;

    use pachno\core\framework\Event;

    /**
     * A class with event container storage for extending objects via events
     *
     * @author Daniel Andre Eikeland <zegenie@zegeniestudios.net>
     * @version 3.1
     * @license http://opensource.org/licenses/MPL-2.0 Mozilla Public License 2.0 (MPL 2.0)
     * @package pachno
     * @subpackage core
     */

    /**
     * A class with event container storage for extending objects via events
     *
     * @package pachno
     * @subpackage core
     */
    abstract class IdentifiableEventContainer extends Identifiable
    {

        /**
         * The storage container
         *
         * @var array
         */
        protected $_storage = [];

        public function _store($module, $name, $value)
        {
            if (!isset($this->_storage[$module])) $this->_storage[$module] = [];
            $this->_storage[$module][$name] = $value;
        }

        public function _retrieve($module, $name)
        {
            return (isset($this->_storage[$module]) && isset($this->_storage[$module][$name])) ? $this->_storage[$module][$name] : null;
        }

        public function _isset($module, $name)
        {
            return isset($this->_storage[$module]) && isset($this->_storage[$module][$name]);
        }

        public function _unset($module, $name)
        {
            if (isset($this->_storage[$module]) && isset($this->_storage[$module][$name]))
                unset($this->_storage[$module][$name]);
        }

        public function __call($name, $arguments)
        {
            $event = Event::createNew('core', get_called_class() . '::__' . $name, $this, $arguments);
            $event->triggerUntilProcessed();

            return $event->getReturnValue();
        }

    }
