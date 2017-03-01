<?php

use derekisbusy\geo\models\base\GeoCounty;

class m170225_180101_alter_table_geo_county_add_column_status extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->addColumn(
                GeoCounty::tableName(), 
                'status', 
                $this->integer(1)->notNull()->defaultValue(1)->after('state_id'));
                
    }

    public function down()
    {
        $this->dropColumn(GeoCounty::tableName(), 'status');
    }
}
