<?php

namespace Albatross\Tools;

require_once __DIR__ . '/intDBManager.php';
require_once DOL_DOCUMENT_ROOT . '/user/class/user.class.php';
require_once DOL_DOCUMENT_ROOT . '/societe/class/societe.class.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT . '/custom/albatross/inc/models/index.php';
require_once DOL_DOCUMENT_ROOT . '/custom/albatross/inc/mappers/index.php';
require_once DOL_DOCUMENT_ROOT . '/custom/multicompany/class/dao_multicompany.class.php';
require_once DOL_DOCUMENT_ROOT . '/custom/multicompany/class/actions_multicompany.class.php';

use ActionsMulticompany;
use Albatross\EntityDTO;
use Albatross\EntityDTOMapper;
use Albatross\OrderDTO;
use Albatross\ProductDTO;
use Albatross\ProductDTOMapper;
use Albatross\ServiceDTO;
use Albatross\ThirdpartyDTO;
use Albatross\ThirdpartyDTOMapper;
use Albatross\TicketDTO;
use Albatross\TicketDTOMapper;
use Albatross\UserDTO;
use Albatross\UserDTOMapper;
use Albatross\UserGroupDTO;
use Albatross\UserGroupDTOMapper;
use ExtraFields;
use modCommande;
use OrderDTOMapper;
use User;

class DoliDBManager implements intDBManager
{
    /**
     * @var int $currentEntityId
     */
    private $currentEntityId;

    public function __construct()
    {
        $this->currentEntityId = 0;
    }

    public function createUser(UserDTO $userDTO): int
    {
        dol_syslog(get_class($this) . '::createUser lastname:' . $userDTO->getLastname(), LOG_INFO);
        global $db, $user;

        $userDTOMapper = new UserDTOMapper();
        $tmpuser = $userDTOMapper->toUser($userDTO);

        $res = $tmpuser->create($user);

		foreach ($tmpuser->user_group_list as $groupId)
		{
			$tmpuser->SetInGroup($groupId, $conf->entity);
		}

		return $res;
    }

	public function createUserGroup(UserGroupDTO $userGroupDTO): int
	{
		dol_syslog(get_class($this) . '::createUserGroup label:' . $userGroupDTO->getLabel(), LOG_INFO);
		global $db, $user;

		$userGroupDTOMapper = new UserGroupDTOMapper();
		$tmpUserGroup = $userGroupDTOMapper->toUserGroup($userGroupDTO);

		$tmpUserGroup->create($user);
		return $tmpUserGroup->id;
	}

    public function createCustomer(ThirdpartyDTO $thirdpartyDTO): int
    {
        dol_syslog(get_class($this) . '::createThirdparty', LOG_INFO);

        global $db, $user;

        $thirdpartyDTOMapper = new ThirdpartyDTOMapper();
        $tmpCustomer = $thirdpartyDTOMapper->toCustomer($thirdpartyDTO);

        $tmpCustomer->create($user);
        return $tmpCustomer->id ?? 0;
    }

    public function createSupplier(ThirdpartyDTO $thirdpartyDTO): int
    {
        dol_syslog(get_class($this) . '::createThirdparty', LOG_INFO);

        global $db, $user;

        $thirdpartyDTOMapper = new ThirdpartyDTOMapper();
        $tmpSupplier = $thirdpartyDTOMapper->toSupplier($thirdpartyDTO);

        $tmpSupplier->fournisseur = 1;
        $tmpSupplier->code_fournisseur = 'auto';
        $tmpSupplier->country_code = 1;

        $res = $tmpSupplier->create($user);
        return $tmpSupplier->id ?? $res;
    }

    public function createProduct(ProductDTO $productDTO): int
    {
        global $db, $user;

        $productDTOMapper = new ProductDTOMapper();
        $product = $productDTOMapper->toProduct($productDTO);

        $product->create($user);
        return $product->id ?? 0;
    }

    public function createService(ServiceDTO $serviceDTO): int
    {
        global $db, $user;

        $productDTOMapper = new ProductDTOMapper();
        $product = $productDTOMapper->toService($serviceDTO);
        $product->create($user);
        return $product->id ?? 0;
    }

