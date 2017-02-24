<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170224_113055_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->unique(),
            'password' => $this->string()->notNull(),
            'gender' => $this->char(),
            'hoppies' => $this->text(),
            'token' => $this->string()->notNull()->unique(),
            'activation_code' => $this->string(),
            'status'=>$this->string(10),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
