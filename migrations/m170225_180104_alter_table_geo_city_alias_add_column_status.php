<?php

use derekisbusy\geo\models\base\GeoCityAlias;

class m170225_180104_alter_table_geo_city_alias_add_column_status extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->addColumn(
            GeoCityAlias::tableName(), 
            'status', 
            $this->integer(1)->notNull()->defaultValue(2)->after('city_id'));
    }

    public function down()
    {
        $this->dropColumn(GeoCity::tableName(), 'status');
    }
}
