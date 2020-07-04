<?php



require_once 'AcImage.php';
require_once 'geometry/exceptions.php';



class AcImagePNG extends AcImage
{
	

	public static function isSupport()
	{
		$gdInfo = parent::getGDinfo();
		return (bool)$gdInfo['PNG Support'];
	}

	

	protected function __construct($filePath)
	{
		if (!self::isSupport())
			throw new UnsupportedFormatException('png');

		parent::__construct($filePath);
		$path = parent::getFilePath();
		parent::setResource(@imagecreatefrompng($path));
	}

	

	public function save($path)
	{
		return parent::saveAsPNG($path);
	}

	
	public static function getQuality()
	{
		return 9 - round(parent::getQuality() / 10);
	}
}
?>