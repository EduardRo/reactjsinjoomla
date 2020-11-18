<?php

class clsAqc
{
	const CALEAHTTP = "http://www.matematicon.ro/_matematicon20";
	/**
	 * Clasele care sunt folosite in cadrul modulului
	 *
	 * @param   array  $params An object containing the module parameters
	 *
	 * @access public
	 */



	public function incarcaDateCategorie($codSubiect)
	{
		/*preia categoriile pentru vanzare 
		*/
		$myDB = JFactory::getDbo();
		$table = 'w2020_programe_video_bac';
		$myDB->setQuery("SELECT cod_subiect, cod_categorie, denumire_categorie, valabil FROM $table WHERE (cod_subiect='$codSubiect' AND valabil=1) GROUP BY cod_categorie ORDER BY cod_categorie");
		$result = $myDB->loadObjectList();
		//print_r($result);
		return $result;
	}
	public function incarcaDatePacheteVanzare($codCategorie)
	{
		/*preia categoriile pentru vanzare 
		*/
		$myDB = JFactory::getDbo();
		$table = 'w2020_programe_video_bac';
		$myDB->setQuery("SELECT cod_capitol, denumire_capitol FROM $table WHERE cod_categorie='$codCategorie' AND valabil=1 GROUP BY cod_capitol");
		$result = $myDB->loadObjectList();
		return $result;
	}
	public function numarVideoPachet($codProdus)
	{
		/*preia categoriile pentru vanzare 
		*/
		$myDB = JFactory::getDbo();
		$table = 'w2020_programe_video_bac';
		$myDB->setQuery("SELECT cod_video, cod_capitol FROM $table WHERE cod_capitol='$codProdus' ");
		$result = $myDB->loadObjectList();
		$count = count($result);

		return $count;
	}
	public function incarcaValoareaPachet($codProdus)
	{
		/*preia pretul pachetului 
		*/
		$myDB = JFactory::getDbo();
		$table = 'w2020_produse_valoare_credite';
		$myDB->setQuery("SELECT codprodus, valoareprodus FROM $table WHERE codprodus='$codProdus'");
		$result = $myDB->loadObjectList();
		foreach ($result as $key => $value) {
			$valoare = $value->valoareprodus;
		}

		return $valoare;
	}
	public function verifyProductOwner($codProdus, $idUser)
	{

		$myDB = JFactory::getDbo();
		$table = 'w2020_user_cont_produse';
		$myDB->setQuery("SELECT iduser codprodus FROM $table WHERE codprodus='$codProdus' AND iduser='$idUser'");
		$result = $myDB->loadObjectList();
		$res = ($result) ? 1 : 0;
		return $res;
	}

	public function incarcaLinkExemplu($codProdus)
	{
		/*preia categoriile pentru vanzare 
		*/
		$myDB = JFactory::getDbo();
		$table = 'w2020_programe_video_bac_exemple';
		$myDB->setQuery("SELECT link_vimeo FROM $table WHERE d_capitol='$codProdus'");
		$result = $myDB->loadObjectList();
		// echo 'r' . $result;
		foreach ($result as $key => $value) {
			$link_vimeo = $value->link_vimeo;
		}
		return $link_vimeo;
	}
}