    public function createOrder(OrderDTO $orderDTO): int
    {
        global $db, $user;

        if (!isModEnabled('commande')) {
            // We enable the module
            require_once DOL_DOCUMENT_ROOT . '/core/modules/modCommande.class.php';
            $mod = new modCommande($db);
            $mod->init();
        }

        $orderDTOMapper = new OrderDTOMapper();
        $order = $orderDTOMapper->toOrder($orderDTO);
        $order->create($user);
        if (rand(0, 1)) {
            $order->valid($user);
        }
        return $order->id ?? 0;
    }

    public function createInvoice($invoice): int
    {
        return 1;
    }

	public function createTicket(TicketDTO $ticketDTO): int
	{
		global $db, $user;

		if (!isModEnabled('ticket')) {
			// We enable the module
			require_once DOL_DOCUMENT_ROOT . '/core/modules/modTicket.class.php';
			$mod = new modTicket($db);
			$mod->init();
		}

		$ticketDTOMapper = new TicketDTOMapper();
		$ticket = $ticketDTOMapper->toTicket($ticketDTO);
		$res = $ticket->create($user);
		return $ticket->id ?? $res;
	}

    public function createEntity(EntityDTO $entityDTO, array $params = []): int
    {
        global $db, $user;

        $entityDTOMapper = new EntityDTOMapper();

        if ($params['isModel'] ?? false) {
            $entity = $entityDTOMapper->toModel($entityDTO);
            $entity->template = 1;
            $_POST['template'] = 1;
        } else {
            $entity = $entityDTOMapper->toEntity($entityDTO);
        }

        // We create entity
        $actionsMulticompany = new ActionsMulticompany($db);
        $action = 'add';
        $id = $actionsMulticompany->doAdminActions($action);
		$action = 'view';

		if(is_null($id) || $id <= 1) return 0;

		if($entityDTO->isEndPatternsWithId()) {
			$entityDTO->setInvoicePattern($entityDTO->getReplacementInvoicePattern() . $id);
			$entityDTO->setReplacementInvoicePattern($entityDTO->getReplacementInvoicePattern() . $id);
			$entityDTO->setCreditNotePattern($entityDTO->getCreditNotePattern() . $id);
			$entityDTO->setDownPaymentInvoicePattern($entityDTO->getDownPaymentInvoicePattern() . $id);
			$entityDTO->setPropalPattern($entityDTO->getPropalPattern() . $id);
			$entityDTO->setCustomerCodePattern($entityDTO->getCustomerCodePattern() . $id);
			$entityDTO->setSupplierCodePattern($entityDTO->getSupplierCodePattern() . $id);
		}
		$this->configEntity($id, $entityDTO);

        return $id;
    }

	private function configEntity(int $entityId, EntityDTO $entityDTO)
	{
		global $db;

		if($entityDTO->getInvoicePattern() !== null) {
			dolibarr_set_const($db, 'FACTURE_ADDON', 'mod_facture_mercure', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'FACTURE_MERCURE_MASK_INVOICE', $entityDTO->getInvoicePattern(), 'chaine', 0, '', $entityId);
		}
		if($entityDTO->getReplacementInvoicePattern() !== null) {
			dolibarr_set_const($db, 'FACTURE_ADDON', 'mod_facture_mercure', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'FACTURE_MERCURE_MASK_REPLACEMENT', $entityDTO->getReplacementInvoicePattern(), 'chaine', 0, '', $entityId);
		}
		if($entityDTO->getCreditNotePattern() !== null) {
			dolibarr_set_const($db, 'FACTURE_ADDON', 'mod_facture_mercure', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'FACTURE_MERCURE_MASK_CREDIT', $entityDTO->getCreditNotePattern(), 'chaine', 0, '', $entityId);
		}
		if($entityDTO->getDownPaymentInvoicePattern() !== null) {
			dolibarr_set_const($db, 'FACTURE_ADDON', 'mod_facture_mercure', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'FACTURE_MERCURE_MASK_DEPOSIT', $entityDTO->getDownPaymentInvoicePattern(), 'chaine', 0, '', $entityId);
		}

		if($entityDTO->getPropalPattern() !== null) {
			dolibarr_set_const($db, 'PROPALE_ADDON', 'mod_propale_saphir', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'PROPALE_SAPHIR_MASK', $entityDTO->getPropalPattern(), 'chaine', 0, '', $entityId);
		}

		if($entityDTO->getCustomerCodePattern() !== null) {
			dolibarr_set_const($db, 'SOCIETE_CODECLIENT_ADDON', 'mod_codeclient_elephant', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'COMPANY_ELEPHANT_MASK_CUSTOMER', $entityDTO->getCustomerCodePattern(), 'chaine', 0, '', $entityId);
		}
		if($entityDTO->getSupplierCodePattern() !== null) {
			dolibarr_set_const($db, 'SOCIETE_CODECLIENT_ADDON', 'mod_codeclient_elephant', 'chaine', 0, '', $entityId);
			dolibarr_set_const($db, 'COMPANY_ELEPHANT_MASK_SUPPLIER', $entityDTO->getSupplierCodePattern(), 'chaine', 0, '', $entityId);
		}
	}

