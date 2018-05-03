<?php
/**
 * Created by PhpStorm.
 * User: MULIA
 * Date: 02/05/2018
 * Time: 13:29
 */

namespace MuliaLestari\Staff\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'mb_staff_grid'
         */
        if (!$installer->tableExists('mb_staff_grid')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('mb_staff_grid'))
                ->addColumn(
                    'staff_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Staff Id'
                )
                ->addColumn(
                    'staff_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Staff Name'
                )
                ->addColumn(
                    'staff_email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Staff Email'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '1'],
                    'Status'
                )
                ->addIndex(
                    $installer->getIdxName('mb_staff_grid', ['status']),
                    ['status']
                )
                ->setComment('Staff');

            $installer->getConnection()->createTable($table);
        }else{
            echo 'Table exists';
        }
        $installer->endSetup();
    }
}