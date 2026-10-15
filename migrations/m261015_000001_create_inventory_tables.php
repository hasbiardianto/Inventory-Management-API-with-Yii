<?php
use yii\db\Migration;

class m261015_000001_create_inventory_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'asset_code' => $this->string(150)->notNull()->unique(),
            'category_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(0),
            'minimum_stock' => $this->integer()->notNull()->defaultValue(0),
            'condition' => $this->string(30)->notNull()->defaultValue('good'),
            'location' => $this->string(150),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey('fk-items-category_id', '{{%items}}', 'category_id',
            '{{%categories}}', 'id', 'RESTRICT', 'CASCADE');

        $now = time();
        $this->batchInsert('{{%categories}}',
            ['name', 'description', 'created_at', 'updated_at'], [
                ['Electronics', 'Electronic devices and computers', $now, $now],
                ['Hardware', 'Hardware components and tools', $now, $now],
                ['Accessories', 'Cables, adapters, and accessories', $now, $now],
            ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-items-category_id', '{{%items}}');
        $this->dropTable('{{%items}}');
        $this->dropTable('{{%categories}}');
    }
}
