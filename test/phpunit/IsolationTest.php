<?php

namespace test\functional;

use PHPUnit\Framework\TestCase;

class IsolationTest extends TestCase
{
    public function testDTOIsolation()
    {
        $dtoIndexPath = dirname(__DIR__, 2) . '/inc/models/index.php';
        $dtoFolderPath = dirname($dtoIndexPath);

        $this->assertFileExists($dtoIndexPath);
        require_once $dtoIndexPath;

        $dtoFileList = scandir($dtoFolderPath);
        $dtoList = [];
        foreach ($dtoFileList as $dtoFile) {
            if (preg_match('/\.class\.php/', $dtoFile)) {
                $dto = preg_replace('/\.class\.php/', '', $dtoFile);
                $dtoList[] = $dto;
            }
        }

        // We control that all DTOs are in index.php
        // Errors will be automaticly thrown if isolation is not respected
        foreach ($dtoList as $dto) {
            $this->assertThat(
                class_exists('Albatross\\' . $dto),
                $this->isTrue(),
                'Class ' . $dto . ' has been created but it is not in index.php or namespace is wrong'
            );
        }
    }

    public function testToolsIsolation()
    {
        $this->assertFileExists(dirname(__DIR__, 2) . '/inc/tools/dbManagerStub.php');
        $this->assertFileExists(dirname(__DIR__, 2) . '/inc/tools/doliDBManager.php');
        $this->assertFileExists(dirname(__DIR__, 2) . '/inc/tools/intDBManager.php');
        if (!defined('DOL_DOCUMENT_ROOT')) {
            define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
        }

        require_once dirname(__DIR__, 2) . '/inc/tools/intDBManager.php';

        $this->assertThat(
            interface_exists('Albatross\Tools\intDBManager'),
            $this->isTrue(),
            'Class intDBManager does not exist'
        );

        // This test will fail because multicompany module is not isolated
        // and business logic is not separated from the database layer
        require_once dirname(__DIR__, 2) . '/inc/tools/doliDBManager.php';

        $this->assertThat(
            class_exists('Albatross\Tools\DoliDBManager'),
            $this->isTrue(),
            'Class DoliDBManager does not exist'
        );

        require_once dirname(__DIR__, 2) . '/inc/tools/dbManagerStub.php';

        $this->assertThat(
            class_exists('Albatross\Tools\dbManagerStub'),
            $this->isTrue(),
            'Class dbManagerStub does not exist'
        );
    }
}
