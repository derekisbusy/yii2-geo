<?php

use derekisbusy\geo\models\base\GeoState;

class m170225_180102_alter_table_geo_state_add_column_status extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->addColumn(
                GeoState::tableName(), 
                'adjective', 
                $this->string(64)->defaultValue('')->after('state_code'));
        
        $this->addColumn(
                GeoState::tableName(), 
                'status', 
                $this->integer(1)->notNull()->defaultValue(1)->after('adjective'));
                
    }

    public function down()
    {
        $this->dropColumn(GeoState::tableName(), 'status');
    }
}
