<?php

namespace Albatross\Tools;

require_once __DIR__ . '/EntityConfiguratorInterface.php';

class DolibarrDefaultEntityConfigurator implements EntityConfiguratorInterface
{
    /**
     * Initialize needed Dolibarr Modules
     */
    public function initModules(array $modules): int
    {
        dol_syslog(get_class($this) . '::initModules count:' . count($modules), LOG_INFO);
        global $conf, $db;
        foreach ($modules as $module) {
            $lowercaseModule = strtolower($module);
            $modName = 'mod' . ucfirst($module);
            dol_syslog('Initializing module :' . $modName, LOG_NOTICE);
            $isModEnabled = (int) DOL_VERSION >= 16 ? isModEnabled($module) : $conf->$module->enabled;
            if (!$isModEnabled) {
                // We enable the module
                $modPath = DOL_DOCUMENT_ROOT . '/core/modules/' . $modName . '.class.php';
                $customModPath = DOL_DOCUMENT_ROOT . '/custom/' . $lowercaseModule . '/core/modules/' . $modName . '.class.php';
                if (!file_exists($modPath) && !file_exists($customModPath)) {
                    dol_syslog('Module ' . $module . ' not found', LOG_ERR);
                    return 0;
                }

                if (file_exists($customModPath)) {
                    $modPath = $customModPath;
                }

                require_once $modPath;
                $mod = new $modName($db);
                $mod->init();
            } else {
                dol_syslog('Module ' . $modName . ' is already enabled', LOG_NOTICE);
            }
        }

        return 1;
    }

    public function setSecurity(): void
    {
        dol_syslog(get_class($this) . '::setSecurity', LOG_INFO);
        global $db;

        $constArray = array(
            'MAIN_SECURITY_CSRF_WITH_TOKEN' => (int)DOL_VERSION >= 17 ? '3' : '2',
            'MAIN_RESTRICTHTML_ONLY_VALID_HTML' => '1',
            'MAIN_RESTRICTHTML_ONLY_VALID_HTML_TIDY' => '1',
            'MAIN_RESTRICTHTML_REMOVE_ALSO_BAD_ATTRIBUTES' => '1',
            'MAIN_DISALLOW_URL_INTO_DESCRIPTIONS' => '1'
        );

        foreach ($constArray as $key => $value) {
            if (!empty(dolibarr_get_const($db, $key))) {
                dolibarr_del_const($db, $key);
            }
            dolibarr_set_const($db, $key, $value, 'chaine', 1, '', $this->currentEntityId);
        }
    }

    public function setupEntity(int $entityId = 0, array $params = []): bool
    {
        // TODO: Implement setupEntity() method.
        return 1;
    }
}
