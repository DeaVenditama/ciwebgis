<?php namespace App\Controllers;

class Maps extends BaseController
{
	public function index()
	{
		$model = new \App\Models\DataModel();

		$fileName = base_url("maps/prov.geojson");
		$file = file_get_contents($fileName);
		$file = json_decode($file);

		$features = $file->features;

		foreach($features as $index=>$feature)
		{
			$kode_wilayah = $feature->properties->kode;
			$data = $model->where('id_master_data',1)
						->where('kode_wilayah', $kode_wilayah)
						->first();

			if($data)
			{
				$features[$index]->properties->nilai = $data->nilai;
			}
		}

		$nilaiMax = $model->select('MAX(nilai) AS nilai')->where('id_master_data', 1)->first()->nilai;

		return view('maps/index',[
			'data' => $features,
			'nilaiMax' => $nilaiMax,
		]);
	}

	//--------------------------------------------------------------------

}