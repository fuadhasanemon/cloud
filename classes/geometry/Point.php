<?php


require_once 'exceptions.php';


class Point {

	
	private $x;

	
	private $y;

	
	public function __construct($x, $y) {
		$this->setX($x);
		$this->setY($y);
	}

	
	public function offset(Point $p) {
		$this->setX($this->getX() + $p->getX());
		$this->setY($this->getY() + $p->getY());
		return $this;
	}

	
	public static function add(Point $p, $obj) {
		if ($obj instanceof Point) {
			return new Point($p->getX() + $obj->getX(), $p->getY() + $obj->getY());
		} else if ($obj instanceof Size) {
			return new Point($p->getX() + $obj->getWidth(), $p->getY() + $obj->getHeight());
		}
		throw new IllegalArgumentException();
	}

	
	public static function subtract(Point $p, $obj) {
		if ($obj instanceof Point) {
			return self::add($p, new Point(-$obj->getX(), -$obj->getY()));
		} else if ($obj instanceof Size) {
			return self::add($p, new Point(-$obj->getWidth(), -$obj->getHeight()));
		}
		throw new IllegalArgumentException();
	}

	
	public function equals(Point $p) {
		return $this->getX() == $p->getX() && $this->getY() == $p->getY();
	}

	public function getX() {
		return $this->x;
	}

	public function getY() {
		return $this->y;
	}

	

	public function setX($x) {
		if (is_integer($x)) {
			$this->x = $x;
		} else {
			throw new IllegalArgumentException();
		}
	}

	

	public function setY($y) {
		if (is_integer($y)) {
			$this->y = $y;
		} else {
			throw new IllegalArgumentException();
		}
	}

	public function __toString() {
		return "{x: {$this->x}, y: {$this->y}}";
	}

}

?>