<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * --------------------------------------------------------------------
     * KONEKSI DATABASE UTAMA (DEFAULT)
     * --------------------------------------------------------------------
     * Konfigurasi ini akan terhubung ke database 'db_akuntansi'.
     * Nilai di bawah ini akan ditimpa (override) oleh pengaturan
     * 'database.default.*' yang ada di file .env Anda.
     */
    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'db_akuntansi', // Akan ditimpa oleh .env
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    /**
     * --------------------------------------------------------------------
     * KONEKSI DATABASE KEDUA (db2)
     * --------------------------------------------------------------------
     * Grup koneksi kustom untuk database 'db1_akuntansi'.
     * Nilai di bawah ini akan ditimpa (override) oleh pengaturan
     * 'database.db2.*' yang ada di file .env Anda.
     */
    public array $db2 = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'db1_akuntansi', // Akan ditimpa oleh .env
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
