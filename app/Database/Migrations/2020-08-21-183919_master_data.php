<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterData extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' =>[
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('master_data');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('master_data');
	}
}