    public function setupEntity(int $entityId = 0, array $params = []): bool
    {
		// TODO: Move to fixtures as it is a specific setup
        global $user, $db;
        $isMasterEntity = ($entityId == 0);
        $isEasySAPEntity = ($params['isEasySAP'] ?? false);
        $isModelEntity = ($params['isModel'] ?? false);

        if (!$isMasterEntity) {
            $actionsMulticompany = new ActionsMulticompany($db);
            $actionsMulticompany->switchEntity($entityId, $user);
        }

        $this->currentEntityId = $entityId;
        $this->setSecurity();

        // Define needed modules
        switch (true) {
            case $isMasterEntity:
                $neededModules = [
                    'societe',
                    'fournisseur',
                    'service',
                    'facture',
                    'multiCompany',
                    'userSwitcher',
                    // System
                    'syslog',
                    'debugBar',
                ];
                break;
            case $isEasySAPEntity:
                $neededModules = [
                    // RH
                    'expenseReport',
                    // GRC
                    'societe',
                    'propale',
                    'contrat',
                    'ticket',
                    // GRF
                    'fournisseur',
                    // Modules Financiers
                    'facture',
                    'tax',
                    'banque',
                    'paymentByBankTransfer',
                    'prelevement',
                    'comptabilite',
                    'accounting',
                    //'bankImport',
                    // PM
                    'product',
                    'service',
                    'stock',
                    // Divers
                    'agenda',
                    'ECM',
                    'categorie',
                    'fckeditor',
                    'bookmark',
                    'workflow',
                    'import',
                    'export',
                    // Externe
                    'api',
                    'openSurvey',
                    'socialNetworks',
                    'notification',
                    'mailing',
                    'emailCollector',
                    'externalSite',
                    // System
                    'cron',
                    'syslog',
                    'debugBar',
                    // Other
                    //'abricot',
                    'albatross',
                    'easysapChoreOverwriter',
                    'fraisService',
                    'userSwitcher',
                ];
                break;
            case $isModelEntity:
                $neededModules = [
                    'societe',
                    'propale',
                    'banque',
                    'paymentByBankTransfer',
                    'prelevement',
                    'comptabilite',
                    'syslog',
                    'debugBar',
                    'service',
                    'facture',
                    // Divers
                    'agenda',
                    'ECM',
                    'bookmark',
                    'fckeditor',
                    'mailing',
                    'easysapChoreOverwriter',
                    'fraisService',
                    'userSwitcher',
                ];
                break;
            default:
                $neededModules = [
                    'societe',
                    'propale',
                    'banque',
                    'paymentByBankTransfer',
                    'prelevement',
                    'comptabilite',
                    'syslog',
                    'debugBar',
                    'service',
                    'facture',
                    'agenda',
                    'ECM',
                    'bookmark',
                    'fckeditor',
                    'mailing',
                    'easysapChoreOverwriter',
                    'fraisService',
                    'userSwitcher',
                ]; // FIXME: Temporary : Remove when multicompany initialization is fixed
                break;
        }

        $this->initModules($neededModules);

        if ($isMasterEntity) {
            // Set multicompany config
            dolibarr_set_const($db, 'MAIN_INFO_SOCIETE_NOM', 'Entité principale', 'chaine', 0, '', 1);
            dolibarr_set_const($db, 'MAIN_INFO_SOCIETE_COUNTRY', '1:FR:France', 'chaine', 0, '', 1);
            dolibarr_set_const($db, 'MULTICOMPANY_TEMPLATE_MANAGEMENT', 1, 'int', 0, '', 0);
            dolibarr_set_const($db, 'MULTICOMPANY_VISIBLE_BY_DEFAULT', 1, 'int', 0, '', 0);
            dolibarr_set_const($db, 'MULTICOMPANY_ACTIVE_BY_DEFAULT', 1, 'int', 0, '', 0);
        }

        // Set common constant
        dolibarr_set_const($db, 'MAIN_THEME', 'md', 'chaine', 0, '', $this->currentEntityId);
        dolibarr_set_const($db, 'THEME_ELDY_TOPMENU_BACK1', '191,95,0', 'chaine', 0, '', $this->currentEntityId);

        if ($isEasySAPEntity) {
            // We add extrafield to thirdparty
            global $db;
            $extrafield = new ExtraFields($db);
            $extrafield->addExtraField(
                'fraisservice_entity',
                'Entité de facturation',
                'select',
                101,
                6,
                'thirdparty',
                0,
                0,
                '',
                'entity:label:rowid::active=1',
                1,
                1,
                '',
                '',
                0,
                $this->currentEntityId,
                'easysapchoreoverwriter@easysapchoreoverwriter',
                1,
                0,
                0
            );
        }

        $this->currentEntityId = 0;
        if (!$isMasterEntity) {
            $actionsMulticompany = new ActionsMulticompany($db);
            $actionsMulticompany->switchEntity(1, $user);
        }

        return 1;
    }

