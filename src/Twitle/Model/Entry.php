<?php
namespace Twitle\Model;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="entries")
 */
class Entry
{
	/**
	 * @ORM\Id @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @var integer
	 */
	protected $id;
	/**
	 * @ORM\Column(type="string", length=140)
	 *
	 * @var string
	 */
	private $text;

	public function __construct() {
		$this->setCreated(date('Y-m-d H:i:s'));
	}

	public function getText() {
		return $this->text;
	}
	
	public function setText($text) {
		return $this->text = filter_var($text, FILTER_SANITIZE_STRING);
	}

	public function getId() {
		return $this->id;
	}
}