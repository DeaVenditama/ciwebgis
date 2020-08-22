<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KodeWilayah extends Migration
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
			'kode_wilayah' => [
				'type' => 'VARCHAR',
				'constraint' => 7
			],
			'nama_wilayah'=>[
				'type' => 'VARCHAR',
				'constraint' => 100
			]
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('kode_wilayah');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kode_wilayah');
	}
}
