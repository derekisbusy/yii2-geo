<?php

use yii\db\Schema;

class m170110_050101_create_geo_country_table extends \yii\db\Migration
{
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        if (!in_array(Yii::$app->db->tablePrefix.'geo_country', $tables))  {
            $this->createTable('{{%geo_country}}', [
                'id' => $this->primaryKey(),
                'country_code' => $this->string(2)->notNull(),
                'country' => $this->string(50)->notNull(),
            ], $tableOptions);


            $this->createIndex(
                'idx-geo_country-country_code',
                '{{%contact}}',
                'country_code',
                true
            );

            $this->createIndex(
                'idx-geo_country-country',
                '{{%contact}}',
                'country',
                true
            );

            $this->insertData();
        } else {
          echo 'Table `'.Yii::$app->db->tablePrefix.'geo_country` already exists!';
        }


    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%geo_country}}');
        $this->execute('SET foreign_key_checks = 1');
    }

    public function insertData()
    {
        $this->insert('{{%geo_country}}',['id'=>'1','country_code'=>'AF','country'=>'Afghanistan']);
        $this->insert('{{%geo_country}}',['id'=>'2','country_code'=>'AL','country'=>'Albania']);
        $this->insert('{{%geo_country}}',['id'=>'3','country_code'=>'DZ','country'=>'Algeria']);
        $this->insert('{{%geo_country}}',['id'=>'4','country_code'=>'AS','country'=>'American Samoa']);
        $this->insert('{{%geo_country}}',['id'=>'5','country_code'=>'AD','country'=>'Andorra']);
        $this->insert('{{%geo_country}}',['id'=>'6','country_code'=>'AO','country'=>'Angola']);
        $this->insert('{{%geo_country}}',['id'=>'7','country_code'=>'AI','country'=>'Anguilla']);
        $this->insert('{{%geo_country}}',['id'=>'8','country_code'=>'AQ','country'=>'Antarctica']);
        $this->insert('{{%geo_country}}',['id'=>'9','country_code'=>'AG','country'=>'Antigua And Barbuda']);
        $this->insert('{{%geo_country}}',['id'=>'10','country_code'=>'AR','country'=>'Argentina']);
        $this->insert('{{%geo_country}}',['id'=>'11','country_code'=>'AM','country'=>'Armenia']);
        $this->insert('{{%geo_country}}',['id'=>'12','country_code'=>'AW','country'=>'Aruba']);
        $this->insert('{{%geo_country}}',['id'=>'13','country_code'=>'AU','country'=>'Australia']);
        $this->insert('{{%geo_country}}',['id'=>'14','country_code'=>'AT','country'=>'Austria']);
        $this->insert('{{%geo_country}}',['id'=>'15','country_code'=>'AZ','country'=>'Azerbaijan']);
        $this->insert('{{%geo_country}}',['id'=>'16','country_code'=>'BS','country'=>'Bahamas']);
        $this->insert('{{%geo_country}}',['id'=>'17','country_code'=>'BH','country'=>'Bahrain']);
        $this->insert('{{%geo_country}}',['id'=>'18','country_code'=>'BD','country'=>'Bangladesh']);
        $this->insert('{{%geo_country}}',['id'=>'19','country_code'=>'BB','country'=>'Barbados']);
        $this->insert('{{%geo_country}}',['id'=>'20','country_code'=>'BY','country'=>'Belarus']);
        $this->insert('{{%geo_country}}',['id'=>'21','country_code'=>'BE','country'=>'Belgium']);
        $this->insert('{{%geo_country}}',['id'=>'22','country_code'=>'BZ','country'=>'Belize']);
        $this->insert('{{%geo_country}}',['id'=>'23','country_code'=>'BJ','country'=>'Benin']);
        $this->insert('{{%geo_country}}',['id'=>'24','country_code'=>'BM','country'=>'Bermuda']);
        $this->insert('{{%geo_country}}',['id'=>'25','country_code'=>'BT','country'=>'Bhutan']);
        $this->insert('{{%geo_country}}',['id'=>'26','country_code'=>'BO','country'=>'Bolivia']);
        $this->insert('{{%geo_country}}',['id'=>'27','country_code'=>'BA','country'=>'Bosnia And Herzegovina']);
        $this->insert('{{%geo_country}}',['id'=>'28','country_code'=>'BW','country'=>'Botswana']);
        $this->insert('{{%geo_country}}',['id'=>'29','country_code'=>'BV','country'=>'Bouvet Island']);
        $this->insert('{{%geo_country}}',['id'=>'30','country_code'=>'BR','country'=>'Brazil']);
        $this->insert('{{%geo_country}}',['id'=>'31','country_code'=>'IO','country'=>'British Indian Ocean Territory']);
        $this->insert('{{%geo_country}}',['id'=>'32','country_code'=>'BN','country'=>'Brunei Darussalam']);
        $this->insert('{{%geo_country}}',['id'=>'33','country_code'=>'BG','country'=>'Bulgaria']);
        $this->insert('{{%geo_country}}',['id'=>'34','country_code'=>'BF','country'=>'Burkina Faso']);
        $this->insert('{{%geo_country}}',['id'=>'35','country_code'=>'BI','country'=>'Burundi']);
        $this->insert('{{%geo_country}}',['id'=>'36','country_code'=>'KH','country'=>'Cambodia']);
        $this->insert('{{%geo_country}}',['id'=>'37','country_code'=>'CM','country'=>'Cameroon']);
        $this->insert('{{%geo_country}}',['id'=>'38','country_code'=>'CA','country'=>'Canada']);
        $this->insert('{{%geo_country}}',['id'=>'39','country_code'=>'CV','country'=>'Cape Verde']);
        $this->insert('{{%geo_country}}',['id'=>'40','country_code'=>'KY','country'=>'Cayman Islands']);
        $this->insert('{{%geo_country}}',['id'=>'41','country_code'=>'CF','country'=>'Central African Republic']);
        $this->insert('{{%geo_country}}',['id'=>'42','country_code'=>'TD','country'=>'Chad']);
        $this->insert('{{%geo_country}}',['id'=>'43','country_code'=>'CL','country'=>'Chile']);
        $this->insert('{{%geo_country}}',['id'=>'44','country_code'=>'CN','country'=>'China']);
        $this->insert('{{%geo_country}}',['id'=>'45','country_code'=>'CX','country'=>'Christmas Island']);
        $this->insert('{{%geo_country}}',['id'=>'46','country_code'=>'CC','country'=>'Cocos (keeling) Islands']);
        $this->insert('{{%geo_country}}',['id'=>'47','country_code'=>'CO','country'=>'Colombia']);
        $this->insert('{{%geo_country}}',['id'=>'48','country_code'=>'KM','country'=>'Comoros']);
        $this->insert('{{%geo_country}}',['id'=>'49','country_code'=>'CG','country'=>'Congo']);
        $this->insert('{{%geo_country}}',['id'=>'50','country_code'=>'CD','country'=>'Congo, The Democratic Republic Of The']);
        $this->insert('{{%geo_country}}',['id'=>'51','country_code'=>'CK','country'=>'Cook Islands']);
        $this->insert('{{%geo_country}}',['id'=>'52','country_code'=>'CR','country'=>'Costa Rica']);
        $this->insert('{{%geo_country}}',['id'=>'53','country_code'=>'CI','country'=>'Cote D\'ivoire']);
        $this->insert('{{%geo_country}}',['id'=>'54','country_code'=>'HR','country'=>'Croatia']);
        $this->insert('{{%geo_country}}',['id'=>'55','country_code'=>'CU','country'=>'Cuba']);
        $this->insert('{{%geo_country}}',['id'=>'56','country_code'=>'CY','country'=>'Cyprus']);
        $this->insert('{{%geo_country}}',['id'=>'57','country_code'=>'CZ','country'=>'Czech Republic']);
        $this->insert('{{%geo_country}}',['id'=>'58','country_code'=>'DK','country'=>'Denmark']);
        $this->insert('{{%geo_country}}',['id'=>'59','country_code'=>'DJ','country'=>'Djibouti']);
        $this->insert('{{%geo_country}}',['id'=>'60','country_code'=>'DM','country'=>'Dominica']);
        $this->insert('{{%geo_country}}',['id'=>'61','country_code'=>'DO','country'=>'Dominican Republic']);
        $this->insert('{{%geo_country}}',['id'=>'62','country_code'=>'TP','country'=>'East Timor']);
        $this->insert('{{%geo_country}}',['id'=>'63','country_code'=>'EC','country'=>'Ecuador']);
        $this->insert('{{%geo_country}}',['id'=>'64','country_code'=>'EG','country'=>'Egypt']);
        $this->insert('{{%geo_country}}',['id'=>'65','country_code'=>'SV','country'=>'El Salvador']);
        $this->insert('{{%geo_country}}',['id'=>'66','country_code'=>'GQ','country'=>'Equatorial Guinea']);
        $this->insert('{{%geo_country}}',['id'=>'67','country_code'=>'ER','country'=>'Eritrea']);
        $this->insert('{{%geo_country}}',['id'=>'68','country_code'=>'EE','country'=>'Estonia']);
        $this->insert('{{%geo_country}}',['id'=>'69','country_code'=>'ET','country'=>'Ethiopia']);
        $this->insert('{{%geo_country}}',['id'=>'70','country_code'=>'FK','country'=>'Falkland Islands (malvinas)']);
        $this->insert('{{%geo_country}}',['id'=>'71','country_code'=>'FO','country'=>'Faroe Islands']);
        $this->insert('{{%geo_country}}',['id'=>'72','country_code'=>'FJ','country'=>'Fiji']);
        $this->insert('{{%geo_country}}',['id'=>'73','country_code'=>'FI','country'=>'Finland']);
        $this->insert('{{%geo_country}}',['id'=>'74','country_code'=>'FR','country'=>'France']);
        $this->insert('{{%geo_country}}',['id'=>'75','country_code'=>'GF','country'=>'French Guiana']);
        $this->insert('{{%geo_country}}',['id'=>'76','country_code'=>'PF','country'=>'French Polynesia']);
        $this->insert('{{%geo_country}}',['id'=>'77','country_code'=>'TF','country'=>'French Southern Territories']);
        $this->insert('{{%geo_country}}',['id'=>'78','country_code'=>'GA','country'=>'Gabon']);
        $this->insert('{{%geo_country}}',['id'=>'79','country_code'=>'GM','country'=>'Gambia']);
        $this->insert('{{%geo_country}}',['id'=>'80','country_code'=>'GE','country'=>'Georgia']);
        $this->insert('{{%geo_country}}',['id'=>'81','country_code'=>'DE','country'=>'Germany']);
        $this->insert('{{%geo_country}}',['id'=>'82','country_code'=>'GH','country'=>'Ghana']);
        $this->insert('{{%geo_country}}',['id'=>'83','country_code'=>'GI','country'=>'Gibraltar']);
        $this->insert('{{%geo_country}}',['id'=>'84','country_code'=>'GR','country'=>'Greece']);
        $this->insert('{{%geo_country}}',['id'=>'85','country_code'=>'GL','country'=>'Greenland']);
        $this->insert('{{%geo_country}}',['id'=>'86','country_code'=>'GD','country'=>'Grenada']);
        $this->insert('{{%geo_country}}',['id'=>'87','country_code'=>'GP','country'=>'Guadeloupe']);
        $this->insert('{{%geo_country}}',['id'=>'88','country_code'=>'GU','country'=>'Guam']);
        $this->insert('{{%geo_country}}',['id'=>'89','country_code'=>'GT','country'=>'Guatemala']);
        $this->insert('{{%geo_country}}',['id'=>'90','country_code'=>'GN','country'=>'Guinea']);
        $this->insert('{{%geo_country}}',['id'=>'91','country_code'=>'GW','country'=>'Guinea-bissau']);
        $this->insert('{{%geo_country}}',['id'=>'92','country_code'=>'GY','country'=>'Guyana']);
        $this->insert('{{%geo_country}}',['id'=>'93','country_code'=>'HT','country'=>'Haiti']);
        $this->insert('{{%geo_country}}',['id'=>'94','country_code'=>'HM','country'=>'Heard Island And Mcdonald Islands']);
        $this->insert('{{%geo_country}}',['id'=>'95','country_code'=>'VA','country'=>'Holy See (vatican City State)']);
        $this->insert('{{%geo_country}}',['id'=>'96','country_code'=>'HN','country'=>'Honduras']);
        $this->insert('{{%geo_country}}',['id'=>'97','country_code'=>'HK','country'=>'Hong Kong']);
        $this->insert('{{%geo_country}}',['id'=>'98','country_code'=>'HU','country'=>'Hungary']);
        $this->insert('{{%geo_country}}',['id'=>'99','country_code'=>'IS','country'=>'Iceland']);
        $this->insert('{{%geo_country}}',['id'=>'100','country_code'=>'IN','country'=>'India']);
        $this->insert('{{%geo_country}}',['id'=>'101','country_code'=>'ID','country'=>'Indonesia']);
        $this->insert('{{%geo_country}}',['id'=>'102','country_code'=>'IR','country'=>'Iran, Islamic Republic Of']);
        $this->insert('{{%geo_country}}',['id'=>'103','country_code'=>'IQ','country'=>'Iraq']);
        $this->insert('{{%geo_country}}',['id'=>'104','country_code'=>'IE','country'=>'Ireland']);
        $this->insert('{{%geo_country}}',['id'=>'105','country_code'=>'IL','country'=>'Israel']);
        $this->insert('{{%geo_country}}',['id'=>'106','country_code'=>'IT','country'=>'Italy']);
        $this->insert('{{%geo_country}}',['id'=>'107','country_code'=>'JM','country'=>'Jamaica']);
        $this->insert('{{%geo_country}}',['id'=>'108','country_code'=>'JP','country'=>'Japan']);
        $this->insert('{{%geo_country}}',['id'=>'109','country_code'=>'JO','country'=>'Jordan']);
        $this->insert('{{%geo_country}}',['id'=>'110','country_code'=>'KZ','country'=>'Kazakstan']);
        $this->insert('{{%geo_country}}',['id'=>'111','country_code'=>'KE','country'=>'Kenya']);
        $this->insert('{{%geo_country}}',['id'=>'112','country_code'=>'KI','country'=>'Kiribati']);
        $this->insert('{{%geo_country}}',['id'=>'113','country_code'=>'KP','country'=>'Korea, Democratic People\'s Republic Of']);
        $this->insert('{{%geo_country}}',['id'=>'114','country_code'=>'KR','country'=>'Korea, Republic Of']);
        $this->insert('{{%geo_country}}',['id'=>'115','country_code'=>'KV','country'=>'Kosovo']);
        $this->insert('{{%geo_country}}',['id'=>'116','country_code'=>'KW','country'=>'Kuwait']);
        $this->insert('{{%geo_country}}',['id'=>'117','country_code'=>'KG','country'=>'Kyrgyzstan']);
        $this->insert('{{%geo_country}}',['id'=>'118','country_code'=>'LA','country'=>'Lao People\'s Democratic Republic']);
        $this->insert('{{%geo_country}}',['id'=>'119','country_code'=>'LV','country'=>'Latvia']);
        $this->insert('{{%geo_country}}',['id'=>'120','country_code'=>'LB','country'=>'Lebanon']);
        $this->insert('{{%geo_country}}',['id'=>'121','country_code'=>'LS','country'=>'Lesotho']);
        $this->insert('{{%geo_country}}',['id'=>'122','country_code'=>'LR','country'=>'Liberia']);
        $this->insert('{{%geo_country}}',['id'=>'123','country_code'=>'LY','country'=>'Libyan Arab Jamahiriya']);
        $this->insert('{{%geo_country}}',['id'=>'124','country_code'=>'LI','country'=>'Liechtenstein']);
        $this->insert('{{%geo_country}}',['id'=>'125','country_code'=>'LT','country'=>'Lithuania']);
        $this->insert('{{%geo_country}}',['id'=>'126','country_code'=>'LU','country'=>'Luxembourg']);
        $this->insert('{{%geo_country}}',['id'=>'127','country_code'=>'MO','country'=>'Macau']);
        $this->insert('{{%geo_country}}',['id'=>'128','country_code'=>'MK','country'=>'Macedonia, The Former Yugoslav Republic Of']);
        $this->insert('{{%geo_country}}',['id'=>'129','country_code'=>'MG','country'=>'Madagascar']);
        $this->insert('{{%geo_country}}',['id'=>'130','country_code'=>'MW','country'=>'Malawi']);
        $this->insert('{{%geo_country}}',['id'=>'131','country_code'=>'MY','country'=>'Malaysia']);
        $this->insert('{{%geo_country}}',['id'=>'132','country_code'=>'MV','country'=>'Maldives']);
        $this->insert('{{%geo_country}}',['id'=>'133','country_code'=>'ML','country'=>'Mali']);
        $this->insert('{{%geo_country}}',['id'=>'134','country_code'=>'MT','country'=>'Malta']);
        $this->insert('{{%geo_country}}',['id'=>'135','country_code'=>'MH','country'=>'Marshall Islands']);
        $this->insert('{{%geo_country}}',['id'=>'136','country_code'=>'MQ','country'=>'Martinique']);
        $this->insert('{{%geo_country}}',['id'=>'137','country_code'=>'MR','country'=>'Mauritania']);
        $this->insert('{{%geo_country}}',['id'=>'138','country_code'=>'MU','country'=>'Mauritius']);
        $this->insert('{{%geo_country}}',['id'=>'139','country_code'=>'YT','country'=>'Mayotte']);
        $this->insert('{{%geo_country}}',['id'=>'140','country_code'=>'MX','country'=>'Mexico']);
        $this->insert('{{%geo_country}}',['id'=>'141','country_code'=>'FM','country'=>'Micronesia, Federated States Of']);
        $this->insert('{{%geo_country}}',['id'=>'142','country_code'=>'MD','country'=>'Moldova, Republic Of']);
        $this->insert('{{%geo_country}}',['id'=>'143','country_code'=>'MC','country'=>'Monaco']);
        $this->insert('{{%geo_country}}',['id'=>'144','country_code'=>'MN','country'=>'Mongolia']);
        $this->insert('{{%geo_country}}',['id'=>'145','country_code'=>'ME','country'=>'Montenegro']);
        $this->insert('{{%geo_country}}',['id'=>'146','country_code'=>'MS','country'=>'Montserrat']);
        $this->insert('{{%geo_country}}',['id'=>'147','country_code'=>'MA','country'=>'Morocco']);
        $this->insert('{{%geo_country}}',['id'=>'148','country_code'=>'MZ','country'=>'Mozambique']);
        $this->insert('{{%geo_country}}',['id'=>'149','country_code'=>'MM','country'=>'Myanmar']);
        $this->insert('{{%geo_country}}',['id'=>'150','country_code'=>'NA','country'=>'Namibia']);
        $this->insert('{{%geo_country}}',['id'=>'151','country_code'=>'NR','country'=>'Nauru']);
        $this->insert('{{%geo_country}}',['id'=>'152','country_code'=>'NP','country'=>'Nepal']);
        $this->insert('{{%geo_country}}',['id'=>'153','country_code'=>'NL','country'=>'Netherlands']);
        $this->insert('{{%geo_country}}',['id'=>'154','country_code'=>'AN','country'=>'Netherlands Antilles']);
        $this->insert('{{%geo_country}}',['id'=>'155','country_code'=>'NC','country'=>'New Caledonia']);
        $this->insert('{{%geo_country}}',['id'=>'156','country_code'=>'NZ','country'=>'New Zealand']);
        $this->insert('{{%geo_country}}',['id'=>'157','country_code'=>'NI','country'=>'Nicaragua']);
        $this->insert('{{%geo_country}}',['id'=>'158','country_code'=>'NE','country'=>'Niger']);
        $this->insert('{{%geo_country}}',['id'=>'159','country_code'=>'NG','country'=>'Nigeria']);
        $this->insert('{{%geo_country}}',['id'=>'160','country_code'=>'NU','country'=>'Niue']);
        $this->insert('{{%geo_country}}',['id'=>'161','country_code'=>'NF','country'=>'Norfolk Island']);
        $this->insert('{{%geo_country}}',['id'=>'162','country_code'=>'MP','country'=>'Northern Mariana Islands']);
        $this->insert('{{%geo_country}}',['id'=>'163','country_code'=>'NO','country'=>'Norway']);
        $this->insert('{{%geo_country}}',['id'=>'164','country_code'=>'OM','country'=>'Oman']);
        $this->insert('{{%geo_country}}',['id'=>'165','country_code'=>'PK','country'=>'Pakistan']);
        $this->insert('{{%geo_country}}',['id'=>'166','country_code'=>'PW','country'=>'Palau']);
        $this->insert('{{%geo_country}}',['id'=>'167','country_code'=>'PS','country'=>'Palestinian Territory, Occupied']);
        $this->insert('{{%geo_country}}',['id'=>'168','country_code'=>'PA','country'=>'Panama']);
        $this->insert('{{%geo_country}}',['id'=>'169','country_code'=>'PG','country'=>'Papua New Guinea']);
        $this->insert('{{%geo_country}}',['id'=>'170','country_code'=>'PY','country'=>'Paraguay']);
        $this->insert('{{%geo_country}}',['id'=>'171','country_code'=>'PE','country'=>'Peru']);
        $this->insert('{{%geo_country}}',['id'=>'172','country_code'=>'PH','country'=>'Philippines']);
        $this->insert('{{%geo_country}}',['id'=>'173','country_code'=>'PN','country'=>'Pitcairn']);
        $this->insert('{{%geo_country}}',['id'=>'174','country_code'=>'PL','country'=>'Poland']);
        $this->insert('{{%geo_country}}',['id'=>'175','country_code'=>'PT','country'=>'Portugal']);
        $this->insert('{{%geo_country}}',['id'=>'176','country_code'=>'PR','country'=>'Puerto Rico']);
        $this->insert('{{%geo_country}}',['id'=>'177','country_code'=>'QA','country'=>'Qatar']);
        $this->insert('{{%geo_country}}',['id'=>'178','country_code'=>'RE','country'=>'Reunion']);
        $this->insert('{{%geo_country}}',['id'=>'179','country_code'=>'RO','country'=>'Romania']);
        $this->insert('{{%geo_country}}',['id'=>'180','country_code'=>'RU','country'=>'Russian Federation']);
        $this->insert('{{%geo_country}}',['id'=>'181','country_code'=>'RW','country'=>'Rwanda']);
        $this->insert('{{%geo_country}}',['id'=>'182','country_code'=>'SH','country'=>'Saint Helena']);
        $this->insert('{{%geo_country}}',['id'=>'183','country_code'=>'KN','country'=>'Saint Kitts And Nevis']);
        $this->insert('{{%geo_country}}',['id'=>'184','country_code'=>'LC','country'=>'Saint Lucia']);
        $this->insert('{{%geo_country}}',['id'=>'185','country_code'=>'PM','country'=>'Saint Pierre And Miquelon']);
        $this->insert('{{%geo_country}}',['id'=>'186','country_code'=>'VC','country'=>'Saint Vincent And The Grenadines']);
        $this->insert('{{%geo_country}}',['id'=>'187','country_code'=>'WS','country'=>'Samoa']);
        $this->insert('{{%geo_country}}',['id'=>'188','country_code'=>'SM','country'=>'San Marino']);
        $this->insert('{{%geo_country}}',['id'=>'189','country_code'=>'ST','country'=>'Sao Tome And Principe']);
        $this->insert('{{%geo_country}}',['id'=>'190','country_code'=>'SA','country'=>'Saudi Arabia']);
        $this->insert('{{%geo_country}}',['id'=>'191','country_code'=>'SN','country'=>'Senegal']);
        $this->insert('{{%geo_country}}',['id'=>'192','country_code'=>'RS','country'=>'Serbia']);
        $this->insert('{{%geo_country}}',['id'=>'193','country_code'=>'SC','country'=>'Seychelles']);
        $this->insert('{{%geo_country}}',['id'=>'194','country_code'=>'SL','country'=>'Sierra Leone']);
        $this->insert('{{%geo_country}}',['id'=>'195','country_code'=>'SG','country'=>'Singapore']);
        $this->insert('{{%geo_country}}',['id'=>'196','country_code'=>'SK','country'=>'Slovakia']);
        $this->insert('{{%geo_country}}',['id'=>'197','country_code'=>'SI','country'=>'Slovenia']);
        $this->insert('{{%geo_country}}',['id'=>'198','country_code'=>'SB','country'=>'Solomon Islands']);
        $this->insert('{{%geo_country}}',['id'=>'199','country_code'=>'SO','country'=>'Somalia']);
        $this->insert('{{%geo_country}}',['id'=>'200','country_code'=>'ZA','country'=>'South Africa']);
        $this->insert('{{%geo_country}}',['id'=>'201','country_code'=>'GS','country'=>'South Georgia And The South Sandwich Islands']);
        $this->insert('{{%geo_country}}',['id'=>'202','country_code'=>'ES','country'=>'Spain']);
        $this->insert('{{%geo_country}}',['id'=>'203','country_code'=>'LK','country'=>'Sri Lanka']);
        $this->insert('{{%geo_country}}',['id'=>'204','country_code'=>'SD','country'=>'Sudan']);
        $this->insert('{{%geo_country}}',['id'=>'205','country_code'=>'SR','country'=>'Suriname']);
        $this->insert('{{%geo_country}}',['id'=>'206','country_code'=>'SJ','country'=>'Svalbard And Jan Mayen']);
        $this->insert('{{%geo_country}}',['id'=>'207','country_code'=>'SZ','country'=>'Swaziland']);
        $this->insert('{{%geo_country}}',['id'=>'208','country_code'=>'SE','country'=>'Sweden']);
        $this->insert('{{%geo_country}}',['id'=>'209','country_code'=>'CH','country'=>'Switzerland']);
        $this->insert('{{%geo_country}}',['id'=>'210','country_code'=>'SY','country'=>'Syrian Arab Republic']);
        $this->insert('{{%geo_country}}',['id'=>'211','country_code'=>'TW','country'=>'Taiwan, Province Of China']);
        $this->insert('{{%geo_country}}',['id'=>'212','country_code'=>'TJ','country'=>'Tajikistan']);
        $this->insert('{{%geo_country}}',['id'=>'213','country_code'=>'TZ','country'=>'Tanzania, United Republic Of']);
        $this->insert('{{%geo_country}}',['id'=>'214','country_code'=>'TH','country'=>'Thailand']);
        $this->insert('{{%geo_country}}',['id'=>'215','country_code'=>'TG','country'=>'Togo']);
        $this->insert('{{%geo_country}}',['id'=>'216','country_code'=>'TK','country'=>'Tokelau']);
        $this->insert('{{%geo_country}}',['id'=>'217','country_code'=>'TO','country'=>'Tonga']);
        $this->insert('{{%geo_country}}',['id'=>'218','country_code'=>'TT','country'=>'Trinidad And Tobago']);
        $this->insert('{{%geo_country}}',['id'=>'219','country_code'=>'TN','country'=>'Tunisia']);
        $this->insert('{{%geo_country}}',['id'=>'220','country_code'=>'TR','country'=>'Turkey']);
        $this->insert('{{%geo_country}}',['id'=>'221','country_code'=>'TM','country'=>'Turkmenistan']);
        $this->insert('{{%geo_country}}',['id'=>'222','country_code'=>'TC','country'=>'Turks And Caicos Islands']);
        $this->insert('{{%geo_country}}',['id'=>'223','country_code'=>'TV','country'=>'Tuvalu']);
        $this->insert('{{%geo_country}}',['id'=>'224','country_code'=>'UG','country'=>'Uganda']);
        $this->insert('{{%geo_country}}',['id'=>'225','country_code'=>'UA','country'=>'Ukraine']);
        $this->insert('{{%geo_country}}',['id'=>'226','country_code'=>'AE','country'=>'United Arab Emirates']);
        $this->insert('{{%geo_country}}',['id'=>'227','country_code'=>'GB','country'=>'United Kingdom']);
        $this->insert('{{%geo_country}}',['id'=>'228','country_code'=>'US','country'=>'United States']);
        $this->insert('{{%geo_country}}',['id'=>'229','country_code'=>'UM','country'=>'United States Minor Outlying Islands']);
        $this->insert('{{%geo_country}}',['id'=>'230','country_code'=>'UY','country'=>'Uruguay']);
        $this->insert('{{%geo_country}}',['id'=>'231','country_code'=>'UZ','country'=>'Uzbekistan']);
        $this->insert('{{%geo_country}}',['id'=>'232','country_code'=>'VU','country'=>'Vanuatu']);
        $this->insert('{{%geo_country}}',['id'=>'233','country_code'=>'VE','country'=>'Venezuela']);
        $this->insert('{{%geo_country}}',['id'=>'234','country_code'=>'VN','country'=>'Viet Nam']);
        $this->insert('{{%geo_country}}',['id'=>'235','country_code'=>'VG','country'=>'Virgin Islands, British']);
        $this->insert('{{%geo_country}}',['id'=>'236','country_code'=>'VI','country'=>'Virgin Islands, U.s.']);
        $this->insert('{{%geo_country}}',['id'=>'237','country_code'=>'WF','country'=>'Wallis And Futuna']);
        $this->insert('{{%geo_country}}',['id'=>'238','country_code'=>'EH','country'=>'Western Sahara']);
        $this->insert('{{%geo_country}}',['id'=>'239','country_code'=>'YE','country'=>'Yemen']);
        $this->insert('{{%geo_country}}',['id'=>'240','country_code'=>'ZM','country'=>'Zambia']);
        $this->insert('{{%geo_country}}',['id'=>'241','country_code'=>'ZW','country'=>'Zimbabwe']);
    }
}
