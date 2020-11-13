<?php

use \yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
        $this->createTable('{{%session}}', [
            'id' => $this->string()->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary(),
            'PRIMARY KEY ([[id]])',
        ]);

        $this->createTable('{{%file}}', [
            "id" => $this->primaryKey(),
            'data' => $this->binary(),
            "name" => $this->string()->notNull(),
            "extension" => $this->string()->notNull(),
            "size" => $this->integer()->notNull(),
            "mime" => $this->string()->notNull(),
            "uploaded_at" => $this->timestamp()->defaultExpression('NOW()'),
        ]);

        $this->createTable('{{%queue}}', [
            'id'            => $this->bigPrimaryKey(),
            'channel'       => $this->string()->notNull(),
            'job'           => $this->binary()->notNull(),
            'pushed_at'     => $this->bigInteger()->notNull(),
            'ttr'           => $this->bigInteger()->notNull(),
            'delay'         => $this->bigInteger()->notNull()->defaultValue(0),
            'priority'      => $this->bigInteger()->unsigned()->check('priority > 0')->notNull()->defaultValue(1024),
            'reserved_at'   => $this->bigInteger(),
            'attempt'       => $this->bigInteger(),
            'done_at'       => $this->bigInteger(),
        ]);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
        $this->dropTable('{{%session}}');
        $this->dropTable('{{%file}}');
        $this->dropTable('{{%queue}}');
    }
}
