<?php


require_once 'AcImage.php';
require_once 'geometry/exceptions.php';



class AcImageJPG extends AcImage
{
	

	public static function isSupport()
	{
		$gdInfo = parent::getGDinfo();
		$phpVersion = AcImage::getShortPHPVersion();

		if ((float)$phpVersion < 5.3) {
			return (bool)$gdInfo['JPG Support'];
		}

		return (bool)$gdInfo['JPEG Support'] ;
	}

	

	protected function __construct($filePath)
	{
		if (!self::isSupport())
			throw new UnsupportedFormatException('jpeg');

		parent::__construct($filePath);
		$path = parent::getFilePath();
		parent::setResource(@imagecreatefromjpeg($path));
	}

	

	public function save($path)
	{
		return parent::saveAsJPG($path);
	}
}
?>