    public function setSecurity(): bool
    {
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

        return 1;
    }

    public function removeFixtures(): bool
    {
        global $db, $user;

        $tmpUser = new User($db);
        $tmpUser->fetchAll();

        $tmpUser->users = array_filter($tmpUser->users, function ($user) {
            return $user->login !== 'administrator';
        });

        foreach ($tmpUser->users as $inLoopUser) {
            $userId = $inLoopUser->id;
            $toDeleteUser = new User($db);
            $toDeleteUser->fetch($userId);

            $toDeleteUser->delete($user);
        }

        $toDrop = [
			'usergroup',
            'facture_fourn_det',
            'facture_fourn',
            'facturedet',
            'facture',
            'commandedet',
            'commande',
            'product_price',
            'product',
            'societe_extrafields',
            'societe_commerciaux',
            'societe_contacts',
            'societe_prices',
            'societe',
			'ticket',
        ];

        foreach ($toDrop as $table) {
            $sql = 'DELETE FROM ' . MAIN_DB_PREFIX . $table;
            $resql = $db->query($sql);
            if (!$resql) {
                dol_syslog(get_class($this) . '::removeFixtures ' . $db->lasterror(), LOG_ERR);
                dol_print_error($db);
                return -1;
            }
        }

        $sql = 'DELETE FROM ' . MAIN_DB_PREFIX . 'entity_extrafields';
        $sql .= ' WHERE fk_object > 1';
        $resql = $db->query($sql);
        if (!$resql) {
            dol_syslog(get_class($this) . '::removeFixtures ' . $db->lasterror(), LOG_ERR);
            dol_print_error($db);
            return -1;
        }

        $sql = 'DELETE FROM ' . MAIN_DB_PREFIX . 'entity';
        $sql .= ' WHERE rowid > 1';
        $resql = $db->query($sql);
        if (!$resql) {
            dol_syslog(get_class($this) . '::removeFixtures ' . $db->lasterror(), LOG_ERR);
            dol_print_error($db);
            return -1;
        }

        return 1;
    }

    // SPECIFIC DOLIBARR FUNCTIONS

    /**
     * Initialize needed Dolibarr Modules
     */
    private function initModules(array $modules): int
    {
        global $db;
        foreach ($modules as $module) {
            $lowercaseModule = strtolower($module);
            if (!isModEnabled($lowercaseModule)) {
                // We enable the module
                $modName = 'mod' . ucfirst($module);
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
            }
        }

        return 1;
    }
}
