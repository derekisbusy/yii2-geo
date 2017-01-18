<?php

use yii\db\Schema;

class m170010_010101_create_geo_state_table extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        if (!in_array(Yii::$app->db->tablePrefix.'geo_state', $tables))  {
            $this->createTable('{{%geo_state}}', [
                'id' => $this->primaryKey(),
                'state' => $this->string(22)->notNull(),
                'state_code' => $this->char(2)->notNull(),
            ], $tableOptions);

            $this->insertData();
        } else {
          echo 'Table `'.Yii::$app->db->tablePrefix.'geo_city` already exists!';
        }
    }

    public function down()
    {
        $this->dropTable('{{%geo_state}}');
    }

    public function insertData()
    {
        $this->insert('{{%geo_state}}',['id'=>'1','state'=>'Alaska','state_code'=>'AK']);
        $this->insert('{{%geo_state}}',['id'=>'2','state'=>'Alabama','state_code'=>'AL']);
        $this->insert('{{%geo_state}}',['id'=>'3','state'=>'Arkansas','state_code'=>'AR']);
        $this->insert('{{%geo_state}}',['id'=>'4','state'=>'Arizona','state_code'=>'AZ']);
        $this->insert('{{%geo_state}}',['id'=>'5','state'=>'California','state_code'=>'CA']);
        $this->insert('{{%geo_state}}',['id'=>'6','state'=>'Colorado','state_code'=>'CO']);
        $this->insert('{{%geo_state}}',['id'=>'7','state'=>'Connecticut','state_code'=>'CT']);
        $this->insert('{{%geo_state}}',['id'=>'8','state'=>'District of Columbia','state_code'=>'DC']);
        $this->insert('{{%geo_state}}',['id'=>'9','state'=>'Delaware','state_code'=>'DE']);
        $this->insert('{{%geo_state}}',['id'=>'10','state'=>'Florida','state_code'=>'FL']);
        $this->insert('{{%geo_state}}',['id'=>'11','state'=>'Georgia','state_code'=>'GA']);
        $this->insert('{{%geo_state}}',['id'=>'12','state'=>'Hawaii','state_code'=>'HI']);
        $this->insert('{{%geo_state}}',['id'=>'13','state'=>'Iowa','state_code'=>'IA']);
        $this->insert('{{%geo_state}}',['id'=>'14','state'=>'Idaho','state_code'=>'ID']);
        $this->insert('{{%geo_state}}',['id'=>'15','state'=>'Illinois','state_code'=>'IL']);
        $this->insert('{{%geo_state}}',['id'=>'16','state'=>'Indiana','state_code'=>'IN']);
        $this->insert('{{%geo_state}}',['id'=>'17','state'=>'Kansas','state_code'=>'KS']);
        $this->insert('{{%geo_state}}',['id'=>'18','state'=>'Kentucky','state_code'=>'KY']);
        $this->insert('{{%geo_state}}',['id'=>'19','state'=>'Louisiana','state_code'=>'LA']);
        $this->insert('{{%geo_state}}',['id'=>'20','state'=>'Massachusetts','state_code'=>'MA']);
        $this->insert('{{%geo_state}}',['id'=>'21','state'=>'Maryland','state_code'=>'MD']);
        $this->insert('{{%geo_state}}',['id'=>'22','state'=>'Maine','state_code'=>'ME']);
        $this->insert('{{%geo_state}}',['id'=>'23','state'=>'Michigan','state_code'=>'MI']);
        $this->insert('{{%geo_state}}',['id'=>'24','state'=>'Minnesota','state_code'=>'MN']);
        $this->insert('{{%geo_state}}',['id'=>'25','state'=>'Missouri','state_code'=>'MO']);
        $this->insert('{{%geo_state}}',['id'=>'26','state'=>'Mississippi','state_code'=>'MS']);
        $this->insert('{{%geo_state}}',['id'=>'27','state'=>'Montana','state_code'=>'MT']);
        $this->insert('{{%geo_state}}',['id'=>'28','state'=>'North Carolina','state_code'=>'NC']);
        $this->insert('{{%geo_state}}',['id'=>'29','state'=>'North Dakota','state_code'=>'ND']);
        $this->insert('{{%geo_state}}',['id'=>'30','state'=>'Nebraska','state_code'=>'NE']);
        $this->insert('{{%geo_state}}',['id'=>'31','state'=>'New Hampshire','state_code'=>'NH']);
        $this->insert('{{%geo_state}}',['id'=>'32','state'=>'New Jersey','state_code'=>'NJ']);
        $this->insert('{{%geo_state}}',['id'=>'33','state'=>'New Mexico','state_code'=>'NM']);
        $this->insert('{{%geo_state}}',['id'=>'34','state'=>'Nevada','state_code'=>'NV']);
        $this->insert('{{%geo_state}}',['id'=>'35','state'=>'New York','state_code'=>'NY']);
        $this->insert('{{%geo_state}}',['id'=>'36','state'=>'Ohio','state_code'=>'OH']);
        $this->insert('{{%geo_state}}',['id'=>'37','state'=>'Oklahoma','state_code'=>'OK']);
        $this->insert('{{%geo_state}}',['id'=>'38','state'=>'Oregon','state_code'=>'OR']);
        $this->insert('{{%geo_state}}',['id'=>'39','state'=>'Pennsylvania','state_code'=>'PA']);
        $this->insert('{{%geo_state}}',['id'=>'40','state'=>'Rhode Island','state_code'=>'RI']);
        $this->insert('{{%geo_state}}',['id'=>'41','state'=>'South Carolina','state_code'=>'SC']);
        $this->insert('{{%geo_state}}',['id'=>'42','state'=>'South Dakota','state_code'=>'SD']);
        $this->insert('{{%geo_state}}',['id'=>'43','state'=>'Tennessee','state_code'=>'TN']);
        $this->insert('{{%geo_state}}',['id'=>'44','state'=>'Texas','state_code'=>'TX']);
        $this->insert('{{%geo_state}}',['id'=>'45','state'=>'Utah','state_code'=>'UT']);
        $this->insert('{{%geo_state}}',['id'=>'46','state'=>'Virginia','state_code'=>'VA']);
        $this->insert('{{%geo_state}}',['id'=>'47','state'=>'Vermont','state_code'=>'VT']);
        $this->insert('{{%geo_state}}',['id'=>'48','state'=>'Washington','state_code'=>'WA']);
        $this->insert('{{%geo_state}}',['id'=>'49','state'=>'Wisconsin','state_code'=>'WI']);
        $this->insert('{{%geo_state}}',['id'=>'50','state'=>'West Virginia','state_code'=>'WV']);
        $this->insert('{{%geo_state}}',['id'=>'51','state'=>'Wyoming','state_code'=>'WY']);
        $this->insert('{{%geo_state}}',['id'=>'52','state'=>'Puerto Rico','state_code'=>'PR']);
    }
}
