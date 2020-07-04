<?php


require_once 'AcImage.php';
require_once 'geometry/exceptions.php';




class AcImageGIF extends AcImage
{

	

	public static function isSupport()
	{
		$gdInfo = parent::getGDinfo();
		return $gdInfo['GIF Read Support'] && $gdInfo['GIF Create Support'];
	}

	
	protected function __construct($filePath)
	{
		if (!self::isSupport())
			throw new UnsupportedFormatException('gif');

		parent::__construct($filePath);
		$path = parent::getFilePath();
		parent::setResource(@imagecreatefromgif($path));
	}

	

	public function save($path)
	{
		return parent::saveAsGIF($path);
	}
}
?>